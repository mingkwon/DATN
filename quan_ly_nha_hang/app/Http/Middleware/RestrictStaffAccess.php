<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestrictStaffAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->usertype === 'staff') {
            // Danh sách route được phép cho staff
            $allowedRoutes = [
                'tables',          // Bàn phục vụ
                'bookings',        // Danh sách đặt bàn
                'table_order.*',   // Nếu có route con như table_order/{id}
                'logout',          // Cho phép logout
            ];

            // Kiểm tra route hiện tại có nằm trong allowed không
            $currentRoute = $request->route()->getName();

            if (!in_array($currentRoute, $allowedRoutes) && 
                !str_starts_with($currentRoute, 'table_order.') &&
                !str_starts_with($currentRoute, 'bookings.')) {
                
                // Redirect về trang Bàn phục vụ (hoặc trang chính cho staff)
                return redirect()->route('tables')
                    ->with('error', 'Bạn không có quyền truy cập trang này.');
            }
        }

        return $next($request);
    }
}