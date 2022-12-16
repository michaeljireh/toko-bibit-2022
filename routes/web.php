<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OlahanController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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
Route::get('/', function(){
  return view('landingPage');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/detail-menu/{id}', [MenuController::class, 'show'])->name('home.menu');
Route::get('/detail-product/{id}', [OlahanController::class, 'show'])->name('home.product');

Route::get('/checkout', [CartController::class, 'index'])->middleware(['auth'])->name('home.checkout');
Route::post('/checkout', [OrderController::class, 'store'])->middleware(['auth'])->name('home.checkout.post');
Route::patch('/checkout/{id}', [OrderController::class, 'updateBuktiBayar'])->middleware(['auth'])->name('home.checkout.put');

Route::get('/order', [HomeController::class, 'showOrder'])->middleware(['auth'])->name('home.order');
Route::get('/order/{id}', [HomeController::class, 'detailOrder'])->middleware(['auth'])->name('home.order.detail');
Route::delete('/order/{id}', [OrderController::class, 'destroy'])->middleware(['auth'])->name('home.order.destroy');

Route::get('/profile', [UserController::class, 'index'])->middleware(['auth'])->name('profile');

Route::group(['middleware' => ['role:admin']], function () {

  Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

  Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin');
  Route::get('/laporan', [AdminController::class, 'report'])->middleware(['auth'])->name('admin.report');
  Route::get('/cetak-laporan', [AdminController::class, 'print'])->middleware(['auth'])->name('admin.report.print');

  Route::get('/order-list', [OrderController::class, 'index'])->middleware(['auth'])->name('order.index');
  Route::get('/order-list/{id}', [OrderController::class, 'show'])->middleware(['auth'])->name('order.detail');
  Route::post('/order-list/{id}', [OrderController::class, 'update'])->middleware(['auth'])->name('order.update');

  Route::get('/menu', [MenuController::class, 'index'])->middleware(['auth'])->name('menu.index');
  Route::get('/menu/create', [MenuController::class, 'create'])->middleware(['auth'])->name('menu.create');
  Route::post('/menu', [MenuController::class, 'store'])->middleware(['auth'])->name('menu.store');
  Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])->middleware(['auth'])->name('menu.edit');
  Route::patch('/menu/{id}', [MenuController::class, 'update'])->middleware(['auth'])->name('menu.update');
  Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->middleware(['auth'])->name('menu.destroy');

  Route::get('/jenis-olah', [TypeController::class, 'create'])->middleware(['auth'])->name('type.create');
  Route::post('/jenis-olah', [TypeController::class, 'store'])->middleware(['auth'])->name('type.store');
  Route::get('/jenis-olah/{id}', [TypeController::class, 'edit'])->middleware(['auth'])->name('type.edit');
  Route::patch('/jenis-olah/{id}', [TypeController::class, 'update'])->middleware(['auth'])->name('type.update');
  Route::delete('/jenis-olah/{id}', [TypeController::class, 'destroy'])->middleware(['auth'])->name('type.destroy');

  Route::get('/product', [OlahanController::class, 'index'])->middleware(['auth'])->name('process.index');
  Route::get('/product/{id}', [OlahanController::class, 'create'])->middleware(['auth'])->name('process.create');
  Route::post('/product/{id}', [OlahanController::class, 'store'])->middleware(['auth'])->name('process.store');
  Route::get('/product/{id}/edit', [OlahanController::class, 'edit'])->middleware(['auth'])->name('process.edit');
  Route::patch('/product/{id}', [OlahanController::class, 'update'])->middleware(['auth'])->name('process.update');
  Route::delete('/product/{id}', [OlahanController::class, 'destroy'])->middleware(['auth'])->name('process.destroy');
});

require __DIR__ . '/auth.php';
