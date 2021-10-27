<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        # code...
        $request->validate([
            'message' => 'required|max:1000',
        ]);

        if (Auth::user() != null && Auth::user()->user_type == 2) {
            # code...
            $msg = Message::create([
                'donator_id' => $request->donator_id,
                'user_id' => Auth::user()->id,
                'message' => $request->message,
                'status' => 1
            ]);

            if ($msg) {
                # code...
                $request->session()->flash('message-send-success', 'Message Sent Successfully');
                return redirect()->back();
            }
            else {
                # code...
                $request->session()->flash('message-send-error', 'Something Went Wrong, Please Try Again');
                return redirect()->back();
            }
        } else {
            $request->session()->flash('user-login-error', 'Please Login To Normal Account Before Sending Message');
            Auth::logout();
            return redirect()->route('login-page');
        }
    }
}
