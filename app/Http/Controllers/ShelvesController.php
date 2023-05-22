<?php

namespace App\Http\Controllers;

use App\Models\Shelves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShelvesController extends Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Halaman Rak',
            'judul' => 'Rak',
            'sub_menu' => 'rak',
            'menu' => 'master',
            'data_rak' => Shelves::all()
        );

        return view('shelves.index',$data);

    }

    public function save(Request $request)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
            'unique' => 'nama rak sudah terdaftar, gunakan nama lain !!',
        ];

        $validated = $request->validate([
            'name' => 'required|unique:shelves,name',
            'description' => 'required'
        ],$pesan);



        Shelves::create([
            'name'=>$validated['name'],
            'description'=>$validated['description']
        ]);

         return back()->with('success','Data Rak Berhasil Ditambahkan');
    }

    public function edit(Request $request, $id)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
            'unique' => 'nama rak sudah terdaftar, gunakan nama lain !!',
        ];

        $request->validate([
            'name' => 'required|unique:shelves,name,'.$id,
            'description' => 'required'
        ],$pesan);

        Shelves::find($id)->update([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        return back()->with('success','Data Rak Berhasil Diubah');
    }


     public function delete($id)
    {
        Shelves::find($id)->delete();
        return back()->with('success','Data Rak Berhasil Dihapus');
    }
}
