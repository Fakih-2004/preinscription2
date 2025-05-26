<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttestationController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\CandidatformController;
use App\Http\Controllers\DashboardController;


use App\Mail\InscriptionConfirmation;

use App\Http\Controllers\ExportController;
use App\Livewire\FormationStats;


require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Breeze default welcome and dashboard

Route::get('/', function () {
    return view('auth.login');
});

// Breeze profile routes
Route::middleware('auth')->group(function () {  

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Option 1: Resource route with explicit parameter naming
Route::resource('responsable/administrateurs', UserController::class)
    ->parameters(['administrateurs' => 'user'])
    ->names('administrateurs');

// Option 2: Manual route definitions (more explicit)
Route::prefix('responsable')->group(function() {
    Route::get('/administrateurs', [UserController::class, 'index'])->name('administrateurs.index');
    Route::get('/administrateurs/create', [UserController::class, 'create'])->name('administrateurs.create');
    Route::post('/administrateurs', [UserController::class, 'store'])->name('administrateurs.store');
    Route::get('/administrateurs/{user}/edit', [UserController::class, 'edit'])->name('administrateurs.edit');
    Route::put('/administrateurs/{user}', [UserController::class, 'update'])->name('administrateurs.update');
    Route::delete('/administrateurs/{user}', [UserController::class, 'destroy'])->name('administrateurs.destroy');
});



Route::resource('responsable/administrateurs', UserController::class);
Route::put('responsable/administrateurs/{user}', [UserController::class, 'update'])->name('administrateurs.update');
Route::resource('responsable/formations', FormationController::class);
Route::resource('responsable/experiences', ExperienceController::class);
Route::resource('responsable/attestations', AttestationController::class);
Route::resource('responsable/stages', StageController::class);
Route::resource('responsable/candidats', CandidatController::class);
Route::resource('responsable/diplomes', DiplomeController::class);

Route::get('responsable/stats_formations', FormationStats::class)->name('formation-stats');
Route::post('responsable/logout',[AuthenticatedSessionController::class,'destroy'])->name('logout');

Route::get('/export-candidats/{id}', [ExportController::class, 'export'])->name('export.candidats');


});

// Your custom project routes

Route::get('/candidat/form', [CandidatformController::class, 'showForm'])->name('candidat.form');
Route::post('/candidat/form/submit', [CandidatformController::class, 'submitStep'])->name('candidat.submit');
Route::post('/candidat/form/previous', [CandidatformController::class, 'previousStep'])->name('candidat.previous');

