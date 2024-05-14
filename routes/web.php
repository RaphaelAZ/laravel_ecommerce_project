<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersManagementController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/moncompte', [UserController::class, 'index'])->name('account');

    Route::controller(BasketController::class)->prefix('panier')->group(function () {
        Route::get('', 'index')->name('basket.index');
        Route::post('add', 'add')->name('basket.add');
        Route::post('remove', 'remove')->name('basket.remove');
        Route::post('update', 'update')->name('basket.update');
    });

    Route::controller(OrderController::class)->prefix('commandes')->group(function () {
        Route::get('', 'index')->name('orders.index');
        //Action of adding the order
        Route::post('add', 'store')->name('orders.add');
    });

    Route::controller(AdminController::class)->prefix('dashboard')->middleware(CheckRole::class . ':admin')->group(function () {
        Route::get('', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('users', [UsersManagementController::class, 'usersManagement'])->name('users-management');
    });
});

Route::prefix('produits')->group(function () {
    Route::resource('', ProductController::class)->names('products');
    Route::post("resultat", [ProductController::class, 'filters'])->name("products.filters.result");
    Route::get("{category}", [ProductController::class, 'category'])->name("products.category");
});

