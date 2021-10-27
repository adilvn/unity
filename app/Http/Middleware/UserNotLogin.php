<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotLogin
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
            if (Auth::user()->user_type == 4) {
                # code...
                return redirect()->route('business-profile');
            }
            elseif (Auth::user()->user_type == 3) {
                # code...
                return redirect()->route('donator-profile');
            }
            else {
                # code...
                return redirect()->route('home');
            }
        }
    }
}
