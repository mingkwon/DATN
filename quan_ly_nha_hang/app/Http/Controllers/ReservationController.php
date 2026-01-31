<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Hiển thị form đặt bàn (trong trang chủ)
    public function showBookingForm()
    {
        return view('home.book');
    }

    // AJAX: Load sơ đồ bàn theo ngày giờ (hiện ngay dưới form)
    public function checkAvailability(Request $request)
    {
        $date = $request->booking_date;
        $time = $request->booking_time;
        $datetime = Carbon::createFromFormat('Y-m-d H:i', "$date $time");

        $tables = Table::all()->map(function ($table) use ($datetime) {
            $booked = Reservation::where('table_id', $table->id)
                ->where('status', 'confirmed')
                ->whereDate('booking_time', $datetime->toDateString())
                ->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, booking_time, ?)) < 120', [$datetime])
                ->exists();

            $table->is_booked = $booked;
            return $table;
        });

        return view('home.partials.table-map', compact('tables', 'date', 'time'))->render();
    }

    // AJAX: Xử lý đặt bàn + trả về JSON
    public function storeAjax(Request $request)
    {
        try {
            // Bắt buộc validate trước
            $request->validate([
                'table_id' => 'required|exists:tables,id',
                'customer_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'guests' => 'required|integer|min:1|max:50',
                'booking_date' => 'required|date',
                'booking_time' => 'required',
            ]);

            $datetime = Carbon::createFromFormat('Y-m-d H:i', $request->booking_date . ' ' . $request->booking_time);

            // Kiểm tra trùng
            $conflict = Reservation::where('table_id', $request->table_id)
                ->where('status', 'confirmed')
                ->whereDate('booking_time', $datetime->toDateString())
                ->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, booking_time, ?)) < 120', [$datetime])
                ->exists();

            if ($conflict) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bàn đã được đặt trong khung giờ này!'
                ], 422);
            }

            Reservation::create([
                'table_id' => $request->table_id,
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'guests' => $request->guests,
                'booking_time' => $datetime,
                'note' => $request->note,
                'status' => 'confirmed',
            ]);

            $table = Table::find($request->table_id);

            return response()->json([
                'success' => true,
                'message' => "Đặt bàn {$table->number} thành công lúc {$request->booking_time} ngày " . \Carbon\Carbon::parse($request->booking_date)->format('d/m/Y') . "!"
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin!',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Lỗi đặt bàn: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại sau!'
            ], 500);
        }
    }
}