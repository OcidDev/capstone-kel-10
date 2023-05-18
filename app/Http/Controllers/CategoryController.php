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
            'mimes' => ':attribute Harus Beformat jpeg,png,jpg !!',
            'max' => 'Ukuran :attribute Max 5mb !!',
        ];
        
         $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => [File::types(['jpeg', 'jpg', 'png'])->max(2 * 1024),]
        ],$pesan);
        
        Category::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'image' => Storage::putFile('category_img', $request['image'])
        ]);
    
        return back()->with('success','Data Kategori Berhasil Ditambahkan');
    }

     public function edit(Request $request, $id)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
        ];
        
         $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => [File::types(['jpeg', 'jpg', 'png'])->max(2 * 1024),]
        ],$pesan);

        $category = Category::find($id);
        $category->name = $validated['name'];
        $category->description = $validated['description'];
    

        if($request->file('image')){
            if($category->image && Storage::exists($category->image)){
                Storage::delete($category->image);
            }
            $category->image = Storage::putFile('category_img', $validated['image']);
        }
        $category->save();

        return back()->with('success','Data Kategori Berhasil Diubah');    }

   
    public function delete($id)
    {
        $category = Category::find($id);
        Storage::delete($category->image);
        $category->delete();

        return back()->with('success','Data Kategori Berhasil Dihapus');       
    }


}
