<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class adminLoginController extends Controller
{
    public function adminlogin()
    {
        # code...
        return view('admin.content.login');
    }

    public function Login(Request $request)
    {
        # code...
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials, $request->remember)) {
            $user = User::all()
            ->where("email", trim($request->input('email')))
            ->first();
            $request->session()->flash('superAdmin-logged-in', 'Welcome Back To Unity Dashboard!');
            return redirect()->intended(route('admin-dashboard'));
        }
        else {
            $request->session()->flash('admin-login-error', 'Given Credentials Are Not Valid!');
            return redirect()->back();
        }

        // return config('app.user_type')[0];
    }

    public function adminDashboard()
    {
        # code...
        return view('admin.content.dashboard');
    }

    public function adminLogout()
    {
        # code...
        // return redirect()->route('admin-login');
        Auth::logout();
        return redirect(route('admin'));
    }
}
