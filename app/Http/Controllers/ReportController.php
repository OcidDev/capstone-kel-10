<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Halaman Laporan',
            'judul' => 'Laporan',
            'sub_menu' => '',
            'menu' => 'report',
            'data_laporan' => Report::all()
        );

        return view('report.index',$data);

    }

    public function save(Request $request)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
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
