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
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\FormationController;






Route::resource('administrateurs', AdministrateurController::class);
Route::resource('formations', FormationController::class);
Route::resource('experiences', ExperienceController::class);
Route::resource('attestations', AttestationController::class);
Route::resource('stages', StageController::class);
Route::resource('inscriptions', InscriptionController::class);
Route::resource('candidats', CandidatController::class);
Route::resource('diplomes', DiplomeController::class);


Route::get('/candidats/create', [CandidatController::class, 'create'])->name('candidats.create');
Route::post('/candidats', [CandidatController::class, 'store'])->name('candidats.store');
Route::get('/candidats/{id}/edit', [CandidatController::class, 'edit'])->name('candidats.edit');
Route::put('/candidats/{id}', [CandidatController::class, 'update'])->name('candidats.update');
Route::delete('/candidats/{id}', [CandidatController::class, 'destroy'])->name('candidats.destroy');
