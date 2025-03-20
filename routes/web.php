<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;

Route::get('/', function () {
    return view('home');
});
Route::prefix('tiket')->name('tiket.')->group(function () {
    Route::get('/', [TiketController::class, 'index'])->name('index');
    Route::get('/tambah', [TiketController::class, 'create'])->name('create');
    Route::post('/store', [TiketController::class, 'store'])->name('store');
    Route::get('/{id}', [TiketController::class, 'edit'])->name('edit');
    Route::post('/{id}', [TiketController::class, 'update'])->name('update');
    Route::get('/{id}', [TiketController::class, 'destroy'])->name('destroy');
});
