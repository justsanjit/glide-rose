<?php

use App\Http\Controllers\OrderConfirmationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ProductController::class, 'index'])->name('products');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('products/{product}/order', [OrderController::class, 'store'])->name('orders.store');

    Route::get('/order-confirmation/{order}', OrderConfirmationController::class)->name('order-confirmation');
});
