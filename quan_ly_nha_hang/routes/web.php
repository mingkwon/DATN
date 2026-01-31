<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservationController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/menu', [HomeController::class, 'menu']);

Route::get('/booking-table', [HomeController::class, 'booking_table']);

Route::post('/book_table', [HomeController::class, 'book_table']);

Route::get('/bookings', [AdminController::class, 'bookings']);

Route::get('/delete_booking/{id}', [AdminController::class, 'delete_booking']);

Route::get('/approve_book/{id}', [AdminController::class, 'approve_book']);

Route::get('/reject_book/{id}', [AdminController::class, 'reject_book']);

Route::get('/booking-food', [HomeController::class, 'booking_food']);

Route::get('/tables', [AdminController::class, 'tables']);

Route::post('/add_table', [AdminController::class, 'add_table']);

Route::get('/add_food', [AdminController::class, 'add_food']);

Route::post('/upload_food', [AdminController::class, 'upload_food']);

Route::get('/add_food', [AdminController::class, 'view_food']);

Route::get('/delete_food/{id}', [AdminController::class, 'delete_food']);

Route::get('/update_food/{id}', [AdminController::class, 'update_food']);

Route::post('/edit_food/{id}', [AdminController::class, 'edit_food']);

Route::get('/dat-ban', [ReservationController::class, 'index'])->name('book.table');

Route::post('/dat-ban', [ReservationController::class, 'store'])->name('reservation.store');

// === ĐẶT BÀN AJAX – CHỈ DÙNG 3 DÒNG NÀY LÀ ĐỦ ===
Route::post('/booking/check', [ReservationController::class, 'checkAvailability'])
    ->name('booking.check');

Route::post('/booking/store', [ReservationController::class, 'storeAjax'])
    ->name('booking.store');

// Giữ lại để hiển thị form trong trang chủ (nếu cần)
Route::get('/dat-ban', [ReservationController::class, 'showBookingForm'])->name('booking.form');

Route::get('/reservations', [AdminController::class, 'reservations']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
