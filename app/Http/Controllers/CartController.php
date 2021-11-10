<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        # code...
        $user = -1;
        if (Auth::user() != null) {
            # code...
            $user = Auth::user()->id;
        }
        $mac = strtok(exec('getmac'), ' ');

        $cart = Cart::create([
            'product_id' => $request->pr_id,
            'user_id' => $user,
            'qty' => $request->qty,
            'mac' => $mac,
            'status' => 1
        ]);

        if ($cart) {
            # code...
            $request->session()->flash('cart-added-success', 'Successfully Added To Cart');
            return redirect()->back();
        }
        else {
            $request->session()->flash('cart-added-error', 'Not Added To Cart, Try Again');
            return redirect()->back();
        }
    }

    public function getCart()
    {
        # code...
        if (Auth::user() != null) {
            # code...
            $carts = Cart::where('user_id',Auth::user()->id)->where('status', 1)->with('product')->get();
            $cart_products[] = array();
            $total = 0;
            $check_null = 0;
            foreach ($carts as $crt) {
                # code...
                $total = $total + ($crt->product->price * $crt->qty);
            }
            foreach ($carts as $key => $item) {

                $count = 0;
                $products = Cart::where('product_id', $item->product->id)->where('user_id',Auth::user()->id)->where('status', 1)->get();
                foreach ($products as $pr) {
                    $count = $count + $pr->qty;
                }
                if ($count > $item->qty) {
                    # code...
                    $item->qty = $count;
                    $cart_products[$key] = $item;
                    $check_null = 1;
                }
                else{
                    $cart_products[$key] = $item;
                    $check_null = 1;
                }
            }
            // return $cart_products;
            return view('visitor.content.cart', compact('cart_products', 'total', 'check_null'));
        }
        else {
            $carts = Cart::where('mac',strtok(exec('getmac'), ' '))->where('user_id', -1)->where('status', 1)->with('product')->get();
            $cart_products[] = array();
            $total = 0;
            $check_null = 0;
            foreach ($carts as $crt) {
                # code...
                $total = $total + ($crt->product->price * $crt->qty);
            }
            foreach ($carts as $key => $item) {

                $count = 0;
                $products = Cart::where('product_id', $item->product->id)->where('mac',strtok(exec('getmac'), ' '))->where('user_id', -1)->where('status', 1)->get();
                foreach ($products as $pr) {
                    $count = $count + $pr->qty;
                }
                if ($count > $item->qty) {
                    # code...
                    $item->qty = $count;
                    $cart_products[$key] = $item;
                    $check_null = 1;
                }
                else{
                    $cart_products[$key] = $item;
                    $check_null = 1;
                }
            }
            // return $cart_products;
            return view('visitor.content.cart', compact('cart_products', 'total', 'check_null'));
        }
    }

    public function updateCart(Request $request)
    {
        # code...
        $i = 0;
        $user = -1;
        if (Auth::user() != null) {
            # code...
            $user = Auth::user()->id;
        }
        $mac = strtok(exec('getmac'), ' ');
        if (Auth::user() != null) {
            # code...
            foreach ($request->pr_id as $p_id) {
                # code...
                Cart::where('product_id', $p_id)->where('status', 1)->where('user_id', $user)->delete();
                Cart::create([
                    'product_id' => $p_id,
                    'user_id' => $user,
                    'qty' => $request->cart_qty[$i],
                    'mac' => $mac,
                    'status' => 1
                ]);
                $i++;
                // $cart->qty = $request->cart_qty[$i];
                // $cart->save();
                // $i++;
            }
        }
        else {
            foreach ($request->pr_id as $p_id) {
                # code...
                Cart::where('product_id', $p_id)->where('status', 1)->where('user_id', $user)->where('mac', $mac)->delete();
                Cart::create([
                    'product_id' => $p_id,
                    'user_id' => $user,
                    'qty' => $request->cart_qty[$i],
                    'mac' => $mac,
                    'status' => 1
                ]);
                $i++;
                // $cart->qty = $request->cart_qty[$i];
                // $cart->save();
                // $i++;
            }
        }
        $request->session()->flash('cart-update-success', 'Cart Updated Successfully');
        return redirect()->back();
    }

    public function deleteCart($pid)
    {
        # code...
        if (Auth::user() != null) {
            # code...
            Cart::where('product_id', $pid)->where('status', 1)->where('user_id', Auth::user()->id)->delete();
        }
        else {
            Cart::where('product_id', $pid)->where('status', 1)->where('user_id', -1)->where('mac', strtok(exec('getmac'), ' '))->delete();
        }
        session()->flash('cart-remove-success', 'Product Removed Successfully');
        return redirect()->back();
    }

    public function checkout()
    {
        # code...
        if (Auth::user() != null) {
            # code...
            $carts = Cart::where('user_id', Auth::user()->id)->where('status', 1)->with('product')->get();
            $cart_products[] = array();
            $total = 0;
            $check_null = 0;
            foreach ($carts as $crt) {
                # code...
                $total = $total + ($crt->product->price * $crt->qty);
            }
            foreach ($carts as $key => $item) {

                $count = 0;
                $products = Cart::where('product_id', $item->product->id)->where('user_id', Auth::user()->id)->where('status', 1)->get();
                foreach ($products as $pr) {
                    $count = $count + $pr->qty;
                }
                if ($count > $item->qty) {
                    # code...
                    $item->qty = $count;
                    $cart_products[$key] = $item;
                    $check_null = 1;
                }
                else{
                    $cart_products[$key] = $item;
                    $check_null = 1;
                }
            }
            // return $cart_products;
            return view('visitor.content.checkout', compact('cart_products', 'total', 'check_null'));
        }
        else {
            return redirect()->route('login-page');
        }
    }

    public function confirmOrder($cart_products)
    {
        # code...
        return $cart_products;
    }
}
