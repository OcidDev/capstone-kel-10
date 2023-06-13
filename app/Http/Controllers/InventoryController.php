<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Report;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\DetailInventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{

    public function __construct()
    {
        $this->Product = new Product();
    }

    public function index()
    {
        $inventoryCart = Cart::instance('inventory');
        $invoiceCode = $this->createInvoice();
        $data = array(
            'title' => 'Halaman Inventaris',
            'judul' => 'Inventaris',
            'menu' => 'inventory',
            'suppliers' => Supplier::all(),
            'invoiceCode' => $invoiceCode,
            'data_products' => Product::all(),
            'cart' => $inventoryCart->content(),
            'grand_total' => $inventoryCart->subtotal(0),
            'sub_menu' => '',
        );

        return view('inventory.index',$data);
    }


    public function CekProduk(Request $request)
    {

        $product_code = $request->input('product_code');

        $product = Product::join('categories', 'products.categories_id', '=', 'categories.id')
                  ->where('products.product_code', $product_code)
                  ->select('products.id as product_id','products.name as product_name', 'products.price','products.capital_price as capital_price', 'categories.name as category_name')
                  ->first();

        if ($product==null) {
            $data = [
                'product_name' => '',
                'product_id' => '',
                'category_name' => '',
                'price' => '',
                'capital_price' => '',
            ];
        }else {
            $data = [
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
                'category_name' => $product->category_name,
                'price' => $product->price,
                'capital_price' => $product->capital_price,
            ];
        }

        echo json_encode($data);

    }

    public function add_cart(Request $request)
    {
        $inventoryCart = Cart::instance('inventory');
        $product_code = $request->input('product_code');
        $capital_price = $request->input('capital_price');
        $qty = $request->input('qty');

        if($product_code == null){
            return redirect()->back()->with('danger', 'Produk Tidak Ditemukan');
        }

        $stokProduct = Product::where('product_code', $product_code)
            ->select('stock')
            ->first();

        $product_cart = $inventoryCart->content()->where('id', $request->product_id)->first();
        $currentQty = $product_cart ? $product_cart->qty : 0; // Jumlah produk saat ini dalam keranjang

        $totalQty = $qty + $currentQty; // Total jumlah produk setelah ditambahkan ke keranjang
        if( $qty < 1){
            return redirect()->back()->with('danger', 'Jumlah Produk Tidak Boleh Kurang Dari 1');
        } else {
            $cart = $inventoryCart->add([
                'id' => $request->product_id,
                'name' => $request->product_name,
                'price' => $request->price,
                'weight' => 0,
                'qty' => $qty,
                'options' => [
                    'category_name' => $request->category_name,
                    'product_code' => $request->product_code,
                    'capital_price' => $request->capital_price,
                ]
            ]);
            return redirect()->back()->with('success', 'Data Produk Berhasil Ditambahkan ke Keranjang');
        }

    }

    public function save_inventory(Request $request)
    {
        $inventoryCart = Cart::instance('inventory');
        $product = $inventoryCart->subtotal(0);
        $invoiceCode = $this->createInvoice();
        $supplier_id = $request->suppliers_id;
        $grand_total =  str_replace(",","",$inventoryCart->subtotal(0));
        $cash =  str_replace(",","",$request->input('cash'));
        $change =  str_replace(",","",$request->input('change'));
        $cashier = Auth::user()->id;
        $item = $inventoryCart->content();
        $status = '';
        if($grand_total > $cash){
            $status = 'Belum Lunas';
            $change = 0;
        }else{
            $status = 'Lunas';
        }

        if ( $product==0 ) {
            return redirect('inventory')->with('danger','Data Keranjang Kosong');
        }

        if ($cash<=0) {
            $data = [
                'invoice_code' => $invoiceCode,
                'cashier_id' => $cashier,
                'suppliers_id' => $supplier_id,
                'total' =>  str_replace(",","",$inventoryCart->subtotal(0)),
                'cash' => $cash,
                'change' => 0,
                'status' => $status,
            ];

            $inventories = Inventory::create($data);

            foreach ($item as $key => $value) {
                $data = [
                'inventories_id' => $inventories->id,
                'products_id' => $value->id,
                'product_name' => $value->name,
                'product_price' => $value->price,
                'product_capital_price' => $value->options->capital_price,
                'qty' =>  $value->qty,
                ];
                DetailInventory::create($data);
                $product_stock = Product::find($value->id);
                $stokminus = $product_stock->stock + $value->qty;
                Product::find($value->id)->update(['stock' => $stokminus]);
            }
        }else if($cash>0){
            $data = [
                'invoice_code' => $invoiceCode,
                'cashier_id' => Auth::user()->id,
                'suppliers_id' => $supplier_id,
                'total' =>  str_replace(",","",$inventoryCart->subtotal(0)),
                'cash' => $cash,
                'change' => $change,
                'status' => $status,
            ];
            $inventories = Inventory::create($data);
            foreach ($item as $key => $value) {
                $data = [
                'inventories_id' => $inventories->id,
                'products_id' => $value->id,
                'product_name' => $value->name,
                'product_price' => $value->price,
                'product_capital_price' => $value->options->capital_price,
                'qty' =>  $value->qty,
                ];
            DetailInventory::create($data);
            $product_stock = Product::find($value->id);
            $stokminus = $product_stock->stock + $value->qty;
            Product::find($value->id)->update(['stock' => $stokminus]);
            }

        }
        $inventories = Inventory::latest('id')->first();

        $lastBalance = Report::orderByDesc('created_at')->select('saldo')->first();
        if ($lastBalance == null) {
                $saldo = 0;
            } else {
                $saldo = $lastBalance->saldo;
            }
        $totalHargaModal = DB::table('detail_inventories')
            ->where('inventories_id', $inventories->id)
            ->sum(DB::raw('product_capital_price * qty'));
        if($status == 'Lunas'){
            Report::create([
                'debit' => 0,
                'profit' => 0,
                'kredit' => $grand_total,
                'saldo' => $saldo - $grand_total,
                'description' => 'Pengeluaran dari transaksi inventaris yang berinvoice '.$invoiceCode,
            ]);
        }
        $inventoryCart->destroy();
        return redirect('inventory')->with('success','Transaksi Berhasil Disimpan');
    }

    public function remove_item($rowId){
        $inventoryCart = Cart::instance('inventory');
        $inventoryCart->remove($rowId);
        return redirect()->back()->with('success','Data Produk pada Keranjang Berhasil Dihapus');

    }

    public function createInvoice()
    {
        $lastInvoice = Inventory::latest('id')->first();
        $ldate = date('Ym');
        if (!$lastInvoice) {
            $invoiceCode = 'GITS- '.$ldate.'001';
        } else {
            $lastInvoiceCode = $lastInvoice->invoice_code;
            $lastInvoiceNumber = intval(substr($lastInvoiceCode, -2));

            if ($lastInvoiceNumber < 9) {
                $invoiceNumber = '00' . ($lastInvoiceNumber + 1);
            } else {
                $invoiceNumber = $lastInvoiceNumber + 1;
            }

            $invoiceCode = 'GITS-' . $ldate . $invoiceNumber;
        }
        return $invoiceCode;
    }

    public function debit()
    {

        $data = array(
            'title' => 'Riwayat Inventaris',
            'judul' => 'Belum Lunas',
            'menu' => 'master3',
            'sub_menu' => 'inventaris_utang',
        );

        $inventories = Inventory::with(['DetailInventory.product'])->where('status','Belum Lunas')->whereHas('DetailInventory')->get();

        return view('inventory.debit',compact('inventories'),$data);
    }

    public function status_lunas(Request $request,$id)
    {
        $data = Inventory::find($id);
        $data->status = 'LUNAS';
        $data->cash = str_replace(",","",$request->input('cash'));
        $data->change = str_replace(",","",$request->input('change'));

        $lastBalance = Report::orderByDesc('created_at')
                    ->select('saldo')
                    ->first();
        if ($lastBalance == null) {
            $saldo = 0;
        } else {
            $saldo = $lastBalance->saldo;
        }
        $totalHargaModal = DB::table('detail_inventories')
            ->where('inventories_id', $data->id)
            ->sum(DB::raw('product_capital_price * qty'));

        if ($data->change < 0) {
           return redirect()->back()->with('danger','Data Tidak Benar (Uang Kurang)');
        }else {
            $data->save();
            Report::create([
                'debit' => 0,
                'profit' => 0,
                'kredit' => $data->total,
                'saldo' => $saldo - $data->total,
                'description' => 'Pengeluaran dari transaksi inventaris yang berinvoice '.$data->invoice_code,
            ]);
           return back()->with('success','Transaksi Berhasil Disimpan');
        }

    }

    public function paid_off()
    {

        $data = array(
            'title' => 'Riwayat Inventaris',
            'judul' => 'Lunas',
            'menu' => 'master3',
            'sub_menu' => 'inventaris_lunas',
        );

        $inventories = Inventory::with(['DetailInventory.product'])->where('status','Lunas')->whereHas('DetailInventory')->get();

        return view('inventory.paid_off',$data, compact('inventories'));
    }

    public function list_detail($id){
    $data = array(
      'menu' => 'list_transaction',
      'sub_menu' => '',
      'title' => 'Halaman Detail Transaksi',
      'judul' => 'Detail Transaksi',
      'sub_judul' => '',

      );
    $inventories = Inventory::with(['DetailTransaction.product'])->where('status','Lunas')->whereHas('DetailTransaction')->where('id', $id)->get();

    return view('transaction.list_detail', $data, compact('inventories'));
  }

}
