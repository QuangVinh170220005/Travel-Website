<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupportController;

Route::get('/', function () {
    return view('user.home');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/settings', [SettingsController::class, 'show'])->name('settings');
});

Route::get('/explore', function () {
    return view(view: 'user.explore');
}) ->name('explore');

Route::get('/explore/all', function () {
    return view('user.explore.all');
})  ->name('explore-all');

Route::get('/explore/show', function () {
    return view('user.explore.show');
})  ->name('explore-show');

Route::get('/destinations/show', function () {
    return view('user.destinations.show');
})  ->name('destinations-show');

Route::get('/top-deals', function () {
    return view('user.top-deals');
}) ->name('top-deals');

Route::get('/help', function () {
    return view('user.help');
}) ->name('help');

Route::get('/blog', action: function () {
    return view('user.blog');
}) ->name('blog');

Route::get('/wishlist', function () {
    return view('user.wishlist');
})  ->name('wishlist');

Route::get('/trip-details', function () {
    return view('user.trip-details');
})  ->name('trip-details');

Route::get('/support', [SupportController::class, 'index'])->name('support');

Route::get('/admin', function () {
    return view('admin.home');
})  ->name('admin');

Route::get('/admin/security', function () {
    return view('admin.security');
})  ->name('security');

Route::get('/tours/create', [TourController::class, 'create'])->name('tours.create');
Route::post('/tours/store', [TourController::class, 'store'])->name('tours.store');
