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
        // dd($request->all());
        $data = $request->validate([
            'status' => 'required',
            'total' => 'required|numeric:min:1',
            'description' => 'required',
        ]);
        $data['total'];
        $lastBalance = Report::orderByDesc('created_at')->select('saldo')->first();
        if ($lastBalance == null) {
            $saldo = 0;
        } else {
            $saldo = $lastBalance->saldo;
        }

        if($saldo == 0 || $saldo < $data['total']){
            if($request->status == 'Kredit'){
                return back()->with('danger', 'Saldo Tidak Mencukupi');
            }
        }
        if($request->status == 'Debit'){
            $save = Report::create([
                'kredit'=>0,
                'profit'=>0,
                'debit'=> $data['total'],
                'saldo'=>$saldo + $data['total'],
                'description'=>$data['description']
            ]);
        }else if($request->status == 'Kredit'){
            $save = Report::create([
                'kredit'=>$data['total'],
                'profit'=>0,
                'debit'=>0,
                'saldo'=>$saldo - $data['total'],
                'description'=>$data['description']
            ]);
        }
        if($save){
            return back()->with('success','Data Laporan Berhasil Ditambahkan');
        }else{
            return back()->with('danger','Data Laporan Gagal Ditambahkan');
        }
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
