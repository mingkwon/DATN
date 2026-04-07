<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;

// Trang công khai (không cần auth, ai cũng vào được)
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/menu', [HomeController::class, 'menu']);
Route::get('/booking-table', [HomeController::class, 'booking_table']);
Route::post('/book_table', [HomeController::class, 'book_table']);
Route::get('/intro', [HomeController::class, 'intro']);

// Route cần đăng nhập + chặn user thường (protect.admin)
Route::middleware(['auth', 'protect.admin'])->group(function () {
    // Trang staff & admin được phép
    Route::get('/tables', [AdminController::class, 'tables'])->name('tables');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::get('/table_order/{id}', [AdminController::class, 'table_order'])->name('table_order');

    // Route chung
    Route::post('/orders/store/{table_id}', [AdminController::class, 'storeOrder'])->name('orders.store');
    Route::get('/payment/{id}', [AdminController::class, 'payment'])->name('payment');
    Route::post('/payment/{id}/process', [AdminController::class, 'processPayment'])->name('payment.process');

    // Đặt bàn AJAX (giữ cho staff/admin, nếu muốn cho user thì tách ra ngoài)
    Route::post('/booking/check', [ReservationController::class, 'checkAvailability'])->name('booking.check');
    Route::post('/booking/store', [ReservationController::class, 'storeAjax'])->name('booking.store');
    Route::get('/dat-ban', [ReservationController::class, 'showBookingForm'])->name('booking.form');
    Route::post('/dat-ban', [ReservationController::class, 'store'])->name('reservation.store');

    // Phê duyệt/hủy đặt bàn admin
    Route::post('/approve_book/{id}', [AdminController::class, 'approve_book'])->name('approve_book');
    Route::post('/reject_book/{id}', [AdminController::class, 'reject_book'])->name('reject_book');
    Route::post('/cancel_booking/{table_id}', [AdminController::class, 'cancelBooking'])->name('cancel_booking');
    Route::get('/delete_booking/{id}', [AdminController::class, 'delete_booking']);
    Route::get('/booking/{id}/info', [AdminController::class, 'getBookingInfo'])->name('booking.info');
    Route::post('/bookings/{id}/arrived', [AdminController::class, 'markAsArrived'])->name('bookings.arrived');
    Route::get('/tables/by-type/{type}/{bookingId?}', [AdminController::class, 'getTablesByType'])->name('tables.by-type');

    // AI routes
    Route::get('/ai-grok-insight', [ReportController::class, 'aiInsight'])->name('ai.grok.insight');
    Route::get('/ai-suggestions/{tableId}', [ReportController::class, 'aiSuggestions'])->name('ai.suggestions');
    Route::get('/ai-weather-suggestions/{tableId}', [ReportController::class, 'aiWeatherSuggestions']);
    Route::get('/ai-combo-suggestions/{tableId}', [ReportController::class, 'aiComboSuggestions']);
});

// Route chỉ dành cho admin (staff bị chặn thêm bởi restrict.staff)
Route::middleware(['auth', 'protect.admin', 'restrict.staff'])->group(function () {
    // Dashboard & Báo cáo
    Route::get('/dashboard', [ReportController::class, 'index'])->name('admin.dashboard');

    // Quản lý thực đơn
    Route::get('/add_food', [AdminController::class, 'add_food']);
    Route::post('/upload_food', [AdminController::class, 'upload_food']);
    Route::get('/update_food/{id}', [AdminController::class, 'update_food']);
    Route::post('/edit_food/{id}', [AdminController::class, 'edit_food']);
    Route::get('/delete_food/{id}', [AdminController::class, 'delete_food']);

    // Phân quyền 
    Route::get('/ass_staff/{id}', [AdminController::class, 'ass_staff'])->name('ass_staff');
    Route::get('/ass_admin/{id}', [AdminController::class, 'ass_admin'])->name('ass_admin');
    Route::get('/delete_acc/{id}', [AdminController::class, 'delete_acc']);

    // Quản lý bàn & đặt bàn admin
    Route::post('/add_table', [AdminController::class, 'add_table']);
    Route::get('/delete_table/{id}', [AdminController::class, 'deleteTable'])->name('delete.table');

    // Các route khác dành cho admin
    Route::get('/setting', [AdminController::class, 'setting']);
});