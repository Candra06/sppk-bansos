<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\variabelController;
use App\Http\Controllers\HimpunanController;
use App\Http\Controllers\FungsiController;

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

//landing
Route::get('/', [LoginController::class, 'index']);

//login
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);

//logout
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/storeRecipient/{id}', [RecipientController::class, 'storeRecipient'])->name('position.storeRecipient');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('user', UserController::class);
Route::resource('recipient', RecipientController::class);
Route::resource('variabel', VariabelController::class);
Route::resource('himpunan', HimpunanController::class);
Route::resource('fungsi', FungsiController::class);

Route::get('/evaluasi/{id}', [RecipientController::class, 'formPenilaian']);
Route::post('/submitEvaluation/{id}', [RecipientController::class, 'submitEvaluation']);
// Route::post('importData', [ProjectController::class, 'importData'])->name('importData');
