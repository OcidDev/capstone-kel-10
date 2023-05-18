<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Rak;

class ProductController extends Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Halaman Produk',
            'judul' => 'Produk',
            'sub_menu' => 'product',
            'menu' => 'master',
            'data_products' => Product::all(),
            'data_category' => Category::all(),
            'data_supplier' => Supplier::all(),
            'data_rak' => Rak::all()
        );

        return view('product.index',$data);
    }

      public function save(Request $request)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
        ];
        
         $request->validate([
            'categories_id' => 'required',
            'suppliers_id' => 'required',
            'raks_id' => 'required',
            'product_code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'modal' => 'required',
            'stock' => 'required',
        ],$pesan);
        
        Product::create([
            'categories_id'=>$request->input('categories_id'),
            'suppliers_id'=>$request->input('suppliers_id'),
            'raks_id'=>$request->input('raks_id'),
            'product_code'=>$request->input('product_code'),
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'modal'=>$request->input('modal'),
            'stock'=>$request->input('stock'),
        ]);
    
        return redirect()->back()->with('success','Data Produk Berhasil Ditambahkan');
    }

       public function edit(Request $request, $id)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
        ];
        
         $validated = $request->validate([
            'categories_id' => 'required',
            'suppliers_id' => 'required',
            'raks_id' => 'required',
            'product_code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'modal' => 'required',
            'stock' => 'required',
        ],$pesan);

        $produk = Product::find($id);
        $produk->categories_id = $validated['categories_id'];
        $produk->suppliers_id = $validated['suppliers_id'];
        $produk->raks_id = $validated['raks_id'];
        $produk->product_code = $validated['product_code'];
        $produk->name = $validated['name'];
        $produk->description = $validated['description'];
        $produk->price = $validated['price'];
        $produk->modal = $validated['modal'];
        $produk->stock = $validated['stock'];
        $produk->save();

        return redirect()->back()->with('success','Data Produk Berhasil Diubah');
    }


     public function delete($id)
    {
        Product::find($id)->delete();
        return back()->with('success','Data Produk Berhasil Dihapus');
    }

}
