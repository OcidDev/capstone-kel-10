<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Product;
use App\Models\Shelves;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
Use Alert;

class DashboardController extends Controller
{


    public function __construct()
    {
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
}
