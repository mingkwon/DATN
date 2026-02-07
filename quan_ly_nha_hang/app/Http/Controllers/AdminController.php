<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Food;
use App\Models\Reservation;
use App\Models\Book;
use App\Models\Table;

class AdminController extends Controller
{
    public function add_food()
    {
        return view('admin.add_food');
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

    // public function bookings()
    // {
    //     $data = Book::orderBy('created_at', 'desc')->paginate(10);
    //     return view('admin.booking', compact('data'));
    // }

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

        // Lọc ngày
        if ($period = $request->query('period')) {
            $today = Carbon::today();

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
                    \Log::info("This week filter: from {$startOfWeek->format('Y-m-d')} to {$endOfWeek->format('Y-m-d')}");
                    $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
                    break;

                case 'this-month':
                    $startOfMonth = $today->copy()->startOfMonth();
                    $endOfMonth = $today->copy()->endOfMonth();
                    \Log::info("This month filter: from {$startOfMonth->format('Y-m-d')} to {$endOfMonth->format('Y-m-d')}");
                    $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
                    break;
            }
        }

        // Lọc theo trạng thái (hỗ trợ nhiều trạng thái cùng lúc)
        if ($statuses = $request->query('status')) {
            // $statuses có thể là string (1 trạng thái) hoặc array (nhiều trạng thái)
            $statuses = is_array($statuses) ? $statuses : [$statuses];

            $now = Carbon::now();

            $query->where(function ($q) use ($statuses, $now) {
                foreach ($statuses as $filterStatus) {
                    $q->orWhere(function ($sub) use ($filterStatus, $now) {
                        if ($filterStatus === 'Chờ xác nhận') {
                            $sub->where('status', 'Chờ xác nhận')
                                ->whereRaw("CONCAT(date, ' ', time) >= ?", [$now->toDateTimeString()]);
                        } elseif ($filterStatus === 'Đã xác nhận') {
                            $sub->where('status', 'Đã xác nhận')
                                ->whereRaw("CONCAT(date, ' ', time) > ?", [$now->toDateTimeString()]);
                        } elseif ($filterStatus === 'Chờ khách') {
                            $sub->where('status', 'Đã xác nhận')
                                ->whereRaw("CONCAT(`date`, ' ', `time`) >= ? - INTERVAL 15 MINUTE", [$now->toDateTimeString()])
                                ->whereRaw("CONCAT(`date`, ' ', `time`) <= ?", [$now->toDateTimeString()]);
                        } elseif ($filterStatus === 'Đã quá hạn') {
                            $sub->where(function ($inner) use ($now) {
                                $inner->where('status', 'Chờ xác nhận')
                                    ->whereRaw("CONCAT(date, ' ', time) < ?", [$now->toDateTimeString()]);
                            })->orWhere(function ($inner) use ($now) {
                                $inner->where('status', 'Đã xác nhận')
                                    ->whereRaw("CONCAT(date, ' ', time) < ?", [$now->subMinutes(15)->toDateTimeString()]);
                            });
                        } elseif ($filterStatus === 'Đã hủy') {
                            $sub->where('status', 'Đã hủy');
                        }
                    });
                }
            });
        }

        $query->orderBy('created_at', 'desc');

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
        $tables = Table::where('vi_tri', request('vi_tri', 'Tiêu chuẩn')) // mặc định hoặc theo param
            ->get(['id', 'ten_ban', 'trang_thai', 'vi_tri']);

        return response()->json($tables);
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

        if ($table->trang_thai !== 'Trống') {
            return redirect()->back()->with('error', 'Bàn đã được đặt hoặc đang dùng!');
        }

        // Chỉ gán table_id và xác nhận booking
        $booking->update([
            'table_id' => $tableId,
            'status' => 'Đã xác nhận',
        ]);

        return redirect()->route('bookings')->with('success', 'Đã xác nhận và gán bàn thành công! Trạng thái bàn sẽ tự động cập nhật trước 3 tiếng.');
    }

    private function updateTableStatus(Table $table)
    {
        $now = Carbon::now();

        // Tìm booking sớm nhất trong tương lai cho bàn này
        $upcomingBooking = Book::where('table_id', $table->id)
            ->where('status', 'Đã xác nhận')
            ->whereRaw("CONCAT(date, ' ', time) > ?", [$now->toDateTimeString()])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->first();

        if ($upcomingBooking) {
            $bookingDateTime = Carbon::parse($upcomingBooking->date . ' ' . $upcomingBooking->time);

            // Nếu còn ≤ 3 tiếng (giờ hiện tại ≥ giờ đặt - 3h)
            if ($now->diffInHours($bookingDateTime, false) <= 3) {
                if ($table->trang_thai !== 'Đã đặt') {
                    $table->trang_thai = 'Đã đặt';
                    $table->saveQuietly(); // Lưu mà không trigger event
                }
            }
        }
    }

    public function getTablesByType($type)
    {
        $tables = Table::where('vi_tri', $type)->get();

        foreach ($tables as $table) {
            $this->updateTableStatus($table);
        }

        return response()->json($tables->map(function ($table) {
            return [
                'id' => $table->id,
                'name' => $table->ten_ban,
                'status' => $table->trang_thai,
            ];
        }));
    }

    public function reject_book($id)
    {
        $booking = Book::find($id);
        $booking->status = 'Đã hủy';
        $booking->save();
        return redirect()->back();
    }

    public function tables()
    {
        $tables = Table::with([
            'latestBooking' => function ($q) {
                $q->where('status', 'Đã xác nhận')
                    ->whereRaw("CONCAT(date, ' ', time) > ?", [now()->toDateTimeString()])
                    ->orderBy('date')->orderBy('time')->limit(1);
            }
        ])->get();

        // Cập nhật trạng thái bàn (nếu bạn đã có hàm updateTableStatus)
        foreach ($tables as $table) {
            $this->updateTableStatus($table);
        }

        return view('admin.table', compact('tables'));
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

    public function table_order()
    {
        return view('admin.table_order');
    }
}
