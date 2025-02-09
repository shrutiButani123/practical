<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/', [RegistrationController::class, 'store'])->name('registration.store');

Route::get('login', [LoginController::class, 'create'])->name('login.create'); 
Route::post('login', [LoginController::class, 'store'])->name('login.store');    
Route::get('verify/{token}', [RegistrationController::class, 'verify'])->name('verify');

Route::middleware(['verify'])->group(function(){
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('cities/{id}', [RegistrationController::class, 'getCitiesByState'])->name('cities');
