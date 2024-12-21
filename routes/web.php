<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;

Route::get('/', function () {
    return view('user.home');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/holiday-packages', function () {
    return view(view: 'user.holiday-packages');
}) ->name('holiday-packages');

<<<<<<< Updated upstream
=======

Route::get('/explore/all', function () {
    return view('user.explore.all');
})->name('explore-all');

Route::get('/explore/show', function () {
    return view('user.explore.show');
})->name('explore-show');

Route::get('/destinations/show', function () {
    return view('user.destinations.show');
})->name('destinations-show');
>>>>>>> Stashed changes

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


Route::get('/admin', function () {
    return view('admin.home');
})  ->name('admin');

<<<<<<< Updated upstream
Route::get('/admin/addTour', function () {
    return view('admin.addTour');
})  ->name('addTour');
Route::post('/admin/addTour', [TourController::class, 'store'])->name('addTour');
=======
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
Route::get('/explore', [TourController::class, 'explore'])->name('explore');
Route::get('/explore/schedule/{tour}', [TourController::class, 'scheduleTour'])->name('tour.schedule');





>>>>>>> Stashed changes
