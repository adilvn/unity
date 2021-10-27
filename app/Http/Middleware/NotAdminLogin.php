<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() == null) {
            # code...
            return $next($request);
        }
        else {
            if (Auth::user()->user_type == 0 || Auth::user()->user_type == 1) {
                # code...
                return redirect()->route('admin-dashboard');
            } else {
                # code...
                return redirect()->route('home');
            }

        }
    }
}
