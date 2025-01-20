
<?php

use App\Http\Controllers\Controller;
/*use App\Http\Controllers\ProductController;*/
use App\Http\Controllers\TransaksiAdminController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TransaksiController::class, 'index'])->name('home');
Route::POST('/addTocart', [TransaksiController::class, 'addTocart'])->name('addTocart');
Route::POST('/storePelanggan', [UserController::class, 'storePelanggan'])->name('storePelanggan');
Route::POST('/login_pelanggan', [UserController::class, 'loginProses'])->name('loginproses.pelanggan');
Route::GET('/logout_pelanggan', [UserController::class, 'logout'])->name('logout.pelanggan');

Route::get('/shop', [Controller::class, 'shop'])->name('shop');
Route::get('/transaksi', [Controller::class, 'transaksi'])->name('transaksi');
Route::get('/contact', [Controller::class, 'contact'])->name('contact');

Route::get('/checkout', [Controller::class, 'checkout'])->name('checkout');
Route::POST('/checkout/proses/{id}', [Controller::class, 'prosesCheckout'])->name('checkout.product');
Route::POST('/checkout/prosesPembayaran', [Controller::class, 'prosesPembayaran'])->name('checkout.bayar');
Route::get('/checkOut', [Controller::class, 'keranjang'])->name('keranjang');
Route::get('/checkOut/{id}', [Controller::class, 'bayar'])->name('keranjang.bayar');


Route::get('/admin', [Controller::class, 'login'])->name('login');
Route::POST('/admin/loginProses', [Controller::class, 'loginProses'])->name('loginProses');


    Route::get('/admin/dashboard', [Controller::class, 'admin'])->name('admin');
    Route::get('/admin/product', [ProductController::class, 'index'])->name('product');
    Route::get('/admin/logout', [Controller::class, 'logout'])->name('logout');
    Route::get('/admin/report', [Controller::class, 'report'])->name('report');
    Route::get('/admin/addModal', [ProductController::class, 'addModal'])->name('addModal');

    Route::GET('/admin/user_management', [UserController::class, 'index'])->name('userManagement');
    Route::GET('/admin/user_management/addModalUser', [UserController::class, 'addModalUser'])->name('addModalUser');
    Route::POST('/admin/user_management/addData', [UserController::class, 'store'])->name('addDataUser');
    Route::get('/admin/user_management/editUser/{id}', [UserController::class, 'show'])->name('showDataUser');
    Route::PUT('/admin/user_management/updateDataUser/{id}', [UserController::class, 'update'])->name('updateDataUSer');
    Route::DELETE('/admin/user_management/deleteUSer/{id}', [UserController::class, 'destroy'])->name('destroyDataUser');

    Route::POST('/admin/addData', [ProductController::class, 'store'])->name('addData');
    Route::GET('/admin/editModal/{id}', [ProductController::class, 'show'])->name('editModal');
    Route::PUT('/admin/updateData/{id}', [ProductController::class, 'update'])->name('updateData');
    Route::delete('/admin/deleteData/{id}', [ProductController::class, 'destroy'])->name('deleteData');


    Route::GET('/admin/transaksi', [TransaksiAdminController::class, 'index'])->name('transaksi.admin');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');


    Route::get('/report/transaksi', [ReportController::class, 'transaksiReport'])->name('report.transaksi_report');
    Route::get('/report/product', [ReportController::class, 'showProductReport'])->name('report.product_report');

Route::get('/admin/report', [ReportController::class, 'showReport'])->name('admin.report.show');

Route::get('/paypal/success/{id}', [TransaksiController::class, 'paypalSuccess'])->name('paypal.success');
Route::get('/paypal/cancel/{id}', [TransaksiController::class, 'paypalCancel'])->name('paypal.cancel');

Route::prefix('admin')->name('admin.')->group(function () {
   
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/admin/products/data', [ProductController::class, 'getProductData'])->name('admin.products.data');

    Route::get('products/create', [ProductController::class, 'addModal'])->name('products.create'); 
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store'); 
 Route::get('products/edit/{id}', [ProductController::class, 'show'])->name('products.edit');
    Route::put('products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/delete/{id}', [ProductController::class, 'destroy'])->name('products.delete'); 
});

Route::get('/admin/products/data', [ProductController::class, 'getProductsData'])->name('admin.products.data');
Route::get('/admin/products/add-modal', [ProductController::class, 'addModal'])->name('addModal');
Route::get('/admin/products/edit-modal/{id}', [ProductController::class, 'editModal'])->name('editModal');

Route::delete('/admin/products/delete/{id}', [ProductController::class, 'destroy'])->name('admin.products.delete');
