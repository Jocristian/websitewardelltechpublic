<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostServicesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('pages/home');
})->name('home');

Route::get('/services', function () {
    return view('pages/services');
})->name('services');

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

Route::get('/myservices', function () {
    return view('sections/myservices');
})->name('myservices');

Route::get('/index-4', function () {
    return view('pages/index-4');
})->name('index-4');

Route::get('/myservices', function () {
    return view('sections/myservices');
})->name('myservices');

Route::get('/services', [ServiceController::class, 'showAllFreelancerServices'])->name('services');

Route::get('/myservices', [ServiceController::class, 'myServices'])->name('myservices');

Route::post("/register", [RegisterController::class, 'register']) -> name("register");

// Proses login
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/postservice', [PostServicesController::class, 'store'])->name('postservice');


