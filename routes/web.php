<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/home');
})->name('home');

Route::get('/register', function () {
    return view('pages/register');
})->name('register');

Route::get('/login', function () {
    return view('pages/login');
})->name('login');

Route::get('/profile', function () {
    return view('sections/profile');
})->name('profile');

Route::get('/index-3', function () {
    return view('pages/index-3');
})->name('index-3');

Route::get('/index-4', function () {
    return view('pages/index-4');
})->name('index-4');

Route::post("/register", [RegisterController::class, 'register']) -> name("register");

// Proses login
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


