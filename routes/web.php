<?php

use App\Http\Controllers\BoxsController;
use App\Http\Controllers\LocataireController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContratController;

use Illuminate\Support\Facades\Route;

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

    Route::get('/locs',[LocataireController::class,'index'])->name('locs.index');
    Route::get('/locs/create', [LocataireController::class, 'create'])->name('locs.create');
    Route::post('/locs', [LocataireController::class, 'store'])->name('locs.store');
    Route::get('/locs/{id}/edit', [LocataireController::class, 'edit'])->name('locs.edit');
    Route::put('/locs/{id}', [LocataireController::class, 'update'])->name('locs.update');
    Route::delete('/locs/{id}', [LocataireController::class, 'destroy'])->name('locs.destroy');

    Route::get('/contrats', [ContratController::class, 'index'])->name('contrats.index'); // Liste des contrats
    Route::get('/contrats/create', [ContratController::class, 'create'])->name('contrats.create'); // Formulaire de création
    Route::post('/contrats', [ContratController::class, 'store'])->name('contrats.store'); // Enregistrement d'un contrat
    Route::get('/contrats/{contrat}/edit', [ContratController::class, 'edit'])->name('contrats.edit'); // Formulaire de modification
    Route::put('/contrats/{contrat}', [ContratController::class, 'update'])->name('contrats.update'); // Mise à jour d'un contrat
    Route::delete('/contrats/{contrat}', [ContratController::class, 'destroy'])->name('contrats.destroy'); // Suppression d'un contrat
});

require __DIR__.'/auth.php';
