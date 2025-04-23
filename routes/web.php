<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormationController;

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
 
