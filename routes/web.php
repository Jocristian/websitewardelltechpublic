<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostServicesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PortfolioController;
use App\Models\User;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckBanned;

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true]);

Route::get('/', function () {
    $freelancers = User::where('role', 'freelancer')->get();
    return view('pages.home', compact('freelancers'));
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

Route::get('/myportfolios', function () {
    return view('sections/myportfolios');
})->name('myportfolios');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/mytransactions', function () {
    //     return view('sections/mytransactions');
    // })->name('mytransactions');

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
    Route::get('/services/{service_id}/orderdetail/{order_id}/pay', [OrderController::class, 'payWithMidtrans'])->name('order.pay');
    Route::get('/services/{service_id}/orderdetail/{order_id}', [OrderController::class, 'showid'])->name('order.showid');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admindashboard')->middleware('admin','auth');





    Route::get('/mytransactions', [OrderController::class, 'mytransactions'])->name('mytransactions');
    Route::post('/order/quick/{service_id}', [OrderController::class, 'quickCreate'])->name('order.quickCreate');
    Route::post('/order/update-status/{id}', [OrderController::class, 'updateStatusAjax']);
    Route::get('/order/quick/{service_id}', [OrderController::class, 'showquick'])->name('order.showquick');
    Route::get('/order/payment/{service_id}/{order_id}', [OrderController::class, 'showPaymentPage'])->name('order.payment.page');  

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    




});

Route::middleware(['auth', 'verified'])->group(function () {
    // Show general order details
    Route::get('/services/{service_id}/orderdetail', [OrderController::class, 'show'])->name('order.show');

    // Show order details with specific order_id
    Route::get('/services/{service_id}/orderdetail/{order_id}', [OrderController::class, 'showid'])->name('order.showid');

    // Pay route
    Route::get('/services/{service_id}/orderdetail/{order_id}/pay', [OrderController::class, 'payWithMidtrans'])->name('order.pay');
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
    Route::get('/freelancers', [UserController::class, 'listFreelancers'])->name('pages.freelancers');
});

Route::get('/services', [ServiceController::class, 'showAllFreelancerServices'])->name('services');
Route::delete('/services/{service}', [PostServicesController::class, 'destroy'])->name('services.destroy');
Route::get('/base', [UserController::class, 'listFreelancersIndex'])->name('freelancers.index');
Route::get('/my-profile/{id}', [ProfileController::class, 'show'])->name('my-profile');


    Route::post("/register", [RegisterController::class, 'register']) -> name("register");
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::post('/portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
Route::put('/portfolios/{id}', [PortfolioController::class, 'update'])->name('portfolios.update');
Route::delete('/portfolios/{id}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');
Route::get('/myportfolios', [PortfolioController::class, 'showMyPortfolios'])->middleware('auth');
Route::get('/portfolio/{id}', [PortfolioController::class, 'show'])->name('portfolio.show');


Route::post('/postservice', [PostServicesController::class, 'store'])->name('postservice');
Route::get('/my-profile/freelancers', [UserController::class, 'listFreelancers'])->name('pages.freelancers');

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.users');
//     Route::post('/admin/users/{id}/ban', [App\Http\Controllers\AdminController::class, 'ban'])->name('admin.users.ban');
// });

Route::get('/users', [App\Http\Controllers\AdminController::class, 'index'])->name('sections.users')->middleware(['admin','auth']);
Route::post('/users/{id}/ban', [App\Http\Controllers\AdminController::class, 'ban'])->name('sections.users.ban')->middleware('admin','auth');

Route::get('/verify/code', [RegisterController::class, 'showCodeForm'])->name('verify.code.form');
Route::post('/verify/code', [RegisterController::class, 'verifyCode'])->name('verify.code.submit');
Route::post('/send-verification-code', [RegisterController::class, 'sendVerificationCode'])->name('send.code');
Route::post('/register', [RegisterController::class, 'register'])->name('register');


// Route::get('/profile', function () {
//     // ...
// })->middleware(EnsureTokenIsValid::class);
