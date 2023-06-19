<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Buyer;
use App\Models\Report;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->Product = new Product();
    }

    public function index()
    {

        $invoiceCode = $this->createInvoice();
        $data = array(
            'title' => 'Halaman Transaksi',
            'judul' => 'Transaksi',
            'menu' => 'transaction',
            'buyers' => Buyer::all(),
            'invoiceCode' => $invoiceCode,
            'data_products' => Product::all(),
            'cart' => Cart::content(),
            'grand_total' => Cart::subtotal(0),
            'sub_menu' => '',
        );

        return view('transaction.index',$data);
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
        $product_code = $request->input('product_code');
        $capital_price = $request->input('capital_price');
        $qty = $request->input('qty');


        $stokProduct = Product::where('product_code', $product_code)
            ->select('stock')
            ->first();

        $product_cart = Cart::content()->where('id', $request->product_id)->first();
        $currentQty = $product_cart ? $product_cart->qty : 0; // Jumlah produk saat ini dalam keranjang
        if($product_code == null){
            return redirect()->back()->with('danger', 'Produk Tidak Ditemukan');
        }
        $totalQty = $qty + $currentQty; // Total jumlah produk setelah ditambahkan ke keranjang
        if ($totalQty > intval($stokProduct->stock)) {
            return redirect()->back()->with('danger', 'Stok Tidak Mencukupi');
        }else if( $qty < 1){
            return redirect()->back()->with('danger', 'Jumlah Produk Tidak Boleh Kurang Dari 1');
        } else {
            $cart = Cart::add([
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

    public function save_transaction(Request $request)
    {
        $subtotal = Cart::subtotal(0);
        $invoiceCode = $this->createInvoice();
        $buyer_id = $request->buyer_id;
        $grand_total = str_replace(",", "", $subtotal);
        $cash = ($request->cash !== null) ?  str_replace(",", "", $request->input('cash')) : 0;
        $change = str_replace(",", "", $request->input('change'));
        $user_id = Auth::user()->id;
        $transaksi_id = 1;
        $item = Cart::content();

        $status = ($grand_total > $cash) ? 'Belum Lunas' : 'Lunas';
        $change = ($status === 'Belum Lunas') ? 0 : $change;

        if(Cart::count() <= 0){
            return redirect()->back()->with('danger', 'Data Keranjang Kosong');
        }else if($request->cash < $request->grand_total && $request->cash !== null && $request->cash >= 1){
            return redirect()->back()->with('danger', 'Jika ingin hutang silahkan kosongkan isian cash atau isi 0');
        }else if($request->buyer_id == null && $request->cash == null || $request->buyer_id == null && $request->cash == 0 ){
            return redirect()->back()->with('danger', 'Siapa yang ingin hutang?');
        }

        $data = [
            'invoice_code' => $invoiceCode,
            'cashier_id' => $user_id,
            'buyer_id' => $buyer_id,
            'total' => $grand_total,
            'cash' => $cash,
            'change' => $change,
            'status' => $status,
        ];

        $transactions = Transaction::create($data);

        foreach ($item as $key => $value) {
            $data = [
                'transactions_id' => $transactions->id,
                'products_id' => $value->id,
                'product_name' => $value->name,
                'product_price' => $value->price,
                'product_capital_price' => $value->options->capital_price,
                'qty' => $value->qty,
            ];
            DetailTransaction::create($data);
            $product_stock = Product::find($value->id);
            $stokminus = $product_stock->stock - $value->qty;
            $product_stock->update(['stock' => $stokminus]);
        }

        $latestTransaction = Transaction::latest('id')->first();
        $lastBalance = Report::orderByDesc('created_at')->select('saldo')->first();
        $saldo = ($lastBalance == null) ? 0 : $lastBalance->saldo;

        $totalHargaModal = DetailTransaction::where('transactions_id', $latestTransaction->id)
            ->sum(DB::raw('product_capital_price * qty'));

        if ($status == 'Lunas') {
            Report::create([
                'debit' => $grand_total,
                'profit' => $grand_total - $totalHargaModal,
                'kredit' => 0,
                'saldo' => $saldo + $grand_total,
                'description' => 'pendapatan dari penjualan yang berinvoice '.$invoiceCode,
            ]);
        }

        Cart::destroy();
        return redirect('transaction')->with('success', 'Transaksi Berhasil Disimpan');
    }

    // public function save_transaction(Request $request)
    // {

    //     $product = Cart::subtotal(0);
    //     $invoiceCode = $this->createInvoice();
    //     $buyer_id = $request->buyer_id;
    //     $grand_total =  str_replace(",","",Cart::subtotal(0));
    //     $cash =  str_replace(",","",$request->input('cash'));
    //     $change =  str_replace(",","",$request->input('change'));
    //     $user_id = Auth::user()->id;
    //     $transaksi_id = 1;
    //     $item = Cart::content();
    //     $status = '';
    //     if($grand_total > $cash){
    //         $status = 'Belum Lunas';
    //         $change = 0;
    //     }else{
    //         $status = 'Lunas';
    //     }

    //     if ( $product==0 ) {
    //         return redirect('transaction')->with('danger','Data Keranjang Kosong');
    //     }

    //     if ($cash<=0) {
    //         $data = [
    //             'invoice_code' => $invoiceCode,
    //             'cashier_id' => $user_id,
    //             'buyer_id' => $buyer_id,
    //             'total' =>  str_replace(",","",Cart::subtotal(0)),
    //             'cash' => $cash,
    //             'change' => 0,
    //             'status' => $status,
    //         ];

    //         $transactions = Transaction::create($data);

    //         foreach ($item as $key => $value) {
    //             $data = [
    //             'transactions_id' => $transactions->id,
    //             'products_id' => $value->id,
    //             'product_name' => $value->name,
    //             'product_price' => $value->price,
    //             'product_capital_price' => $value->options->capital_price,
    //             'qty' =>  $value->qty,
    //             ];
    //             DetailTransaction::create($data);
    //             $product_stock = Product::find($value->id);
    //             $stokminus = $product_stock->stock - $value->qty;
    //             Product::find($value->id)->update(['stock' => $stokminus]);
    //         }
    //     }else if($cash>0){
    //         $data = [
    //             'invoice_code' => $invoiceCode,
    //             'cashier_id' => Auth::user()->id,
    //             'buyer_id' => $buyer_id,
    //             'total' =>  str_replace(",","",Cart::subtotal(0)),
    //             'cash' => $cash,
    //             'change' => $change,
    //             'status' => $status,
    //         ];
    //         $transactions = Transaction::create($data);
    //         foreach ($item as $key => $value) {
    //             $data = [
    //             'transactions_id' => $transactions->id,
    //             'products_id' => $value->id,
    //             'product_name' => $value->name,
    //             'product_price' => $value->price,
    //             'product_capital_price' => $value->options->capital_price,
    //             'qty' =>  $value->qty,
    //             ];
    //         DetailTransaction::create($data);
    //         $product_stock = Product::find($value->id);
    //         $stokminus = $product_stock->stock - $value->qty;
    //         Product::find($value->id)->update(['stock' => $stokminus]);
    //         }


    //     }
    //     $transactions = Transaction::latest('id')->first();

    //     $lastBalance = Report::orderByDesc('created_at')
    //                 ->select('saldo')
    //                 ->first();
    //         if ($lastBalance == null) {
    //             $saldo = 0;
    //         } else {
    //             $saldo = $lastBalance->saldo;
    //         }
    //     $totalHargaModal = DB::table('detail_transactions')
    //         ->where('transactions_id', $transactions->id)
    //         ->sum(DB::raw('product_capital_price * qty'));
    //     if($status == 'Lunas'){
    //         Report::create([
    //             'debit' => $grand_total,
    //             'profit' => $grand_total - $totalHargaModal,
    //             'kredit' => 0,
    //         'saldo' => $saldo + $grand_total,
    //             'description' => 'pendapatan dari penjualan yang berinvoice '.$invoiceCode,
    //         ]);
    //     }
    //     Cart::destroy();
    //     return redirect('transaction')->with('success','Transaksi Berhasil Disimpan');
    // }

    public function remove_item($rowId){
        Cart::remove($rowId);
        return redirect()->back()->with('success','Data Produk pada Keranjang Berhasil Dihapus');

    }

    public function createInvoice()
    {
        $lastInvoice = Transaction::latest('id')->first();
        $ldate = date('Ym');
        if (!$lastInvoice) {
            $invoiceCode = 'INV- '.$ldate.'001';
        } else {
            $lastInvoiceCode = $lastInvoice->invoice_code;
            $lastInvoiceNumber = intval(substr($lastInvoiceCode, -2));

            if ($lastInvoiceNumber < 9) {
                $invoiceNumber = '00' . ($lastInvoiceNumber + 1);
            } else {
                $invoiceNumber = $lastInvoiceNumber + 1;
            }

            $invoiceCode = 'INV-' . $ldate . $invoiceNumber;
        }
        return $invoiceCode;
    }

    public function debit()
    {

        $data = array(
            'title' => 'Riwayat Transaksi',
            'judul' => 'Belum Lunas',
            'menu' => 'master2',
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

        $lastBalance = Report::orderByDesc('created_at')
                    ->select('saldo')
                    ->first();
        if ($lastBalance == null) {
            $saldo = 0;
        } else {
            $saldo = $lastBalance->saldo;
        }
        $totalHargaModal = DB::table('detail_transactions')
            ->where('transactions_id', $data->id)
            ->sum(DB::raw('product_capital_price * qty'));




        if ($data->change < 0) {
           return redirect()->back()->with('danger','Data Tidak Benar (Uang Kurang)');
        }else {
            $data->save();
            Report::create([
                'debit' => $data->total,
                'profit' => $data->total - $totalHargaModal,
                'kredit' => 0,
                'saldo' => $saldo + $data->total,
                'description' => 'pendapatan dari penjualan bayar hutang yang berinvoice '.$data->invoice_code,
            ]);
           return back()->with('success','Transaksi Berhasil Disimpan');
        }

    }

    public function paid_off()
    {

        $data = array(
            'title' => 'Riwayat Transaksi',
            'judul' => 'Lunas',
            'menu' => 'master2',
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
