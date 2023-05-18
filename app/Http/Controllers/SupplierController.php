<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{

    
    
    public function index()
    {
        $data = array(
            'title' => 'Halaman Supplier',
            'judul' => 'Supplier',
            'sub_menu' => 'supplier',
            'menu' => 'master',
            'data_supplier' => Supplier::all()
        );

        return view('supplier.index',$data);
        
    }

     public function save(Request $request)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
        ];

        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ],$pesan);



        Supplier::create([
            'name'=>$validated['name'],
            'phone'=>$validated['phone'],
            'address'=>$validated['address']
        ]);

         return back()->with('success','Data Supplier Berhasil Ditambahkan');
    }

    public function edit(Request $request, $id)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
          
        ];

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ],$pesan);

        Supplier::find($id)->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address
        ]);
        return back()->with('success','Data Supplier Berhasil Diubah');
    }


     public function delete($id)
    {
        Supplier::find($id)->delete();
        return back()->with('success','Data Supplier Berhasil Dihapus');
    }
}
