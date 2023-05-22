<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Product;
use App\Models\Shelves;
use App\Models\Category;
use App\Models\Supplier;
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
        );

        return view('dashboard',$data);
    }
}
