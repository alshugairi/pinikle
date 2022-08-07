<?php

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {

    Auth::routes();

    Route::get('/', [App\Http\Controllers\Front\PageController::class, 'home'])->name('home');
    Route::get('product/{id}', [App\Http\Controllers\Front\PageController::class, 'singleProduct'])->name('single_product');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('success-payment', [App\Http\Controllers\Front\PageController::class, 'successPayment'])->name('success_payment');
        Route::get('failed-payment', [App\Http\Controllers\Front\PageController::class, 'failedPayment'])->name('failed_payment');
        Route::get('cancelled-payment', [App\Http\Controllers\Front\PageController::class, 'cancelledPayment'])->name('cancelled_payment');

        Route::post('get-pinikle-payments-list', [App\Http\Controllers\Front\PageController::class, 'piniklePaymentsList'])->name('pinikle_payments_list');
        Route::get('checkout', [App\Http\Controllers\Front\PageController::class, 'checkout'])->name('checkout');
        Route::post('checkout', [App\Http\Controllers\Front\PageController::class, 'postCheckout'])->name('checkout.post');
        Route::get('cart', [App\Http\Controllers\Front\CartController::class, 'index'])->name('cart.index');
        Route::post('add-to-cart/{id}', [App\Http\Controllers\Front\CartController::class, 'add'])->name('cart.add');
        Route::get('delete-from-cart/{id}', [App\Http\Controllers\Front\CartController::class, 'delete'])->name('cart.delete');
    });
});
