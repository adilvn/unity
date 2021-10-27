<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonatorController extends Controller
{
    //

    public function getDonations()
    {
        # code...
        $donations = Order::where('donator_id', Auth::user()->id)->with('user')->with('product')->get();
        $messages = Message::where('donator_id', Auth::user()->id)->where('status', 1)->with('user')->paginate(5);
        $coffees = 0;
        $meals = 0;
        $beds = 0;
        $thanks = 0;
        foreach ($donations as $donation) {
            if ($donation->product->cat == 1) {
                # code...
                $coffees = $coffees + $donation->qty;
            } else if($donation->product->cat == 2) {
                # code...
                $meals = $meals + $donation->qty;
            } else if ($donation->product->cat == 3) {
                # code...
                $beds = $beds + $donation->qty;
            }
        }
        return view('donator.content.donator-profile', compact('donations', 'coffees', 'meals', 'beds', 'thanks', 'messages'));
    }

    public function getDonators()
    {
        # code...
        $users = User::where('user_type', 3)->where('status', 1)->paginate(10);
        $gallery = Gallery::where('status', 1)->get();
        return view('visitor.content.donators', compact('users', 'gallery'));
    }

    public function donatorSearch (Request $request)
    {
        # code...
        $request->validate([
            'search_text' => 'required'
        ]);

        $users = User::where('username', 'like', '%'.$request->search_text.'%')->where('user_type', 3)->where('status', 1)->paginate(10);
        $gallery = Gallery::where('status', 1)->get();
        return view('visitor.content.donators', compact('users', 'gallery'));
    }
}
