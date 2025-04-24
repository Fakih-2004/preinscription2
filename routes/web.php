<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\AttestationController;

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

 
Route::resource('administrateurs', AdministrateurController::class);

Route::get('/', function () {
    return view('welcome');
});


Route::resource('formations', FormationController::class);
 
Route::resource('candidats', CandidatController::class);
Route::resource('diplomes', DiplomeController::class);

Route::resource('attestations', AttestationController::class);