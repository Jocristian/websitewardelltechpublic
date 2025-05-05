<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostServicesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController; 

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/home');
})->name('home');

Route::get('/services', function () {
    return view('pages/services');
})->name('services');

Route::get('/services/services', function () {
    return view('pages/services');
})->name('services');

Route::get('/register', function () {
    return view('pages/register');
})->name('register');

Route::get('/login', function () {
    return view('pages/login');
})->name('login');

Route::get('/index-3', function () {
    return view('pages/index-3');
})->name('index-3');

Route::get('/index-4', function () {
    return view('pages/index-4');
})->name('index-4');

Route::get('/myservices', function () {
    return view('sections/myservices');
})->name('myservices');

Route::middleware(['auth'])->group(function () {
    Route::get('/mytransactions', function () {
        return view('sections/mytransactions');
    })->name('mytransactions');

    Route::get('/servicesdetail', function () {
        return view('pages/servicesdetail');
    })->name('servicesdetail');

    Route::get('/servicesdetail/{service_id}/orderdetail', function () {
        return view('pages/orderdetail');
    })->name('orderdetail');

    Route::get('/profile', function () {
        return view('sections/profile');
    })->name('profile');

    Route::get('/mymessages', function () {
        return view('sections/mymessages');
    })->name('mymessages');
    
    Route::get('/my-profile/{id}', function ($id) {
        return view('pages/my-profile');
    })->name('my-profile');

    Route::get('/profile', function () {
        return view('sections/profile');
    })->name('profile');

    Route::put('/mytransactions/{id}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::post('/order/{service_id}/submit', [OrderController::class, 'submit'])->name('order.submit');
    Route::post('/mytransactions/{id}', [OrderController::class, 'submitReview'])->name('order.submitReview');
    Route::get('/services/{service_id}/orderdetail', [OrderController::class, 'show'])->name('order.show');
    Route::get('/services/{service_id}/orderdetail', [OrderController::class, 'showid'])->name('order.showid');
    Route::get('/mytransactions', [OrderController::class, 'mytransactions'])->name('mytransactions');


});




Route::get('/storage', function () {
    Artisan::call('storage:link');
});





// Route::get('/mytransactions', [OrderController::class, 'customer_mytransactions'])->name('customer_mytransactions');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/services/{service_id}', [ServiceController::class, 'show']);
    Route::get('/myservices', [ServiceController::class, 'myServices'])->name('myservices');
    Route::get('/services/{service_id}', [ServiceController::class, 'show'])->name('service.show');
    Route::put('/services/{id}/update', [ServiceController::class, 'update'])->name('updateservice');
    Route::get('/services/{service_id}', [ServiceController::class, 'show'])->name('service.show');
    // Route::get('/services/{service_id}', [ServiceController::class, 'showid'])->name('services.showid');
    Route::get('/services/freelancers', [ServiceController::class, 'showAllFreelancerServices']);
});



Route::get('/services', [ServiceController::class, 'showAllFreelancerServices'])->name('services');

Route::delete('/services/{service}', [PostServicesController::class, 'destroy'])->name('services.destroy');

Route::get('/freelancers', [UserController::class, 'listFreelancers'])->name('pages.freelancers');
// Route::get('/freelancer/{id}', [ProfileController::class, 'show'])->name('freelancer.profile');
Route::get('/my-profile/{id}', [ProfileController::class, 'show'])->name('my-profile');











Route::post("/register", [RegisterController::class, 'register']) -> name("register");

// Proses login
Route::post('/login', [LoginController::class, 'login']);
// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/postservice', [PostServicesController::class, 'store'])->name('postservice');


Route::get('/my-profile/freelancers', [UserController::class, 'listFreelancers'])->name('pages.freelancers');