<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shelves;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'data_rak' => Shelves::all()
        );

        return view('product.index',$data);
    }

      public function save(Request $request)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
            'unique' => 'code produk sudah terdaftar, gunakan code lain !!',
            'image' => 'gambar harus berformat .jpg, .jpeg, .png, .gif !!',

        ];

         $data = $request->validate([
            'shelves_id' => 'required',
            'categories_id' => 'required',
            'product_code' => 'required|unique:products,name',
            'name' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            'price' => 'required',
            'capital_price' => 'required',
            'stock' => 'required',
        ],$pesan);

        $data['price'] = str_replace(",","", $request->input('price'));
        $data['capital_price'] = str_replace(",","", $request->input('capital_price'));
        $data['stock'] = str_replace(",","", $request->input('stock'));
        $data['image'] = $request->file('image')->store('assets/image', 'public');

        Product::Create($data);

        return redirect()->back()->with('success','Data Produk Berhasil Ditambahkan');
    }

       public function edit(Request $request, $id)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
        ];

         $validated = $request->validate([
            'categories_id' => 'required',
            'shelves_id' => 'required',
            'product_code' => 'required|unique:products,product_code,'.$id,
            'name' => 'required',
            'image' => 'image',
            'description' => 'required',
            'price' => 'required',
            'capital_price' => 'required',
            'stock' => 'required',
        ],$pesan);

        $product = Product::find($id);
        $product->categories_id = $validated['categories_id'];
        $product->shelves_id = $validated['shelves_id'];
        $product->product_code = $validated['product_code'];
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = str_replace(",", "", $validated['price']);
        $product->capital_price = str_replace(",", "", $validated['capital_price']);
        $product->stock = str_replace(",", "", $validated['stock']);

        if($request->file('image')){
            if($product->image && Storage::exists($product->image)){
                Storage::delete('public/'.$product->image);
            }
            $product->image = $request->file('image')->store('assets/image', 'public');
        }
        $product->save();
        return redirect()->back()->with('success','Data Produk Berhasil Diubah');
    }


     public function delete($id)
    {
        Product::find($id)->delete();
        return back()->with('success','Data Produk Berhasil Dihapus');
    }

}
