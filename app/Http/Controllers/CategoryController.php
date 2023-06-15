<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class CategoryController extends Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Halaman Kategori',
            'judul' => 'Kategori',
            'sub_menu' => 'kategori',
            'menu' => 'master',
            'data_category' => Category::all()
        );

        return view('category.index',$data);
    }

      public function save(Request $request)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
            'image' => ':attribute Harus Gambar !!',
            'unique' => 'nama kategori sudah terdaftar, gunakan nama lain !!',
            'image' => ':attribute Harus  !!',
            'max' => 'Ukuran :attribute Max 5mb !!',
        ];

        $data =  $request->validate([
            'name' => 'required|unique:categories,name,NULL,id,deleted_at,NULL',
            'description' => 'required',
            'image' => 'required|image'
        ],$pesan);

        $data['image'] = $request->file('image')->store('assets/image', 'public');
        Category::create($data);

        return back()->with('success','Data Kategori Berhasil Ditambahkan');
    }

     public function edit(Request $request, $id)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
            'unique' => 'nama kategori sudah terdaftar, gunakan nama lain !!',
            'image' => ':attribute Harus  !!',
        ];

         $validated = $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'description' => 'required',
            'image' => 'image'
        ],$pesan);

        $category = Category::find($id);
        $category->name = $validated['name'];
        $category->description = $validated['description'];


        if($request->file('image')){
            if($category->image && Storage::exists($category->image)){
                Storage::delete('public/'.$category->image);
            }
            $category->image = $request->file('image')->store('assets/image', 'public');
        }
        $category->save();

        return back()->with('success','Data Kategori Berhasil Diubah');    }


    public function delete($id)
    {
        $category = Category::find($id);
        Storage::delete('public/'.$category->image);
        $category->delete();

        return back()->with('success','Data Kategori Berhasil Dihapus');
    }


}
