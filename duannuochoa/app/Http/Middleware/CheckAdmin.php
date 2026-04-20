<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }

        $user = Auth::user();

        // Admin: có toàn quyền
        if ($user->role_id == 1) {
            return $next($request);
        }

        // Nhân viên: có quyền truy cập một số mục cụ thể
        if ($user->role_id == 3) {
            $routeName = $request->route()->getName();
            
            // Các route hợp lệ cho Nhân viên
            $allowedRoutes = [
                'admin.tongquan',
                'admin.orders.',
                'admin.inventory.',
                'admin.articles.',
                'admin.reviews.'
            ];

            // Kiểm tra xem route hiện tại có nằm trong danh sách cho phép không
            foreach ($allowedRoutes as $allowed) {
                if (str_starts_with($routeName, $allowed)) {
                    return $next($request);
                }
            }

            // Nếu không thuộc danh sách cho phép, trả về lỗi 403
            abort(403, 'Trang này chỉ dành cho Quản trị viên. Bạn không có quyền truy cập.');
        }

        // Nếu là User thường (role_id = 2) thì chặn
        abort(403, 'Bạn không có quyền truy cập trang quản trị.');
    }
}
