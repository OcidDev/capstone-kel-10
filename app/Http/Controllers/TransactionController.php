<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use Cart;

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
            'menu' => 'transaksi',
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
                  ->select('products.name as product_name', 'products.price', 'categories.name as category_name')
                  ->first();

        if ($product==null) {
            $data = [
                'product_name' => '',
                'category_name' => '',
                'price' => '',
            ];
        }else {
            $data = [
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
        
        if ($qty>intval($stokProduct->stock)) {
            return redirect()->back()->with('danger','Stok Tidak Mencukupi');
        } else {
            $cart =  Cart::add([
            'id' => $request->product_code,
            'name' => $request->product_name, 
            'price' => $request->price, 
            'weight' => 0, 
            'qty' =>  $request->qty, 
                'options' => [
                    'category_name' => $request->category_name,
                ]
            ]);
            return redirect()->back()->with('success','Data Produk Berhasil Ditambahkan ke Keranjang');
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

}
