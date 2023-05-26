<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
  Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('', 'index')->name('dashboard');
  });

  Route::controller(CategoryController::class)->prefix('category')->group(function () {
    Route::get('', 'index')->name('category');
    Route::get('', 'index')->name('category');
    Route::post('save', 'save')->name('category.save');
    Route::post('edit/{id}', 'edit')->name('category.edit');
    Route::delete('delete/{id}', 'delete')->name('category.delete');
  });

  Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('', 'index')->name('product');
    Route::post('save', 'save')->name('product.save');
    Route::post('edit/{id}', 'edit')->name('product.edit');
    Route::delete('delete/{id}', 'delete')->name('product.delete');
  });

  Route::controller(ShelvesController::class)->prefix('shelves')->group(function () {
    Route::get('', 'index')->name('shelves');
    Route::post('save', 'save')->name('shelves.save');
    Route::post('edit/{id}', 'edit')->name('shelves.edit');
    Route::delete('delete/{id}', 'delete')->name('shelves.delete');
  });

  Route::controller(SupplierController::class)->prefix('supplier')->group(function () {
    Route::get('', 'index')->name('supplier');
    Route::post('save', 'save')->name('supplier.save');
    Route::post('edit/{id}', 'edit')->name('supplier.edit');
    Route::delete('delete/{id}', 'delete')->name('supplier.delete');
  });

  Route::get('/debit', [TransactionController::class, 'debit'])->name('debit');
  Route::get('/paid_off', [TransactionController::class, 'paid_off'])->name('paid_off');
  Route::get('/list_detail/{id}', [TransactionController::class, 'list_detail'])->name('list_detail');

  Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
    Route::get('', 'index')->name('transaction');
    Route::get('cek_produk', 'CekProduk')->name('cek_produk');
    Route::post('cek_produk', 'CekProduk')->name('cek_produk');
    Route::get('add_cart', 'add_cart')->name('transaction.add_cart');
    Route::post('add_cart', 'add_cart')->name('transaction.add_cart');
    Route::post('save_transaction', 'save_transaction')->name('transaction.save_transaction');
    Route::delete('remove_item/{rowId}', 'remove_item')->name('transaction.remove_item');
    Route::get('status_lunas/{id}', 'status_lunas')->name('status_lunas');

  });

  Route::resource('inventory', InventoryController::class);
});

Auth::routes();

// Route::get('login', [AuthController::class, 'index'])->name('login');
// Route::post('login', [AuthController::class, 'login'])->name('login');

// Route::get('register', [AuthController::class, 'register_view'])->name('register');
// Route::post('register', [AuthController::class, 'register'])->name('register');

// Route::get('home', [AuthController::class, 'home'])->name('home');
// Route::get('logout', [AuthController::class, 'logout'])->name('logout');
