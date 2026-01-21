<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginPage']);
Route::post('/', [LoginController::class, 'processLogin']);
Route::get('/logout', [MenuController::class, 'processLogout']);
Route::post('/logout', [MenuController::class, 'processLogout']);

Route::get('/register', [RegisterController::class, 'showRegisterPage']);
Route::post('/register', [RegisterController::class, 'processRegister']);


Route::middleware(['cekRole:user'])->group(function () {
    Route::get('/home', [MenuController::class, 'showHomePage']);
    Route::get('/profile', [ProfileController::class, 'showProfilePage']);
    Route::post('/profile', [ProfileController::class, 'updateProfile']);

    // Car routes for users
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

    // Reservation routes for users
    Route::get('/reservations/create/{car}', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations', [ReservationController::class, 'myReservations'])->name('reservations.my');
    Route::get('/my-reservations', [ReservationController::class, 'myReservations'])->name('my-reservations');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::get('/reservations/{car}/available-dates', [ReservationController::class, 'availableDates'])->name('reservations.available-dates');

    // Review routes for users
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews', [ReviewController::class, 'myReviews'])->name('reviews.my');
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroyOwn'])->name('reviews.destroy');

    // Payment routes
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{id}/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payments/{id}/success', [PaymentController::class, 'success'])->name('payment.success');
});


Route::middleware(['cekRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [MenuController::class, 'showAdminDashboard']);

    // TEST ROUTE - Remove this after debugging
    Route::get('/admin/test-update', function () {
        return view('test-update');
    });

    // Car management routes for admin
    Route::get('/admin/cars', [CarController::class, 'adminIndex'])->name('admin.cars.index');
    Route::get('/admin/cars/create', [CarController::class, 'create'])->name('admin.cars.create');
    Route::post('/admin/cars', [CarController::class, 'store'])->name('admin.cars.store');
    Route::get('/admin/cars/{car}', [CarController::class, 'adminShow'])->name('admin.cars.show');
    Route::get('/admin/cars/{car}/edit', [CarController::class, 'edit'])->name('admin.cars.edit');
    Route::post('/admin/cars/{car}', [CarController::class, 'update'])->name('admin.cars.update');
    Route::delete('/admin/cars/{car}', [CarController::class, 'destroy'])->name('admin.cars.destroy');

    // Reservation management routes for admin
    Route::get('/admin/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');
    Route::post('/admin/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('admin.reservations.approve');
    Route::post('/admin/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('admin.reservations.reject');
    Route::post('/admin/reservations/{id}/complete', [ReservationController::class, 'complete'])->name('admin.reservations.complete');
    Route::post('/admin/reservations/{id}/update-status', [ReservationController::class, 'updateStatus'])->name('admin.reservations.updateStatus');
    Route::post('/admin/reservations/{id}/update-payment', [ReservationController::class, 'updatePayment'])->name('admin.reservations.updatePayment');
    Route::post('/admin/reservations/{id}/mark-returned', [ReservationController::class, 'markReturned'])->name('admin.reservations.markReturned');
    Route::post('/admin/reservations/{id}/cancel', [ReservationController::class, 'cancelReservation'])->name('admin.reservations.cancel');
    Route::put('/admin/reservations/{id}', [ReservationController::class, 'update'])->name('admin.reservations.update');
    Route::delete('/admin/reservations/{id}', [ReservationController::class, 'destroy'])->name('admin.reservations.destroy');

    // Review management routes for admin
    Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::get('/admin/reviews/pending', [ReviewController::class, 'pending'])->name('admin.reviews.pending');
    Route::post('/admin/reviews/{id}/approve', [ReviewController::class, 'approve'])->name('admin.reviews.approve');
    Route::post('/admin/reviews/{id}/reject', [ReviewController::class, 'reject'])->name('admin.reviews.reject');
    Route::delete('/admin/reviews/{id}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
});
