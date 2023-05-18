<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rak;
use App\Models\Supplier;

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
            'raks' => Rak::count(),
            'suppliers' => Supplier::count(),
        );

        return view('dashboard',$data);
    }
}
