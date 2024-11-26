<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/home', function () {
    return view('user.home');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/settings', [SettingsController::class, 'show'])->name('settings');
});

// User routes
Route::get('/explore', function () {
    return view('user.explore');
})->name('explore');

Route::get('/explore/all', function () {
    return view('user.explore.all');
})->name('explore-all');

Route::get('/explore/show', function () {
    return view('user.explore.show');
})->name('explore-show');

Route::get('/destinations/show', function () {
    return view('user.destinations.show');
})->name('destinations-show');

Route::get('/top-deals', function () {
    return view('user.top-deals');
})->name('top-deals');

Route::get('/help', function () {
    return view('user.help');
})->name('help');

Route::get('/blog', function () {
    return view('user.blog');
})->name('blog');

Route::get('/wishlist', function () {
    return view('user.wishlist');
})->name('wishlist');

Route::get('/trip-details', function () {
    return view('user.trip-details');
})->name('trip-details');

// Admin routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        if (!Auth::check() || Auth::user()->role !== 'ADMIN') {
            return redirect('/home')->with('error', 'Bạn không có quyền truy cập');
        }
        return view('admin.home');
    })->name('admin');

    Route::get('/security', function () {
        return view('admin.security');
    })->name('security');

    // User Management routes
    Route::prefix('UserMNG')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('userManagement');
        Route::post('/', [AdminUserController::class, 'index']);
        Route::get('/{user}/editUser', [AdminUserController::class, 'showInFor'])->name('showInFor');
        Route::delete('/deleteUser/{user}', action: [AdminUserController::class, 'delete'])->name('deleteUser');
        Route::put('/editUser/update/{user}', [AdminUserController::class, 'update'])->name('update');
    });
});

// tours route
Route::prefix('tours')->group(function () {
    Route::get('/create', [TourController::class, 'create'])->name('tours.create');
    Route::post('/store', [TourController::class, 'store'])->name('tours.store');
    Route::get('/get-form-data', [TourController::class, 'getFormData'])->name('tours.get.form.data');
    Route::post('/temp-store', [TourController::class, 'tempStore'])->name('tours.temp.store');
    Route::post('/final-store', [TourController::class, 'finalStore'])->name('tours.final.store');
    Route::post('/validate-step-{step}', [TourController::class, 'validateStep'])->name('tours.validate.step');
});