<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersManagementController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/moncompte', [App\Http\Controllers\UserController::class, 'index'])->name('account');

    Route::controller(BasketController::class)->prefix('panier')->group(function () {
        Route::get('', 'index')->name('basket.index');
        Route::post('add', 'add')->name('basket.add');
        Route::post('remove', 'remove')->name('basket.remove');
        Route::post('update', 'update')->name('basket.update');
    });

    Route::controller(OrderController::class)->prefix('commandes')->group(function () {
        Route::get('', 'index')->name('orders.index');
        //Action d'ajout de la commande
        Route::post('add', 'store')->name('orders.add');
    });

    Route::controller(AdminController::class)->prefix('dashboard')->middleware(CheckRole::class . ':admin')->group(function () {
        Route::get('', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('users', [UsersManagementController::class, 'usersManagement'])->name('users-management');
    });
});

Route::resource('produits',ProductController::class)->names('products');
Route::post("products/results", [ProductController::class, 'filters'])->name("products.filters.result");
