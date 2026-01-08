<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
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
    Route::get('/cars', [MenuController::class, 'showCarListPage']);
    Route::get('/cars/search', [MenuController::class, 'searchCars']);
    Route::get('/cars/{car}', [MenuController::class, 'showCarDetailPage']);
    Route::get('/reservations/{car}', [MenuController::class, 'showReservationForm']);
    Route::post('/reservations/{car}', [MenuController::class, 'processReservation']);
    Route::post('/reviews', [MenuController::class, 'submitReview']);
});


Route::middleware(['cekRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [MenuController::class, 'showAdminDashboard']);
    Route::get('/admin/cars', [MenuController::class, 'showAdminCarList']);
    Route::get('/admin/cars/create', [MenuController::class, 'showCreateCarForm']);
    Route::post('/admin/cars', [MenuController::class, 'processCreateCar']);
    Route::get('/admin/cars/{car}', [MenuController::class, 'showCarDetails']);
    Route::get('/admin/cars/{car}/edit', [MenuController::class, 'showEditCarForm']);
    Route::post('/admin/cars/{car}', [MenuController::class, 'processUpdateCar']);
    Route::delete('/admin/cars/{car}', [MenuController::class, 'processDeleteCar']);
    Route::get('/admin/reviews', [MenuController::class, 'showAdminReviewList']);
    Route::post('/admin/reviews/{review}/approve', [MenuController::class, 'processApproveReview']);
    Route::post('/admin/reviews/{review}', [MenuController::class, 'processDeleteReview']);
});
