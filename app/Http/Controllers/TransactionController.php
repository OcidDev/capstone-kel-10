<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
   public function index()
    {
        $data = array(
            'title' => 'Halaman Transaksi',
            'judul' => 'Transaksi',
            'menu' => 'transaksi',
            'sub_menu' => '',
        );

        return view('transaction.index',$data);
    }
}
