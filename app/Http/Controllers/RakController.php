<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rak;
use Illuminate\Support\Facades\Storage;

class RakController extends Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Halaman Rak',
            'judul' => 'Rak',
            'sub_menu' => 'rak',
            'menu' => 'master',
            'data_rak' => Rak::all()
        ); 

        return view('rak.index',$data);
       
    }

    public function save(Request $request)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
        ];

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ],$pesan);



        Rak::create([
            'name'=>$validated['name'],
            'description'=>$validated['description']
        ]);

         return back()->with('success','Data Rak Berhasil Ditambahkan');
    }

    public function edit(Request $request, $id)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
          
        ];

        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ],$pesan);

        Rak::find($id)->update([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        return back()->with('success','Data Rak Berhasil Diubah');
    }


     public function delete($id)
    {
        Rak::find($id)->delete();
        return back()->with('success','Data Rak Berhasil Dihapus');
    }
}
