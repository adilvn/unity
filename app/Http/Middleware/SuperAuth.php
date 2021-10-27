<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAuth
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
            if (Auth::user()->user_type == 0) {
                # code...
                return $next($request);
            }
            $request->session()->flash('superadmin-not-login', 'Please Login To Super Dashboard First');
            Auth::logout();
            return redirect()->route('admin');
        }
        $request->session()->flash('superadmin-not-login', 'Please Login To Super Dashboard First');
        return redirect()->route('admin');

    }
}
