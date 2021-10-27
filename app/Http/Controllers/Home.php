<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class Home extends Controller
{
    //

    public function index()
    {
        # code...
        $coffees = Product::where('cat', 1)->where('status', 1)->count();
        $meals = Product::where('cat', 2)->where('status', 1)->count();
        $beds = Product::where('cat', 3)->where('status', 1)->count();
        $products = Product::latest()->take(4)->where('status', 1)->with('users')->get();
        $gallery = Gallery::where('status', 1)->get();
        return view('visitor.content.main', compact('coffees', 'meals', 'beds', 'products', 'gallery'));
    }
}
