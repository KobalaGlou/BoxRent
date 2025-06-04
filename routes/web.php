<?php

use App\Http\Controllers\BoxsController;
use App\Http\Controllers\LocataireController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ImpotsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/test', function () {
    return Inertia::render('Auth/Welcome');
})->name('home');

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('boxes')->name('boxes.')->controller(BoxsController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('locataires')->name('locataires.')->controller(LocataireController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::get('/export', 'export')->name('export');
    });

    Route::prefix('contrats')->name('contrats.')->controller(ContratController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{contrat}/edit', 'edit')->name('edit');
        Route::put('/{contrat}', 'update')->name('update');
        Route::delete('/{contrat}', 'destroy')->name('destroy');
    });

    Route::get('/contrats/render/{template}/{contrat}', [TemplateController::class, 'showContratTemplate'])
        ->name('contrats.render');

    Route::post('/factures/generer', [FactureController::class, 'genererFactures'])->name('factures.generer');

    Route::prefix('templates')->name('templates.')->controller(TemplateController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{template}/edit', 'edit')->name('edit');
        Route::put('/{template}', 'update')->name('update');
        Route::delete('/{template}', 'destroy')->name('destroy');
    });

    Route::prefix('factures')->name('factures.')->controller(FactureController::class)->group(function () {
        Route::get('/impayes', 'impayes')->name('impayes');
        Route::get('/historique', 'historique')->name('historique');
        Route::put('/{facture}', 'update')->name('update');
    });

    Route::get('/impots', [ImpotsController::class, 'index'])->name('impots.index');
});

require __DIR__ . '/auth.php';
