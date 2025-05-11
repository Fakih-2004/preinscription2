<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\AttestationController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\FormationController;
use App\Livewire\FormationStats;
use App\Http\Controllers\CandidatformController;


use App\Http\Controllers\ExportController;

Route::get('export/{formationId}', [ExportController::class, 'export'])->name('export.candidats');


Route::resource('administrateurs', AdministrateurController::class);
Route::resource('formations', FormationController::class);
Route::resource('experiences', ExperienceController::class);
Route::resource('attestations', AttestationController::class);
Route::resource('stages', StageController::class);
Route::resource('candidats', CandidatController::class);
Route::resource('diplomes', DiplomeController::class);

Route::get('/stats-formations', FormationStats::class)->name('formation-stats');


Route::get('/stats-formations', \App\Livewire\FormationStats::class)->name('formation-stats');
Route::get('/candidat/form', [CandidatformController::class, 'showForm'])->name('candidat.form');
Route::post('/candidat/form/submit', [CandidatformController::class, 'submitStep'])->name('candidat.submit');
Route::post('/candidat/form/previous', [CandidatformController::class, 'previousStep'])->name('candidat.previous');