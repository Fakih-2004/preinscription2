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
use App\Http\Controllers\ExportController;
use App\Livewire\FormationStats;


require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Breeze default welcome and dashboard


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Breeze profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/export-candidats/{formationId}', [ExportController::class, 'export'])->name('export.candidats');

Route::resource('administrateurs', UserController::class);
Route::resource('formations', FormationController::class);
Route::resource('experiences', ExperienceController::class);
Route::resource('attestations', AttestationController::class);
Route::resource('stages', StageController::class);
Route::resource('candidats', CandidatController::class);
Route::resource('diplomes', DiplomeController::class);

Route::get('/stats-formations', FormationStats::class)->name('formation-stats');

});

// Your custom project routes

Route::get('/candidat/form', [CandidatformController::class, 'showForm'])->name('candidat.form');
Route::post('/candidat/form/submit', [CandidatformController::class, 'submitStep'])->name('candidat.submit');
Route::post('/candidat/form/previous', [CandidatformController::class, 'previousStep'])->name('candidat.previous');

Route::post('/logout',[AuthenticatedSessionController::class,'destroy'])->name('logout');