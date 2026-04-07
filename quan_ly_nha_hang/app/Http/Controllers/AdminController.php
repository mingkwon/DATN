<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\Food;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Book;
use App\Models\Table;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Payment;
use App\Events\NewBookingNotification;

class AdminController extends Controller
{
    public function add_food()
    {
        $data = Food::all();
        return view('admin.add_food', compact('data'));
    }

    public function upload_food(Request $request)
    {
        $data = new Food;
        $data->title = $request->title;
        $data->type = $request->type;
        $data->detail = $request->detail;
        $data->price = $request->price;
        $image = $request->img;
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $request->img->move('food_img', $filename);
        $data->image = $filename;
        $data->save();
        return redirect()->back();
    }

    public function view_food()
    {
        $data = Food::all();
        return view('admin.add_food', compact('data'));
    }

    public function delete_food($id)
    {
        $data = Food::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function update_food($id)
    {
        $data = Food::find($id);
        return view('admin.add_food', compact('data'));
    }

    public function edit_food(Request $request, $id)
    {
        $data = Food::find($id);

        $data->title = $request->title;
        $data->type = $request->type;
        $data->detail = $request->detail;
        $data->price = $request->price;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('food_img', $imagename);

            $data->image = $imagename;
        }
        $data->save();
        return redirect('add_food');
    }

    public function reservations()
    {
        $reservation = Reservation::with('table')->get();
        return view('admin.reservation', compact('reservation'));
    }

    public function bookings(Request $request)
    {
        $query = Book::query();

        // Lọc theo search (tên hoặc SĐT)
        if ($search = $request->query('search')) {
            $search = trim($search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Lọc theo period (ngày)
        if ($period = $request->query('period')) {
            $today = Carbon::today('Asia/Ho_Chi_Minh');

            switch ($period) {
                case 'today':
                    $query->whereDate('date', $today);
                    break;

                case 'tomorrow':
                    $query->whereDate('date', $today->addDay());
                    break;

                case 'this-week':
                    $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
                    $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);
                    $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
                    break;

                case 'this-month':
                    $startOfMonth = $today->copy()->startOfMonth();
                    $endOfMonth = $today->copy()->endOfMonth();
                    $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
                    break;
            }
        }

        // Lọc theo trạng thái
        if ($statuses = $request->query('status')) {
            $statuses = is_array($statuses) ? $statuses : explode(',', $statuses);
            $query->whereIn('status', $statuses);
        }

        // Sắp xếp mới nhất trước
        $query->orderBy('created_at', 'desc');

        // Lấy dữ liệu trước khi phân trang để cập nhật trạng thái
        $bookings = $query->get();

        // Cập nhật trạng thái quá hạn cho tất cả đơn "Chờ xác nhận"
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        foreach ($bookings as $booking) {
            if ($booking->status === 'Chờ xác nhận') {
                $bookingDateTime = Carbon::parse("{$booking->date} {$booking->time}", 'Asia/Ho_Chi_Minh');

                if ($now->greaterThan($bookingDateTime)) {
                    $booking->status = 'Đã hủy';
                    $booking->save();

                    // Log để theo dõi (tùy chọn)
                    \Log::info("Đơn đặt bàn ID {$booking->id} đã tự động chuyển sang 'Đã hủy' vì quá hạn.");
                }
            }
        }

        // Phân trang lại sau khi cập nhật (để hiển thị đúng dữ liệu mới)
        $data = $query->paginate(10)->withQueryString();

        return view('admin.booking', compact('data'));
    }


    public function getBookingInfo($id)
    {
        $booking = Book::findOrFail($id);
        return response()->json([
            'name' => $booking->name,
            'phone' => $booking->phone,
            'time' => $booking->time,
            'date' => \Carbon\Carbon::parse($booking->date)->format('d/m/Y'),
            'table_type' => $booking->table,
        ]);
    }

    public function getAvailableTables($date, $time)
    {
        // Lấy danh sách bàn theo type và trạng thái (bạn có thể lọc thêm theo thời gian đặt bàn)
        $tables = Table::where('vi_tri', request('vi_tri', 'tieu_chuan')) // mặc định hoặc theo param
            ->get(['id', 'ten_ban', 'trang_thai', 'vi_tri']);

        return response()->json($tables);
    }

    public function delete_acc($id)
    {
        $acc = User::find($id);
        $acc->delete();
        return redirect()->back();
    }

    public function ass_staff($id)
    {
        $acc = User::find($id);
        $acc->usertype = 'staff';
        $acc->save();
        return redirect()->back();
    }

    public function ass_admin($id)
    {
        $acc = User::find($id);
        $acc->usertype = 'admin';
        $acc->save();
        return redirect()->back();
    }

    public function delete_booking($id)
    {
        $data = Book::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function approve_book($id, Request $request)
    {
        $booking = Book::findOrFail($id);

        $tableId = $request->input('table_id');

        if (!$tableId) {
            return redirect()->back()->with('error', 'Vui lòng chọn một bàn!');
        }

        $table = Table::find($tableId);
        if (!$table) {
            return redirect()->back()->with('error', 'Bàn không tồn tại!');
        }

        // KHÔNG check $table->trang_thai nữa, vì popup đã lọc theo khung giờ

        // Gán bàn và xác nhận
        $booking->update([
            'table_id' => $tableId,
            'status' => 'Đã xác nhận',
        ]);

        // Optional: cập nhật trạng thái bàn thành "Đã đặt" ngay (nếu cần UI realtime)
        $table->trang_thai = 'Đã đặt';
        $table->save();

        return redirect()->route('bookings')->with('success', 'Đã xác nhận và gán bàn thành công!');
    }

    private function updateTableStatus(Table $table)
    {
        // Tạo instance mới hoàn toàn, buộc timezone + giờ hiện tại
        $now = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');

        Log::info("Timezone hiện tại: " . date_default_timezone_get());
        Log::info("Carbon now raw (new instance): " . $now->toDateTimeString());

        // ƯU TIÊN CAO NHẤT: Nếu bàn đang có order mở → luôn giữ "Đang dùng"
        if ($table->currentOrder) {
            if ($table->trang_thai !== 'Đang dùng') {
                $table->trang_thai = 'Đang dùng';
                $table->saveQuietly();
                Log::info("Bàn {$table->ten_ban} giữ 'Đang dùng' vì đang có order mở (ID: {$table->currentOrder->id})");
            }
            return; // Không xử lý thêm gì nữa
        }

        // Chỉ xử lý booking nếu KHÔNG có order mở
        $booking = Book::where('table_id', $table->id)
            ->whereIn('status', ['Chờ xác nhận', 'Đã xác nhận', 'Chờ khách'])
            ->whereRaw("CONCAT(date, ' ', time) >= ?", [$now->subMinutes(15)->toDateTimeString()])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->first();

        if (!$booking) {
            if ($table->trang_thai !== 'Trống') {
                $table->trang_thai = 'Trống';
                $table->saveQuietly();
                Log::info("Bàn {$table->ten_ban} về Trống do không có booking hợp lệ và không có order mở");
            }
            return;
        }

        $bookingTime = Carbon::parse($booking->date . ' ' . $booking->time);
        $startDisplay = $bookingTime->copy()->subHours(2);
        $expireTime = $bookingTime->copy()->addMinutes(15);

        Log::info("Bàn {$table->ten_ban} - now: {$now}, booking: {$bookingTime}, start: {$startDisplay}, expire: {$expireTime}");

        if ($now->between($startDisplay, $expireTime)) {
            if ($table->trang_thai !== 'Đã đặt') {
                $table->trang_thai = 'Đã đặt';
                $table->saveQuietly();
                Log::info("Bàn {$table->ten_ban} → Đã đặt (trong khung chờ)");
            }
        } elseif ($now->greaterThan($expireTime)) {
            $booking->update(['status' => 'Đã hủy']);
            if ($table->trang_thai !== 'Trống') {
                $table->trang_thai = 'Trống';
                $table->saveQuietly();
                Log::info("Bàn {$table->ten_ban} → Trống & booking {$booking->id} → Đã hủy (quá 15p)");
            }
        }
    }

    private function updateBookingStatus(Book $booking)
    {
        $now = Carbon::now();
        $bookingTime = Carbon::parse($booking->date . ' ' . $booking->time);
        $expireTime = $bookingTime->copy()->addMinutes(15);

        // Không xử lý nếu đã hủy hoặc đã đến
        if (in_array($booking->status, ['Đã hủy', 'Đã đến', 'Hoàn thành'])) {
            return;
        }

        if ($now->greaterThan($expireTime)) {
            // Quá 15 phút → hủy
            $booking->update(['status' => 'Đã hủy']);
            Log::info("Booking {$booking->id} tự hủy do quá hạn chờ 15 phút");
        } elseif ($now->greaterThanOrEqualTo($bookingTime)) {
            // Đến giờ đặt nhưng chưa quá hạn → chuyển sang Chờ khách
            if ($booking->status !== 'Chờ khách') {
                $booking->update(['status' => 'Chờ khách']);
                Log::info("Booking {$booking->id} → Chờ khách (đến giờ đặt)");
            }
        }
    }

    public function getTablesByType($type, $bookingId = null)
    {
        $tables = Table::where('vi_tri', $type)->get();

        if ($bookingId) {
            $currentBooking = Book::find($bookingId);
            if (!$currentBooking) {
                return response()->json(['error' => 'Không tìm thấy booking'], 404);
            }

            $currentDateTime = Carbon::parse($currentBooking->date . ' ' . $currentBooking->time);
            $startWindow = $currentDateTime->copy()->subHours(2);
            $endWindow = $currentDateTime->copy()->addMinutes(15);

            foreach ($tables as $table) {
                // Kiểm tra có booking KHÁC trùng khung giờ không
                $conflictingBooking = Book::where('table_id', $table->id)
                    ->where('id', '!=', $bookingId) // Không tính chính booking đang assign
                    ->whereIn('status', ['Chờ xác nhận', 'Đã xác nhận', 'Chờ khách'])
                    ->whereRaw("CONCAT(date, ' ', time) BETWEEN ? AND ?", [
                        $startWindow->toDateTimeString(),
                        $endWindow->toDateTimeString()
                    ])
                    ->exists(); // Chỉ cần tồn tại là đủ, không cần lấy full record

                // Nếu có xung đột → Đã đặt
                // Nếu không → Trống (hoặc giữ trạng thái hiện tại nếu đang dùng)
                if ($conflictingBooking) {
                    $table->status = 'Đã đặt';
                } else {
                    // Ưu tiên trạng thái "Đang dùng" nếu có order mở
                    if ($table->currentOrder) {
                        $table->status = 'Đang dùng';
                    } else {
                        $table->status = 'Trống';
                    }
                }
            }
        } else {
            // Nếu không truyền bookingId (trường hợp cũ), giữ logic cũ
            foreach ($tables as $table) {
                $this->updateTableStatus($table);
            }
        }

        return response()->json($tables->map(function ($table) {
            return [
                'id' => $table->id,
                'name' => $table->ten_ban,
                'status' => $table->status,
            ];
        }));
    }

    public function cancelBooking($tableId)
    {
        $table = Table::findOrFail($tableId);

        // Tìm booking liên quan và hủy
        $booking = Book::where('table_id', $tableId)
            ->where('status', 'Đã xác nhận')
            ->latest()
            ->first();

        if ($booking) {
            $booking->status = 'Đã hủy';
            $booking->save();
        }

        // Đổi trạng thái bàn về Trống
        $table->trang_thai = 'Trống';
        $table->save();

        return response()->json(['success' => true]);
    }

    public function reject_book($id)
    {
        try {
            $booking = Book::with('table')->findOrFail($id);

            $booking->status = 'Đã hủy';
            $booking->save();

            // Kiểm tra table tồn tại và là object
            if ($booking->table && $booking->table instanceof \App\Models\Table && $booking->table->trang_thai === 'Đã đặt') {
                $booking->table->trang_thai = 'Trống';
                $booking->table->save();
                Log::info("Bàn {$booking->table->ten_ban} về 'Trống' sau khi hủy booking ID {$id}");
            } else {
                Log::warning("Không tìm thấy bàn hoặc bàn không ở trạng thái 'Đã đặt' khi hủy booking ID {$id}");
            }

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã hủy đặt bàn và giải phóng bàn (nếu có)!'
                ]);
            }

            return redirect()->back()->with('success', 'Đã hủy đặt bàn và giải phóng bàn thành công!');
        } catch (\Exception $e) {
            Log::error("Lỗi reject_book ID {$id}: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lỗi server: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi hủy đặt bàn!');
        }
    }

    public function tables()
    {
        $this->autoCancelExpiredBookings();

        $now = Carbon::now('Asia/Ho_Chi_Minh');

        $tables = Table::with([
            'currentOrder' => function ($q) {
                $q->where('trang_thai', 'dang_mo')
                    ->latest()
                    ->select('id', 'table_id', 'created_at');
            },
        ])->get();

        // Mảng bổ sung để truyền thông tin active booking cho Blade (không dính vào model)
        $tableExtras = [];

        foreach ($tables as $table) {
            $originalStatus = $table->trang_thai;

            // ƯU TIÊN: Nếu có order đang mở → luôn "Đang dùng"
            if ($table->currentOrder) {
                $table->trang_thai = 'Đang dùng';
            } else {
                // Tìm booking đang trong khung chờ (giờ hiện tại nằm trong [giờ đặt - 2h, giờ đặt + 15p])
                $activeBooking = Book::where('table_id', $table->id)
                    ->whereIn('status', ['Chờ xác nhận', 'Đã xác nhận', 'Chờ khách'])
                    ->whereRaw("CONCAT(date, ' ', time) >= ?", [$now->copy()->subMinutes(15)->toDateTimeString()])
                    ->whereRaw("CONCAT(date, ' ', time) <= ?", [$now->copy()->addHours(2)->toDateTimeString()])
                    ->orderBy('date', 'asc')
                    ->orderBy('time', 'asc')
                    ->first();

                if ($activeBooking) {
                    $bookingTime = Carbon::parse($activeBooking->date . ' ' . $activeBooking->time);
                    $startDisplay = $bookingTime->copy()->subHours(2);
                    $expireTime = $bookingTime->copy()->addMinutes(15);

                    if ($now->between($startDisplay, $expireTime)) {
                        $table->trang_thai = 'Đã đặt';
                        // Lưu vào mảng riêng, KHÔNG gán vào model $table
                        $tableExtras[$table->id] = $activeBooking;
                    } else {
                        $table->trang_thai = 'Trống';
                    }
                } else {
                    $table->trang_thai = 'Trống';
                }
            }

            // CHỈ LƯU nếu trạng thái thực sự thay đổi
            if ($table->trang_thai !== $originalStatus) {
                $table->saveQuietly();
            }
        }

        return view('admin.table', compact('tables', 'tableExtras'));
    }

    private function autoCancelExpiredBookings()
    {
        $now = Carbon::now();

        $expired = Book::whereIn('status', ['Đã xác nhận', 'Chờ khách'])
            ->whereRaw("CONCAT(date, ' ', time) <= ?", [$now->subMinutes(15)->toDateTimeString()])
            ->get();

        foreach ($expired as $booking) {
            $booking->update(['status' => 'Đã hủy']);

            // Kiểm tra table có tồn tại và là object
            if ($booking->table && $booking->table instanceof Table && $booking->table->trang_thai === 'Đã đặt') {
                $booking->table->update(['trang_thai' => 'Trống']);
            }

            Log::info("Auto cancel expired booking ID {$booking->id}");
        }
    }

    public function add_table(Request $request)
    {
        $data = new Table;
        $data->ten_ban = $request->ten_ban;
        $data->loai_ban = $request->loai_ban;
        $data->vi_tri = $request->vi_tri;
        $data->trang_thai = $request->trang_thai ?? 'Trống';
        $data->save();
        return redirect()->back();
    }

    public function deleteTable($id)
    {
        $table = Table::findOrFail($id);

        if ($table->trang_thai !== 'Trống') {
            return redirect()->back()->with('error', 'Chỉ có thể xóa bàn đang Trống!');
        }

        // Optional: Kiểm tra nếu có orders/booking đang active
        if ($table->orders()->where('trang_thai', 'open')->exists()) {
            return redirect()->back()->with('error', 'Bàn còn đơn hàng đang mở, không thể xóa!');
        }

        $table->delete(); // ← Soft delete: set deleted_at = now()

        return redirect()->back()->with('success', 'Đã ẩn/xóa bàn thành công!');
    }

    public function table_order($id)
    {
        $table = Table::findOrFail($id);
        $foods = Food::all();

        $order = Order::where('table_id', $id)
            ->where('trang_thai', 'dang_mo')
            ->latest()
            ->first();

        $orderedItems = collect();
        $dbSubtotal = 0;
        $distinctItemCount = 0;

        if ($order) {
            // Sửa: dùng đúng tên relationship 'orderItems' và 'food'
            $items = $order->orderItems()->with('food')->get();

            $grouped = $items->groupBy('food_id');

            $orderedItems = $grouped->map(function ($group) use (&$dbSubtotal) {
                $firstItem = $group->first();
                $totalQuantity = $group->sum('so_luong');
                $price = $firstItem->gia_tai_thoi_diem_dat;

                $dbSubtotal += $totalQuantity * $price;

                return (object) [
                    'food' => $firstItem->food,  // dùng đúng 'food' từ model OrderItems
                    'so_luong' => $totalQuantity,
                    'gia_tai_thoi_diem_dat' => $price,
                ];
            });

            $distinctItemCount = $grouped->count();
        }

        return view('admin.table_order', compact('table', 'foods', 'orderedItems', 'dbSubtotal', 'distinctItemCount', 'order'));
    }

    public function payment($id)
    {
        $order = Order::with(['ban_an', 'orderItems.food'])->findOrFail($id);

        $subtotal = $order->orderItems->sum(fn($item) => $item->so_luong * $item->gia_tai_thoi_diem_dat);
        $vat = round($subtotal * 0.08);
        $total = $subtotal + $vat;

        // Giờ vào
        $timeIn = $order->created_at ? $order->created_at->format('H:i') : 'Chưa có';

        // Thời gian dùng bữa dạng HH:MM
        if ($order->created_at) {
            $now = now();
            $diffMinutes = $order->created_at->diffInMinutes($now);
            $hours = floor($diffMinutes / 60);
            $minutes = $diffMinutes % 60;
            $duration = sprintf('%02d:%02d', $hours, $minutes);  // HH:MM, luôn 2 chữ số
        } else {
            $duration = '00:00';
        }

        return view('admin.payment', compact(
            'order',
            'subtotal',
            'vat',
            'total',
            'timeIn',
            'duration'
        ));
    }

    public function storeOrder(Request $request, $tableId)
    {
        try {
            $table = Table::findOrFail($tableId);

            // Tìm order đang mở
            $order = Order::where('table_id', $tableId)
                ->where('trang_thai', 'dang_mo')
                ->latest()
                ->first();

            $booking = null;

            if (!$order) {
                // Tìm booking liên quan (nếu có)
                $booking = Book::where('table_id', $tableId)
                    ->whereIn('status', ['Đã xác nhận', 'Chờ khách', 'Đã đến'])
                    ->latest()
                    ->first();

                $order = Order::create([
                    'ten_khach' => $booking ? $booking->name : null,
                    'phone' => $booking ? $booking->phone : null,
                    'table_id' => $tableId,
                    'book_id' => $booking ? $booking->id : null,
                    'order_type' => $booking ? 'booking' : 'walkin',
                    'trang_thai' => 'dang_mo',
                    'tong_tien_truoc_giam' => 0,
                    'giam_gia' => 0,
                    'thue' => 0,
                    'tong_thanh_toan' => 0,
                    'ghi_chu_don' => $request->input('note', ''),
                ]);

                // Nếu có booking → cập nhật thành "Đã đến" (nếu chưa)
                if ($booking && $booking->status !== 'Đã đến') {
                    $booking->update([
                        'status' => 'Đã đến',
                        'updated_at' => now()
                    ]);
                }
            }

            // Thêm món
            $items = $request->input('items', []);
            foreach ($items as $item) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'food_id' => $item['id'],
                    'so_luong' => $item['quantity'],
                    'gia_tai_thoi_diem_dat' => $item['price'],
                    'ghi_chu_mon' => $item['note'] ?? '',
                    'trang_thai_mon' => 'da_gui_bep',
                ]);
            }

            // LUÔN cập nhật trạng thái bàn thành "Đang dùng" (bỏ Quietly nếu không cần)
            if ($table->trang_thai !== 'Đang dùng') {
                $table->trang_thai = 'Đang dùng';
                $table->save(); // Hoặc saveQuietly() nếu bạn có method custom này
                Log::info("Cập nhật bàn {$tableId} thành 'Đang dùng' thành công");
            } else {
                Log::info("Bàn {$tableId} đã ở 'Đang dùng', không update");
            }

            session()->flash('message', 'Đã gửi món lên bếp thành công!');

            return response()->json([
                'success' => true,
                'message' => 'Đã gửi món lên bếp thành công!',
                'order_id' => $order->id,
                'redirect' => route('tables') // Thêm để JS redirect về danh sách bàn
            ]);

        } catch (\Exception $e) {
            Log::error('Lỗi storeOrder: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function markAsArrived($id)
    {
        $booking = Book::with('table')->findOrFail($id);

        $now = Carbon::now();
        $bookingTime = Carbon::parse($booking->date . ' ' . $booking->time);
        $expireTime = $bookingTime->copy()->addMinutes(15);

        if ($booking->status !== 'Đã xác nhận') {
            return response()->json(['success' => false, 'message' => 'Không thể mở bàn ở trạng thái hiện tại']);
        }

        if ($now > $expireTime) {
            // Quá 15 phút → tự hủy
            $booking->update(['status' => 'Đã hủy']);
            if ($booking->table) {
                $booking->table->update(['trang_thai' => 'Trống']);
            }
            return response()->json(['success' => false, 'message' => 'Quá thời gian chờ! Đặt bàn đã bị hủy tự động.']);
        }

        $booking->update([
            'status' => 'Đã đến',
            'updated_at' => now()
        ]);

        if ($booking->table) {
            $booking->table->update(['trang_thai' => 'Đang dùng']);
        }

        return response()->json(['success' => true]);
    }

    public function processPayment(Request $request, $id)
    {
        $order = Order::with(['ban_an', 'booking'])->findOrFail($id);

        // Kiểm tra đơn hàng chưa thanh toán
        if ($order->trang_thai === 'hoan_tat') {
            return redirect()->route('tables')->with('error', 'Đơn hàng đã được thanh toán trước đó.');
        }

        // Lấy phương thức thanh toán
        $phuong_thuc = $request->input('phuong_thuc', 'tien_mat');

        // Tính lại tổng tiền (để chắc chắn)
        $subtotal = $order->orderItems->sum(fn($item) => $item->so_luong * $item->gia_tai_thoi_diem_dat);
        $vat = round($subtotal * 0.08);
        $giam_gia = 0; // Nếu có voucher sau này, thay bằng logic thực tế
        $tong_thanh_toan = $subtotal + $vat - $giam_gia;

        // Cập nhật orders
        $order->update([
            'tong_tien_truoc_giam' => $subtotal,
            'giam_gia' => $giam_gia,
            'thue' => $vat,
            'tong_thanh_toan' => $tong_thanh_toan,
            'trang_thai' => 'hoan_tat',
            'thoi_gian_dong_don' => now(),
        ]);

        // Tạo payment
        Payment::create([
            'order_id' => $order->id,
            'so_tien' => $tong_thanh_toan,
            'phuong_thuc' => $phuong_thuc,
            'trang_thai_thanh_toan' => 'hoan_thanh',
            'ma_giao_dich' => null,
            'thoi_gian_thanh_toan' => now(),
            'ghi_chu' => null,
        ]);

        // Giải phóng bàn
        if ($order->ban_an) {
            $order->ban_an->update(['trang_thai' => 'Trống']);
        }

        // Cập nhật trạng thái booking thành "Hoàn thành" nếu có liên kết
        if ($order->booking) {
            $order->booking->update([
                'status' => 'Hoàn thành',
                'updated_at' => now()
            ]);
        }

        return redirect()->route('tables')->with('message', 'Thanh toán thành công! Bàn đã được trả và sẵn sàng đón khách mới.');
    }

    public function setting()
    {
        $users = User::select('id', 'name', 'email', 'usertype', 'created_at')
            ->orderByRaw("CASE WHEN email = 'admin@gmail.com' THEN 0 ELSE 1 END") // admin@gmail.com lên đầu
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalUsers = User::count();
        $adminCount = User::where('usertype', 'admin')->count();
        $staffCount = User::where('usertype', 'staff')->count();

        return view('admin.setting', compact('users', 'totalUsers', 'adminCount', 'staffCount'));
    }

    // Đổi vai trò
    public function updateRole(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy tài khoản'], 404);
        }

        // Kiểm tra quyền (chỉ admin mới đổi được)
        if (Auth::user()->usertype !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Bạn không có quyền thực hiện'], 403);
        }

        $request->validate([
            'usertype' => 'required|in:admin,staff'
        ]);

        // Không cho đổi vai trò của chính mình (tùy chọn)
        if ($user->id === Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Không thể thay đổi vai trò của chính bạn'], 403);
        }

        $user->usertype = $request->usertype;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Đổi vai trò thành công']);
    }

    // Xóa user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Không cho xóa chính mình (tùy chọn)
        if ($user->id === Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Không thể xóa tài khoản đang đăng nhập']);
        }

        $user->delete();

        return response()->json(['success' => true]);
    }
}
 