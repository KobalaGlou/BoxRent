<?php

use App\Http\Controllers\BoxsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/box/index',[BoxsController::class,'index'])->name('boxs.index');
    Route::get('/boxs/create', [BoxsController::class, 'create'])->name('boxs.create');
    Route::post('/boxs', [BoxsController::class, 'store'])->name('boxs.store');
    Route::get('/boxs/{id}/edit', [BoxsController::class, 'edit'])->name('boxs.edit');
    Route::put('/boxs/{id}', [BoxsController::class, 'update'])->name('boxs.update');
    Route::delete('/boxs/{id}', [BoxsController::class, 'destroy'])->name('boxs.destroy');
});

require __DIR__.'/auth.php';
