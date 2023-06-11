<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\DB;

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
            'title' => 'Halaman Transaksi',
            'judul' => 'Transaksi',
            'menu' => 'inventory',
            'invoiceCode' => $invoiceCode,
            'data_products' => Product::all(),
            'cart' => $inventoryCart->content(),
            'grand_total' => Cart::subtotal(0),
            'sub_menu' => '',
        );

        return view('inventory.index',$data);
    }


    public function CekProduk(Request $request)
    {

        $product_code = $request->input('product_code');
        $product = Product::join('categories', 'products.categories_id', '=', 'categories.id')
                  ->where('products.product_code', $product_code)
                  ->select('products.id as product_id','products.name as product_name', 'products.price', 'categories.name as category_name')
                  ->first();

        if ($product==null) {
            $data = [
                'product_name' => '',
                'product_id' => '',
                'category_name' => '',
                'price' => '',
            ];
        }else {
            $data = [
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
                'category_name' => $product->category_name,
                'price' => $product->price,
            ];
        }

        echo json_encode($data);

    }

    public function add_cart(Request $request)
    {

        $product_code = $request->input('product_code');
        $qty = $request->input('qty');

        $stokProduct = Product::where('product_code', $product_code)
        ->select('stock')
        ->first();

        $inventoryCart = Cart::instance('inventory');
        $cart =  $inventoryCart->add([
        'id' => $request->product_id,
        'name' => $request->product_name,
        'price' => $request->price,
        'weight' => 0,
        'qty' =>  $request->qty,
            'options' => [
                'category_name' => $request->category_name,
                'product_code' => $request->product_code,
            ]
        ]);
        return redirect()->back()->with('success','Data Produk Berhasil Ditambahkan ke Keranjang');
    }

    public function save_inventory(Request $request)
    {
        $product = Cart::subtotal(0);
        $invoiceCode = $this->createInvoice();
        $buyer_name = $request->input('buyer_name');
        $buyer_phone = $request->input('buyer_phone');
        $buyer_email = $request->input('buyer_email');
        $status = $request->input('status');
        $cash =  str_replace(",","",$request->input('cash'));
        $change =  str_replace(",","",$request->input('change'));
        $user_id = $request->input('user_id');
        $transaksi_id = 1;
        $item = Cart::content();
        // dd($cash);

        if ( $product==0 ) {
        return redirect('transaction')->with('danger','Data Keranjang Kosong');
        } else {
            $no_urut = 0;

            $query = DB::table('transactions')
                ->select('id')
                ->get();

            foreach($query as $no){
                $no_urut = $no->id;
            }
            if($no_urut == null){
                $no_urut = 1;
            } else {
                $no_urut = $no_urut+1;
            }

                if ($cash<=0) {

                    $data = [
                        'invoice_code' => $invoiceCode,
                        'cashier_id' => 1,
                        'buyer_name' => $buyer_name,
                        'buyer_phone' => $buyer_phone,
                        'buyer_email' => $buyer_email,
                        'total' =>  str_replace(",","",Cart::subtotal(0)),
                        'cash' => $cash,
                        'change' => 0,
                        'status' => $status,
                    ];
                    Transaction::create($data);

                    foreach ($item as $key => $value) {
                        $data = [
                        'transactions_id' => $no_urut,
                        'products_id' => $value->id,
                        'qty' =>  $value->qty,
                        ];
                    DetailTransaction::create($data);
                    }

                    Cart::destroy();

                    return redirect('transaction')->with('success','Transaksi Berhasil Disimpan');
                }

            $data = [
                'invoice_code' => $invoiceCode,
                'cashier_id' => 1,
                'buyer_name' => $buyer_name,
                'buyer_phone' => $buyer_phone,
                'buyer_email' => $buyer_email,
                'total' =>  str_replace(",","",Cart::subtotal(0)),
                'cash' => $cash,
                'change' => $change,
                'status' => $status,
            ];
            Transaction::create($data);

            foreach ($item as $key => $value) {
                $data = [
                'transactions_id' => $no_urut,
                'products_id' => $value->id,
                'qty' =>  $value->qty,
                ];
            DetailTransaction::create($data);
            }

            Cart::destroy();

            return redirect('transaction')->with('success','Transaksi Berhasil Disimpan');

        }
    }

    public function remove_item($rowId){
        Cart::remove($rowId);
        return redirect()->back()->with('success','Data Produk pada Keranjang Berhasil Dihapus');

    }


    public function createInvoice()
    {
        $lastInvoice = Transaction::latest('id')->first();

        if (!$lastInvoice) {
            $invoiceCode = 'GITS-001';
        } else {
            $lastInvoiceCode = $lastInvoice->invoice_code;
            $lastInvoiceNumber = intval(substr($lastInvoiceCode, -2));

            if ($lastInvoiceNumber < 9) {
                $invoiceNumber = '00' . ($lastInvoiceNumber + 1);
            } else {
                $invoiceNumber = $lastInvoiceNumber + 1;
            }

            $invoiceCode = 'GITS-' . $invoiceNumber;
        }
        return $invoiceCode;
    }


    public function debit()
    {

        $data = array(
            'title' => 'Riwayat Transaksi',
            'judul' => 'Belum Lunas',
            'menu' => 'inventory',
            'sub_menu' => 'utang',
        );

        $transactions = Transaction::with(['DetailTransaction.product'])->where('status','Belum Lunas')->whereHas('DetailTransaction')->get();

        return view('transaction.debit',compact('transactions'),$data);
    }

    public function status_lunas(Request $request,$id)
    {
        $data = Transaction::find($id);
        $data->status = 'LUNAS';
        $data->cash = str_replace(",","",$request->input('cash'));
        $data->change = str_replace(",","",$request->input('change'));

        if ($data->change < 0) {
           return redirect()->back()->with('danger','Data Tidak Benar');
        }else {
            $data->save();
           return back()->with('success','Transaksi Berhasil Disimpan');
        }




    }

    public function paid_off()
    {

        $data = array(
            'title' => 'Riwayat Transaksi',
            'judul' => 'Lunas',
            'menu' => 'inventory',
            'sub_menu' => 'lunas',
        );

        $transactions = Transaction::with(['DetailTransaction.product'])->where('status','Lunas')->whereHas('DetailTransaction')->get();

        return view('transaction.paid_off',$data, compact('transactions'));
    }

    public function list_detail($id){
    $data = array(
      'menu' => 'list_transaction',
      'sub_menu' => '',
      'title' => 'Halaman Detail Transaksi',
      'judul' => 'Detail Transaksi',
      'sub_judul' => '',

      );
    $transactions = Transaction::with(['DetailTransaction.product'])->where('status','Lunas')->whereHas('DetailTransaction')->where('id', $id)->get();

    return view('transaction.list_detail', $data, compact('transactions'));
  }

}
