<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // nếu đã đăng nhập thì phải redirect đến home
        if (Auth::check()) {
            return redirect(route('client.home'));
        }
        // nếu chưa thì sẽ xử lý đến cái sau
        return $next($request);
    }
}
