<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MLGeneratorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\IndexController;

Route::middleware(['auth'])->group(function () {
    Route::get('/index', [IndexController::class, 'index'])->name('index');
    Route::get('/ml_generator', [MLGeneratorController::class, 'index'])->name('keygen.ml');
    Route::post('/ml_generator', [MLGeneratorController::class, 'generateKeys'])->name('keygen.ml');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware('auth')->group(function () {
    // Your authenticated routes here
});