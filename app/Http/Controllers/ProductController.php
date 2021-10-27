<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function getProducts()
    {
        # code...
        $products = Product::where('user_id',Auth::user()->id)->where('status', 1)->get();
        return view('business.content.products', compact('products'));
    }


    public function addProduct(Request $request)
    {
        $request->validate([
            'pr_cat' => 'required|not_in:0',
            'pr_name' => 'required',
            'price' => 'required|numeric|between:0.1,1000',
            'pr_quantity' => 'required',
            'description' => 'required|max:10000',
            'pr_img' => 'required|image|max:2048|mimes:jpg,png,jpeg,gif,svg',
            'url' => 'required|unique:products,url'
        ]);

        if (Auth::user()->user_type == 4) {
            # code...
            $file = $request->file('pr_img');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $imgname = uniqid() . $filename;
            $destinationPath = public_path('/images/product_images');
            $file->move($destinationPath, $imgname);
            $product = Product::create([
                'name'=>$request->pr_name,
                'cat'=>$request->pr_cat,
                'user_id'=>Auth::user()->id,
                'price'=>$request->price,
                'desc'=>$request->description,
                'img'=>$imgname,
                'qty'=>$request->pr_quantity,
                'available_qty'=>$request->pr_quantity,
                'status'=>1,
                'url'=>$request->url,
            ]);

            if ($product) {
                # code...
                $request->session()->flash('product-added-success', 'Product Successfully Added');
                return redirect()->route('get-products');
            }
            else {
                $request->session()->flash('product-added-error', 'Something Went Wrong, Please Try Again');
                return redirect()->back()->withInput();
            }
        } else {
            $request->session()->flash('product-added-error', 'Something Went Wrong, Please Try Again');
            return redirect()->back()->withInput();
        }
    }

    public function editProduct($id)
    {
        # code...
        $product = Product::find($id);
        if (is_null($product)) {
            # code...
            return redirect()->route('get-products');
        }
        else {
            return view('business.content.edit-product', compact('product'));
        }
    }


    public function updateProduct(Request $request)
    {
        # code...
        $request->validate([
            'pr_cat' => 'required|not_in:0',
            'pr_name' => 'required',
            'price' => 'required|numeric|between:0.1,1000',
            'pr_quantity' => 'required',
            'description' => 'required|max:10000',
            'url' => 'required|unique:products,url,'.$request->pr_id
        ]);

        $product = Product::find($request->pr_id);
        $product->name = $request->pr_name;
        $product->cat = $request->pr_cat;
        $product->price = $request->price;
        $product->desc = $request->description;
        $product->qty = $request->pr_quantity;
        $product->available_qty = $request->pr_quantity;
        $product->url = $request->url;
        if ($request->file('pr_img')) {
            # code...
            $file = $request->file('pr_img');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $imgname = uniqid() . $filename;
            $destinationPath = public_path('/images/product_images');
            $file->move($destinationPath, $imgname);
            $product->img = $imgname;
        }
        if (Auth::user()->id == $product->user_id) {
            # code...
            $product->save();
            $request->session()->flash('product-update-success', 'Product Updated Successfully');
            return redirect()->route('get-products');
        } else {
            # code...
            $request->session()->flash('product-update-error', "You Don't Have Right To Edit Product");
            return redirect()->back()->withInput();
        }
    }

    public function deleteProduct($id)
    {
        # code...
        $product = Product::where('id', $id)->where('status', 1)->where('user_id', Auth::user()->id)->first();
        $product->status = 0;
        $product->save();
        session()->flash('product-update-success', "Product Deleted Successfully");
        return redirect()->route('get-products');
    }

    public function productDetail($url)
    {
        # code...
        $product = Product::where('url', $url)->with('users')->first();
        $gallery = Gallery::where('status', 1)->get();
        $cart = null;
        if (Auth::user() != null) {
            # code...
            $cart = Cart::where('user_id',Auth::user()->id)->where('status', 1)->get();
        }
        else {
            $cart = Cart::where('mac',strtok(exec('getmac'), ' '))->where('user_id', -1)->where('status', 1)->get();
        }

        $reviews = Review::where('product_id', $product->id)->where('status', 1)->with('user')->get();


        if (is_null($product)) {
            # code...
            return redirect()->route('home');
        }
        else {
            return view('visitor.content.product-detail', compact('product', 'gallery', 'cart', 'reviews'));
        }
    }

    public function getGestures()
    {
        # code...
        $coffees = Product::where('cat', 1)->where('status', 1)->with('users')->get();
        $meals = Product::where('cat', 2)->where('status', 1)->with('users')->get();
        $beds = Product::where('cat', 3)->where('status', 1)->with('users')->get();
        $gallery = Gallery::where('status', 1)->get();

        return view('visitor.content.gestures', compact('coffees', 'meals', 'beds', 'gallery'));
    }

    public function getCatGestures($cat)
    {
        # code...
        if ($cat == 'coffees') {
            # code...
            $cat_name = $cat;
            $products = Product::where('cat', 1)->where('status', 1)->with('users')->get();
            $gallery = Gallery::where('status', 1)->get();
            return view('visitor.content.category', compact('products', 'cat_name', 'gallery'));
        }
        if ($cat == 'meals') {
            # code...
            $cat_name = $cat;
            $products = Product::where('cat', 2)->where('status', 1)->with('users')->get();
            $gallery = Gallery::where('status', 1)->get();
            return view('visitor.content.category', compact('products', 'cat_name', 'gallery'));
        }
        if ($cat == 'beds') {
            # code...
            $cat_name = $cat;
            $products = Product::where('cat', 3)->where('status', 1)->with('users')->get();
            $gallery = Gallery::where('status', 1)->get();
            return view('visitor.content.category', compact('products', 'cat_name', 'gallery'));
        }
    }
}
