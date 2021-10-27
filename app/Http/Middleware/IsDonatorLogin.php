<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsDonatorLogin
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
        if (Auth::user() != null) {
            # code...
            if (Auth::user()->user_type == 3) {
                # code...
                return $next($request);
            }
            $request->session()->flash('user-login-error', 'Please Login To Donator Dashboard First');
            Auth::logout();
            return redirect()->route('login-page');
        }
        $request->session()->flash('user-login-error', 'Please Login To Donator Dashboard First');
        return redirect()->route('login-page');
    }
}
