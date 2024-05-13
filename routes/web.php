<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

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
});

Route::resource('produits',ProduitController::class)->names('produits');
