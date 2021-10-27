<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function confirmOrder()
    {
        # code...
        $order_number = 1;
        if (count(Order::all()) > 0) {
            # code...
            $order_number = Order::all()->last()->order_no + 1;
        }
        $carts = Cart::where('user_id', Auth::user()->id)->where('status', 1)->with('product')->get();
        foreach ($carts as $item) {
            # code...
            Order::create([
                'order_no' => $order_number,
                'product_id' => $item->product_id,
                'donator_id' => Auth::user()->id,
                'business_id' => $item->product->user_id,
                'qty' => $item->qty,
                'is_confirm' => 0,
                'status' => 1
            ]);
            $cart = Cart::where('id', $item->id)->first();
            $cart->status = 0;
            $cart->save();

            $product = Product::where('id', $item->product_id)->first();
            $remaining_qty = $product->available_qty - $item->qty;
            $product->available_qty = $remaining_qty;
            $product->save();
        }
        session()->flash('order-confirm-success', "Order Successfully Completed");
        return redirect()->route('donator-profile');
    }

    public function getBusinessOrders()
    {
        # code...
        $orders = Order::where('business_id', Auth::user()->id)->get();
        return view('business.content.donations', compact('orders'));
    }
}
