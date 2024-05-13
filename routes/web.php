<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersManagementController;
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

    Route::controller(PanierController::class)->prefix('panier')->group(function () {
        Route::get('', 'index')->name('panier.index');
        Route::post('add', 'add')->name('panier.add');
        Route::post('remove', 'remove')->name('panier.remove');
        Route::post('update', 'update')->name('panier.update');
    });

    Route::controller(CommandeController::class)->prefix('commandes')->group(function () {
        Route::get('', 'index')->name('commandes.index');
        //Action d'ajout de la commande
        Route::post('add', 'store')->name('commandes.add');
    });

    Route::controller(AdminController::class)->prefix('dashboard')->middleware(CheckRole::class . ':admin')->group(function () {
        Route::get('', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('users', [UsersManagementController::class, 'usersManagement'])->name('users-management');
    });
});

Route::resource('produits',ProduitController::class)->names('produits');
Route::post("produits/results", [ProduitController::class, 'filters'])->name("produits.filters.result");
