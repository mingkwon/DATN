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
        // Nếu chưa đăng nhập → hiển thị trang chủ khách hàng
        if (!Auth::check()) {
            $data = Food::all();     // Danh sách món ăn
            $tables = Table::all();  // Danh sách bàn (nếu cần hiển thị)
            return view('home.index', compact('data', 'tables'));
        }

        // Đã đăng nhập → phân quyền theo usertype
        $usertype = Auth::user()->usertype;

        if ($usertype === 'user') {
            $data = Food::all();
            $tables = Table::all();
            return view('home.index', compact('data', 'tables'));
        }

        // Staff hoặc Admin → redirect sang dashboard hoặc trang quản lý
        if ($usertype === 'staff') {
            return redirect()->route('tables'); // Trang Bàn phục vụ cho staff
        }

        // Admin hoặc các loại khác
        return redirect()->route('admin.dashboard');
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

    public function intro()
    {
        $data = Food::all();
        return view('home.intro');
    }

    public function booking_table()
    {
        return view('home.booking-table');
    }

    public function booking_food()
    {
        return view('home.booking-food');
    }

    public function book_table(Request $request)
    {
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
        return redirect()->back()->with('message', 'Xác nhận đặt bàn thành công!');
    }
}