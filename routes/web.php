<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SalaireController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\HomeController;

// Routes publiques
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    }
    return redirect()->route('login');
});

// Routes d'authentification (accessibles sans authentification)
Route::middleware(['web'])->group(function () {
    Auth::routes();
});

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    // Page d'accueil - accessible à tous les utilisateurs authentifiés
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Dashboard admin - accessible uniquement aux admins
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
        ->name('admin.dashboard')
        ->middleware([\Spatie\Permission\Middleware\RoleMiddleware::class . ':admin']);

    // Routes de gestion des rôles et permissions
    Route::middleware([\Spatie\Permission\Middleware\RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/roles-permissions', [RolePermissionController::class, 'index'])
            ->name('roles-permissions.index');
        Route::post('/roles-permissions', [RolePermissionController::class, 'storeRole'])
            ->name('roles-permissions.store');
        Route::put('/roles-permissions/{role}', [RolePermissionController::class, 'updateRole'])
            ->name('roles-permissions.update');
        Route::post('/roles-permissions/assign/{user}', [RolePermissionController::class, 'assignRole'])
            ->name('roles-permissions.assign');
    });

    // Routes des salaires - protégées par permissions
    Route::middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':view_salaires'])->group(function () {
        Route::get('/salaires', [SalaireController::class, 'index'])->name('salaires.index');
        Route::get('/salaires/create', [SalaireController::class, 'create'])->name('salaires.create')
            ->middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':create_salaires']);
        Route::post('/salaires', [SalaireController::class, 'store'])->name('salaires.store')
            ->middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':create_salaires']);
        Route::get('/salaires/{salaire}', [SalaireController::class, 'show'])->name('salaires.show');
        Route::get('/salaires/{salaire}/edit', [SalaireController::class, 'edit'])->name('salaires.edit')
            ->middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':edit_salaires']);
        Route::put('/salaires/{salaire}', [SalaireController::class, 'update'])->name('salaires.update')
            ->middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':edit_salaires']);
        Route::delete('/salaires/{salaire}', [SalaireController::class, 'destroy'])->name('salaires.destroy')
            ->middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':delete_salaires']);
    });

    // Routes des dépenses - protégées par permissions
    Route::middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':view_depenses'])->group(function () {
        Route::get('/depenses', [DepenseController::class, 'index'])->name('depenses.index');
        Route::get('/depenses/create', [DepenseController::class, 'create'])->name('depenses.create')
            ->middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':create_depenses']);
        Route::post('/depenses', [DepenseController::class, 'store'])->name('depenses.store')
            ->middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':create_depenses']);
        Route::get('/depenses/{depense}', [DepenseController::class, 'show'])->name('depenses.show');
        Route::get('/depenses/{depense}/edit', [DepenseController::class, 'edit'])->name('depenses.edit')
            ->middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':edit_depenses']);
        Route::put('/depenses/{depense}', [DepenseController::class, 'update'])->name('depenses.update')
            ->middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':edit_depenses']);
        Route::delete('/depenses/{depense}', [DepenseController::class, 'destroy'])->name('depenses.destroy')
            ->middleware([\Spatie\Permission\Middleware\PermissionMiddleware::class . ':delete_depenses']);
    });

    // Routes du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
