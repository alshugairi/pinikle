<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {

    Route::get('admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login');
    Route::post('admin/login', [App\Http\Controllers\Admin\AuthController::class, 'postLogin'])->name('admin.postLogin');
    Route::post('admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => 'admin', 'as' => 'admin.', 'prefix' => 'admin'], function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');

        Route::get('invoices/list', [App\Http\Controllers\Admin\InvoiceController::class, 'list'])->name('invoices.list');
        Route::resource('invoices', App\Http\Controllers\Admin\InvoiceController::class);

        Route::get('products/list', [App\Http\Controllers\Admin\ProductController::class, 'list'])->name('products.list');
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

        Route::get('users/list', [App\Http\Controllers\Admin\UserController::class, 'list'])->name('users.list');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    });

});
