<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/cart/{id}', [CartController::class, 'store'])->name('cart.add');
Route::middleware('auth:api')->put('/cart/{id}', [CartController::class, 'update'])->name('cart.more');
Route::middleware('auth:api')->delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.less');
