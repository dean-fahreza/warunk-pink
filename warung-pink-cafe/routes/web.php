<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/category', [UserController::class, 'category'])->name('category');
Route::get('/cart',[UserController::class,'cart'])->name('cart');
Route::get('/confirm',[UserController::class,'confirm'])->name('confirm');
Route::get('/finish',[UserController::class,'finish'])->name('finish');
Route::post('/addcart',[UserController::class,'addCart'])->name('addcart');
Route::post('/editqty',[UserController::class,'editqty'])->name('editqty');
Route::post('/editcatatan',[UserController::class,'editcatatan'])->name('editcatatan');
Route::get('/search',[UserController::class,'search'])->name('search');
Route::post('/transaksi',[UserController::class,'transaksi'])->name('transaksi');
Route::get('/transaksi/{order}',[UserController::class,'transaksiresult'])->name('transaksi.result');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/orderhistory', [AdminController::class, 'history'])->name('history');
    Route::get('/menuadmin', [AdminController::class, 'menu'])->name('menuadmin');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/menuadmin',[MenuController::class,'store'])->name('menuadmin.store');
    Route::post('/menuadmin/update',[MenuController::class,'update'])->name('menuadmin.update');
    Route::put('/orderupdate/{order}',[OrderController::class, 'update'])->name("order.update");
    Route::get('/daftarmenu',[MenuController::class,'index'])->name('daftarmenu');
    Route::post('/menuadmin/tersedia/{menu}',[AdminController::class,'menutersedia'])->name('menu.tersedia');
});

require __DIR__.'/auth.php';
