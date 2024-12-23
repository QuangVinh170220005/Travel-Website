<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;

// Public routes
// Route::get('/home', function () {
//     return view('user.home');
// });
Route::get('/home', [TourController::class, 'getPopularLocationTours'])->name('home');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/contact-form', [ContactController::class, 'submit'])->name('contact.submit'); // Thay đổi ở đây
Route::post('/chat', [ChatController::class, 'chat']);

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/settings/{section?}', [SettingsController::class, 'show'])->name('settings.show');
});

// Trong nhóm middleware auth
Route::middleware(['auth'])->group(function () {
    // Các route booking hiện tại của bạn
    Route::get('/booking/{tour}/create', [BookingController::class, 'create'])->name('booking.create');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('booking.my-bookings');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    
    // Thêm các route mới
    // Route để lưu booking
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    
    // Route để hiển thị trang xác nhận booking
    Route::get('/booking/{tour}/confirm', [BookingController::class, 'showConfirmation'])->name('booking.confirm');
    
    // Route để xử lý thanh toán (nếu có)
    Route::post('/booking/{booking}/payment', [BookingController::class, 'processPayment'])->name('booking.payment');
});


// User routes


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
        //add tài khoản người dùngdùng
        Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('createUser');
        Route::post('/store', [AdminUserController::class, 'store'])->name('storeUser');

    });

    // tours route
    Route::prefix('tours')->group(function () {
        Route::get('/create', [TourController::class, 'create'])->name('tours.create');
        Route::post('/store', [TourController::class, 'store'])->name('tours.store');
        Route::get('/get-form-data', [TourController::class, 'getFormData'])->name('tours.get.form.data');
        Route::post('/temp-store', [TourController::class, 'tempStore'])->name('tours.temp.store');
        Route::post('/final-store', [TourController::class, 'finalStore'])->name('tours.final.store');
        Route::post('/validate-step-{step}', [TourController::class, 'validateStep'])->name('tours.validate.step');

        // Thêm các routes mới
        Route::get('/', [TourController::class, 'index'])->name('tours.index'); // Hiển thị danh sách
        Route::get('/{tour}/edit', [TourController::class, 'edit'])->name('tours.edit'); // Form chỉnh sửa
        Route::put('/{tour}', [TourController::class, 'update'])->name('tours.update'); // Cập nhật
        Route::delete('/{tour}', [TourController::class, 'destroy'])->name('tours.destroy'); // Xóa


        Route::get('/{tour}/pricing', [TourController::class, 'pricing'])->name('tours.pricing');
        Route::post('/{tour}/pricing', [TourController::class, 'storePricing'])->name('tours.pricing.store');
        Route::put('/{tour}/pricing/{price}', [TourController::class, 'updatePricing'])->name('tours.pricing.update');
        Route::delete('/{tour}/pricing/{price}', [TourController::class, 'deletePricing'])->name('tours.pricing.destroy');
    });

    Route::post('/tours/search-address', [TourController::class, 'searchAddress'])->name('tours.search.address');
    Route::post('/tours/place-detail', [TourController::class, 'getPlaceDetail'])->name('tours.place.detail');
});
Route::get('/tour/{tour}', [TourController::class, 'scheduleTour'])->name('tour.schedule');
Route::get('/explore', [TourController::class, 'explore'])->name('explore');


Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist', [WishlistController::class, 'getWishlist'])->name('wishlist');
Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');


