<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBlogs()
    {
        $blogs = Blog::all();
        return view('admin.content.blogs', compact('blogs'));
    }

    public function addBlog()
    {
        return view('admin.content.blog-new');
    }

    public function saveBlog(Request $request)
    {
        $request->validate(
            [
                'img' => 'required|image|max:2048|mimes:jpg,png,jpeg,gif,svg',
                'title' => 'required',
                'desc' => 'required',
                'url' => 'required'
            ],
            [
                'img.required' => 'Image is required',
                'title.required' => 'Blog title is required',
                'desc.required' => 'Blog description is required',
                'url.required' => 'Must enter the URL'
            ]
        );

        $blog = Blog::create([
            $imageName = uniqid().request()->img->getClientOriginalExtension(),
            'image' => $request->$imageName,
            'title' => $request->title,
            'description' => $request->desc,
            'url' => $request->url,
            'postedby' => Auth::user()->id,
            'status' => 1,
        ]);
        request()->img->move(public_path('/images/blog_images'),  $imageName);
        $request->session()->flash('save-blog', 'Blog created successfully!');
        return redirect()->route('get-blogs');
    }

    public function editBlog($id)
    {
        $blog = Blog::find($id);
        return view('admin.content.blog-new', compact('blog'));
    }

    public function updateBlog(Request $request, $id)
    {
        $request->validate(
            [
                'img' => 'required|image|max:2048|mimes:jpg,png,jpeg,gif,svg',
                'title' => 'required',
                'desc' => 'required',
                'url' => 'required'
            ],
            [
                'img.required' => 'Image is required',
                'title.required' => 'Blog title is required',
                'desc.required' => 'Blog description is required',
                'url.required' => 'Must enter the URL'
            ]
        );

        $blog = Blog::find($id);
        $imageName = uniqid().request()->img->getClientOriginalExtension();
        $blog->image = $imageName;
        $blog->title = $request->title;
        $blog->description = $request->desc;
        $blog->url = $request->url;
        $blog->postedby = Auth::user()->id;
        $blog->status = 1;
        $blog->update();
        request()->img->move(public_path('/images/blogs_images'), $imageName);

        return redirect()->back();
    }

    public function updateBlogStatus($id)
    {
        $blog = Blog::find($id);
        if (!is_null($blog)) {
            if ($blog->status == 1) {
                $blog->status = 0;
                $blog->update();
                return redirect()->route('get-blogs');
            } else if ($blog->status == 0) {
                $blog->status = 1;
                $blog->update();
                return redirect()->route('get-blogs');
            }
        } else {
            return redirect()->route('get-blogs');
        }
    }

    public function deleteBlog(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        $request->session()->flash('delete-blog', 'Blog has been deleted successfully!');
        return redirect()->back();
    }
}
