<?php

use App\Http\Controllers\PannierController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/moncompte', [App\Http\Controllers\UserController::class, 'index'])->name('account');

    Route::controller(PannierController::class)->prefix('pannier')->group(function () {
        Route::get('', 'index')->name('pannier.index');
        Route::post('add', 'add')->name('pannier.add');
        Route::post('remove', 'remove')->name('pannier.remove');
        Route::post('update', 'update')->name('pannier.update');
    });
});

Route::resource('produits',ProduitController::class)->names('produits');
