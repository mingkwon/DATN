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

        // Lọc theo khoảng thời gian (period)
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
                    $query->whereBetween('date', [
                        $today->startOfWeek(Carbon::MONDAY), // Tuần bắt đầu từ Thứ 2 (tùy chỉnh nếu cần Chủ Nhật)
                        $today->endOfWeek(Carbon::SUNDAY),
                    ]);
                    break;

                case 'this-month':
                    $query->whereBetween('date', [
                        $today->startOfMonth(),
                        $today->endOfMonth(),
                    ]);
                    break;

                default:
                    // Nếu period không hợp lệ → bỏ qua
                    break;
            }
        }

        // Lọc theo trạng thái (status)
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        // Sắp xếp mặc định: mới nhất trước (hoặc theo ngày đặt nếu muốn)
        $query->orderBy('created_at', 'desc'); // hoặc orderBy('date', 'asc')->orderBy('time', 'asc');

        // Phân trang + giữ nguyên các query params (period, status, page,...)
        $data = $query->paginate(10)->withQueryString();

        return view('admin.booking', compact('data'));
    }

    public function delete_booking($id)
    {
        $data = Book::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function approve_book($id)
    {
        $booking = Book::find($id);
        $booking->status = 'Đã xác nhận';
        $booking->save();
        return redirect()->back();
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
        return view('admin.table');
    }

    public function add_table(Request $request)
    {
        $data = new Table;
        $data->ten_ban = $request->ten_ban;
        $data->loai_ban = $request->loai_ban;
        $data->vi_tri = $request->vi_tri;
        $data->trang_thai = $request->trang_thai;
        $data->save();
        return redirect()->back();
    }
}
