<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    'roles:superadmin|admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [StorageController::class, 'dashboard'])->name('dashboard');
    //Storages Route
    Route::get('/storages', [StorageController::class, 'StorageIndex'])->name('storages.index');
    Route::post('/storages', [StorageController::class, 'StorageStore'])->name('storages.store');
    Route::patch('/storages/{id}', [StorageController::class, 'StorageUpdate'])->name('storages.update');
    Route::delete('/storages/{id}', [StorageController::class, 'StorageDestroy'])->name('storages.destroy');
    //Category Route
    Route::get('/category', [StorageController::class, 'CategoryIndex'])->name('category.index');
    Route::post('/category', [StorageController::class, 'CategoryStore'])->name('category.store');
    Route::delete('/category/{id}', [StorageController::class, 'CategoryDestroy'])->name('category.destroy');
    //Order Route
    Route::get('/orders', [OrderController::class, 'OrderIndex'])->name('order.index');
    //User Route;
    Route::get('/users', [UserController::class, 'UserIndex'])->name('user.index');
    Route::post('/users', [UserController::class, 'UserStore'])->name('user.store');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome');
    });
});
