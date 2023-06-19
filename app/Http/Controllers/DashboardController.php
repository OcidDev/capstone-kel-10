<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\User;
use App\Models\Product;
use App\Models\Shelves;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
Use Alert;

class DashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = array(
            'title' => 'Halaman Dashboard',
            'judul' => 'Dashboard',
            'menu' => 'dashboard',
            'sub_menu' => '',
            'products' => Product::count(),
            'categories' => Category::count(),
            'shelves' => Shelves::count(),
            'suppliers' => Supplier::count(),
            'transactions_lunas' => Transaction::where('status','LUNAS')->count(),
            'transactions_lunas_total' => Transaction::where('status', 'LUNAS')->sum('total'),
            'transactions_offpaid' => Transaction::where('status','BELUM LUNAS')->count(),
            'transactions_offpaid_total' => Transaction::where('status', 'BELUM LUNAS')->sum('total'),
            'product_kritis' => Product::all()->where('stock','<=',20),
        );
        return view('dashboard', $data);
    }

    public function profile()
    {
        $data = array(
            'title' => 'Halaman Profile',
            'judul' => 'Profile',
            'menu' => 'profile',
            'profile' => User::Find(Auth::user()->id),
            'sub_menu' => '',
        );
        return view('profile', $data);
    }
    public function update(){
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',

        ];
        $user = User::find($id);
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ],$pesan);
        if($request->password != null){
            $data['password'] = Hash::make($request->password);
        }else{
            $data['password'] = $user->password;
        }
        User::find($id)->update($data);
        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('profile');
    }
}
