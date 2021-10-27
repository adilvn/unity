<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsBusinessActive
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
            if (Auth::user()->user_type == 4) {
                # code...
                if (Auth::user()->status == 1) {
                    # code...
                    return $next($request);
                }
                else {
                    return redirect()->route('business-profile-check');
                }
            }
            $request->session()->flash('user-login-error', 'Please Login To Business Dashboard First');
            Auth::logout();
            return redirect()->route('login-page');
        }
        $request->session()->flash('user-login-error', 'Please Login To Business Dashboard First');
        return redirect()->route('login-page');
    }
}
