<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function addReview(Request $request)
    {
        # code...
        $request->validate([
            'review' => 'required|max:1000',
        ]);

        $review = Review::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
            'review' => $request->review,
            'status' => 1
        ]);

        if ($review) {
            # code...
            $request->session()->flash('review-added-success', 'Review Successfully Added');
            $product = Product::where('id', $request->product_id)->first();
            $url = $product->url;
            return redirect()->route('product-detail', $url);
        }
        else {
            $request->session()->flash('review-added-error', 'Something Went Wrong, Please Try Again');
            return redirect()->back()->withInput();
        }

    }
}
