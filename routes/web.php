<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SalaireController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('salaires', SalaireController::class);
Route::resource('depenses', DepenseController::class);

Route::middleware(['auth'])->group(function () {
    // Routes du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
