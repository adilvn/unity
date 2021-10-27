<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class About extends Controller
{
    //

    public function index()
    {
        # code...
        $gallery = Gallery::where('status', 1)->get();
        return view('visitor.content.about', compact('gallery'));
    }
}
