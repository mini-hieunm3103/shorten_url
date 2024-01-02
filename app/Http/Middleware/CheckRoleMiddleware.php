<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng có role 'user' hay không
        if (Auth::check() && Auth::user()->hasRole('user')) {
            // Nếu có role 'user', chuyển hướng
            return redirect()->route('client.home'); // Thay đổi đường dẫn
        }

        // Nếu không có role 'user', tiếp tục xử lý request
        return $next($request);
    }
}
