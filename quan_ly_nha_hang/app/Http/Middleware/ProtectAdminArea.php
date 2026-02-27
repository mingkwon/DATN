<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProtectAdminArea
{
    public function handle(Request $request, Closure $next)
    {
        // Chưa đăng nhập → chặn
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Vui lòng đăng nhập để truy cập khu vực này.');
        }

        // Đã đăng nhập nhưng là 'user' → chặn
        if (Auth::user()->usertype === 'user') {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập khu vực này.');
        }

        // Admin hoặc staff → cho qua (sẽ xử lý phân quyền staff ở middleware khác)
        return $next($request);
    }
}