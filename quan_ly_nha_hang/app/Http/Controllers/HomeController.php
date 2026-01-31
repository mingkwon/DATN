<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Table;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        // Nếu chưa đăng nhập → redirect thẳng đến trang login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Đã đăng nhập → kiểm tra loại người dùng
        $usertype = Auth::user()->usertype;

        if ($usertype === 'user') {
            // Người dùng thường → vào trang chủ khách
            $data = Food::all();     // Danh sách món ăn
            $tables = Table::all();  // Danh sách bàn

            return view('home.index', compact('data', 'tables'));
        }

        // Admin hoặc các loại khác → vào dashboard admin
        return view('admin.index');
    }

    // Hàm my_home giữ nguyên nếu bạn vẫn dùng ở route khác (tùy chọn)
    public function my_home()
    {
        $data = Food::all();
        $tables = Table::all();
        return view('home.index', compact('data', 'tables'));
    }

    public function menu()
    {
        $data = Food::all();
        return view('home.menu', compact('data'));
    }

    public function booking_table()
    {
        return view('home.booking-table');
    }

    public function booking_food()
    {
        return view('home.booking-food');
    }

    public function book_table(Request $request) {
        $data = new Book;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->time = $request->time;
        $data->date = $request->date;
        $data->guest = $request->guest;
        $data->table = $request->table;
        $data->note = $request->note ?? '--';
        $data->status = 'Chờ xác nhận';
        $data->save();
        return redirect()->back()->with('message','Xác nhận đặt bàn thành công!');
    }
}