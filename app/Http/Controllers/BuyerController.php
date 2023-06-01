<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use Illuminate\Support\Facades\Storage;

class BuyerController extends Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Halaman Pembeli',
            'judul' => 'Pembeli',
            'sub_menu' => 'pembeli',
            'menu' => 'master',
            'data_pembeli' => Buyer::all(),
        );

        return view('pembeli.index',$data);

    }

    public function save(Request $request)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
        ];

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ],$pesan);



        Buyer::create($data);

         return back()->with('success','Data buyer Berhasil Ditambahkan');
    }

    public function edit(Request $request, $id)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',

        ];

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ],$pesan);

        Buyer::find($id)->update($data);
        return back()->with('success','Data Pembeli Berhasil Diubah');
    }


     public function delete($id)
    {
        Buyer::find($id)->delete();
        return back()->with('success','Data Pembeli Berhasil Dihapus');
    }
}
