<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\LivestockController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {

	//Manage Livestock
	Route::get('/home', [LivestockController::class, 'home'])->name('home');
	Route::get('/livestocks-list', [LivestockController::class, 'index'])->name('livestocks-list');
	Route::get('/livestock/{id}', [LivestockController::class, 'view'])->name('livestocks.view');
	Route::get('/add-livestock-form', [LivestockController::class, 'create'])->name('livestocks.create');
	Route::post('/add-livestock-form', [LivestockController::class, 'store'])->name('livestocks.store');
	Route::get('/view-livestock/{id}', [LivestockController::class, 'show'])->name('livestocks.show');
	Route::get('/edit-livestock/{id}', [LivestockController::class, 'edit'])->name('livestocks.edit');
	Route::put('/update-livestock/{id}', [LivestockController::class, 'update'])->name('livestocks.update');
	Route::get('/view-pdf/{id}', [LivestockController::class, 'pdf'])->name('livestocks.pdf');
	Route::get('/delete-livestock/{id}', [LivestockController::class, 'destroy'])->name('livestocks.destroy');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');

Route::get('/', function () {
    return view('session/login-session');
});

//Manage Cart
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
	Route::post('/livestock/{livestock}/add-to-cart', [LivestockController::class, 'addToCart'])->name('livestock.addToCart');
	Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
	Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.remove');
});


//Manage Event module
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/add-event', [EventController::class, 'create'])->name('events.create');
Route::post('/add-event', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{id}', [EventController::class, 'view'])->name('events.view');
Route::get('/view-event/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/edit-event/{id}', [EventController::class, 'edit'])->name('events.edit');
Route::put('/update-event/{id}', [EventController::class, 'update'])->name('events.update');
Route::get('/delete-event/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::post('/events/{id}/register', [EventController::class, 'register'])->name('events.register');
Route::get('/events/{id}/registrations', [EventController::class, 'viewRegistrations'])->name('events.viewRegistrations');

//Manage Payment
	Route::middleware('auth')->group(function () {
    Route::post('/cart/checkout', [PaymentController::class, 'checkout'])->name('cart.checkout');
    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
   	Route::get('/payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
	Route::get('/order/success', function () {
        return view('order.success');
    })->name('order.success');

	Route::get('/seller/orders', [OrderController::class, 'sellerOrders'])->name('seller.orders');

});