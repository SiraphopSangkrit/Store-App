<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StorageController;

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
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/storages',[StorageController::class,'StorageIndex'])->name('storages.index');
    Route::post('/storages',[StorageController::class,'StorageStore'])->name('storages.store');
    Route::get('/category',[StorageController::class,'CategoryIndex'])->name('category.index');
    Route::post('/category',[StorageController::class,'CategoryStore'])->name('category.store');
});
// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
// ->get('/storages', [StorageController::class, 'index'])
// ->name('storages.index');
