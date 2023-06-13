<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Halaman Pengguna',
            'judul' => 'Pengguna',
            'sub_menu' => 'pengguna',
            'menu' => 'master',
            'data_pengguna' => User::all(),
        );

        return view('pengguna.index',$data);

    }

    public function save(Request $request)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
        ];

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],$pesan);



        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return back()->with('success','Data user Berhasil Ditambahkan');
    }

    public function edit(Request $request, $id)
    {

        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',

        ];
        $user = User::find($id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ],$pesan);
        if($request->password != null){
            $data['password'] = Hash::make($request->password);
        }else{
            $data['password'] = $user->password;
        }
        User::find($id)->update($data);
        return back()->with('success','Data Pengguna Berhasil Diubah');
    }


     public function delete($id)
    {
        User::find($id)->delete();
        return back()->with('success','Data Pengguna Berhasil Dihapus');
    }
}
