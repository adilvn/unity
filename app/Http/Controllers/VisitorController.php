<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Gallery;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function showCareers()
    {
        $gallery = Gallery::where('status', 1)->get();
        $careers = Career::where('status', 1)->get();
        return view('visitor.content.career', compact('gallery', 'careers'));
    }

    public function showBlog()
    {
        return view('visitor.content.blog');
    }

    public function showBlogPost()
    {
        return view('visitor.content.blog-post');
    }
}
