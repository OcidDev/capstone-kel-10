<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShelvesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\TransactionController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->name('index');
  Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
  Route::post('/profile', [DashboardController::class, 'update'])->name('update.profile');
  Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('', 'index')->name('dashboard');
  });

  Route::controller(CategoryController::class)->middleware('isAdmin')->prefix('category')->group(function () {
    Route::get('', 'index')->name('category');
    Route::get('', 'index')->name('category');
    Route::post('save', 'save')->name('category.save');
    Route::post('edit/{id}', 'edit')->name('category.edit');
    Route::delete('delete/{id}', 'delete')->name('category.delete');
  });

  Route::controller(ProductController::class)->middleware('isAdmin')->prefix('product')->group(function () {
    Route::get('', 'index')->name('product');
    Route::post('save', 'save')->name('product.save');
    Route::post('edit/{id}', 'edit')->name('product.edit');
    Route::delete('delete/{id}', 'delete')->name('product.delete');
  });

  Route::controller(ShelvesController::class)->middleware('isAdmin')->prefix('shelves')->group(function () {
    Route::get('', 'index')->name('shelves');
    Route::post('save', 'save')->name('shelves.save');
    Route::post('edit/{id}', 'edit')->name('shelves.edit');
    Route::delete('delete/{id}', 'delete')->name('shelves.delete');
  });

  Route::controller(ReportController::class)->middleware('isAdmin')->prefix('report')->group(function () {
    Route::get('', 'index')->name('report');
    Route::post('save', 'save')->name('report.save');
    Route::post('edit/{id}', 'edit')->name('report.edit');
    Route::delete('delete/{id}', 'delete')->name('report.delete');
  });

  Route::controller(BuyerController::class)->middleware('isAdmin')->prefix('buyer')->group(function () {
    Route::get('', 'index')->name('buyer');
    Route::post('save', 'save')->name('buyer.save');
    Route::post('edit/{id}', 'edit')->name('buyer.edit');
    Route::delete('delete/{id}', 'delete')->name('buyer.delete');
  });

  Route::controller(UserController::class)->middleware('isAdmin')->prefix('user')->group(function () {
    Route::get('', 'index')->name('user');
    Route::post('save', 'save')->name('user.save');
    Route::post('edit/{id}', 'edit')->name('user.edit');
    Route::delete('delete/{id}', 'delete')->name('user.delete');
  });

  Route::controller(SupplierController::class)->middleware('isAdmin')->prefix('supplier')->group(function () {
    Route::get('', 'index')->name('supplier');
    Route::post('save', 'save')->name('supplier.save');
    Route::post('edit/{id}', 'edit')->name('supplier.edit');
    Route::delete('delete/{id}', 'delete')->name('supplier.delete');
  });

  Route::get('/debit', [TransactionController::class, 'debit'])->middleware('isAdmin')->name('debit');
  Route::get('/paid_off', [TransactionController::class, 'paid_off'])->middleware('isAdmin')->name('paid_off');
  Route::get('/list_detail/{id}', [TransactionController::class, 'list_detail'])->middleware('isAdmin')->name('list_detail');

  Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
    Route::get('', 'index')->name('transaction');
    Route::get('cek_produk', 'CekProduk')->name('cek_produk');
    Route::post('cek_produk', 'CekProduk')->name('cek_produk');
    Route::get('add_cart', 'add_cart')->name('transaction.add_cart');
    Route::post('add_cart', 'add_cart')->name('transaction.add_cart');
    Route::post('save_transaction', 'save_transaction')->name('transaction.save_transaction');
    Route::delete('remove_item/{rowId}', 'remove_item')->name('transaction.remove_item');
    Route::get('status_lunas/{id}', 'status_lunas')->name('transaction.status_lunas');

  });


  Route::get('/inventory_debit', [InventoryController::class, 'debit'])->middleware('isAdmin')->name('inventory_debit');
  Route::get('/inventory_paid_off', [InventoryController::class, 'paid_off'])->middleware('isAdmin')->name('inventory_paid_off');
  Route::get('/inventory_list_detail/{id}', [InventoryController::class, 'list_detail'])->middleware('isAdmin')->name('inventory_list_detail');

  Route::controller(InventoryController::class)->middleware('isAdmin')->prefix('inventory')->group(function () {
    Route::get('', 'index')->name('inventory');
    Route::get('cek_produk', 'CekProduk')->name('cek_produk');
    Route::post('cek_produk', 'CekProduk')->name('cek_produk');
    Route::get('add_cart', 'add_cart')->name('inventory.add_cart');
    Route::post('add_cart', 'add_cart')->name('inventory.add_cart');
    Route::post('save_inventory', 'save_inventory')->name('inventory.save_inventory');
    Route::delete('remove_item/{rowId}', 'remove_item')->name('inventory.remove_item');
    Route::get('status_lunas/{id}', 'status_lunas')->name('inventory.status_lunas');

  });

//   Route::resource('inventory', InventoryController::class);
});

Auth::routes();

// Route::get('login', [AuthController::class, 'index'])->name('login');
// Route::post('login', [AuthController::class, 'login'])->name('login');

// Route::get('register', [AuthController::class, 'register_view'])->name('register');
// Route::post('register', [AuthController::class, 'register'])->name('register');

// Route::get('home', [AuthController::class, 'home'])->name('home');
// Route::get('logout', [AuthController::class, 'logout'])->name('logout');
