<?php

use Illuminate\Support\Facades\Route;
use Filament\Pages\Auth\Login as FilamentLogin;

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

Route::middleware(['web'])->prefix('admin')->group(function () {
    Route::get('login', FilamentLogin::class)->name('filament.admin.auth.login');
});
Route::middleware(['web'])->prefix('admin')->group(function () {
    Route::get('login/test', function () { return response('OK LOGIN ROUTE', 200); });
});

Route::middleware(['web','auth'])->prefix('admin')->group(function () {
    Route::get('home', function () {
        return response('Bienvenue dans le panneau Filament.', 200);
    })->name('filament.admin.home');
});
