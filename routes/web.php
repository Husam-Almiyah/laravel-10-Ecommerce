<?php

use App\Http\Controllers\CartIndexController;
use App\Http\Controllers\CategoryShowController;
use App\Http\Controllers\CheckoutIndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderConfirmationIndexController;
use App\Http\Controllers\ProductShowController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomeController::class)->name('home');

Route::get('/cart', CartIndexController::class)->name('cart');

Route::get('/checkout', CheckoutIndexController::class)->name('checkout');

Route::get('/categories/{category:slug}', CategoryShowController::class);

Route::get('/products/{product:slug}', ProductShowController::class);

Route::get('/orders/{order:uuid}/confirmation', OrderConfirmationIndexController::class)
    ->name('orders.confirmation');

Route::get('/orders', function () {

})->name('orders');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
