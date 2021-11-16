@extends('visitor.layout.mainlayout')
@section('title', 'Cart')
@section('content')
    <section class="shopping_cart d-padding">
        <div class="container">
            <h2 class="text-center mb-5">Shopping Cart</h2>
            <form action="{{route('update-cart')}}" method="POST">
                @csrf
                @if ($check_null != 0)
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>PRODUCT</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart_products as $key => $item)
                            @php
                                $products[] = array();
                            @endphp
                            @if (!in_array($item->product_id,$products))
                                <tr>
                                    <input type="text" name="pr_id[]" value="{{$item->product_id}}" hidden>
                                    <td>
                                        <a href="{{url('/cart/delete')}}/{{$item->product_id}}"><i class="fas fa-times"></i></a>
                                    </td>
                                    <td>
                                        <div class="product_sec">
                                            <img src="{{asset('images/product_images/'.$item->product->img)}}" alt="" class="rounded">
                                            <h2><a href="{{url('/product')}}/{{$item->product->url}}">{{$item->product->name}}</a></h2>
                                        </div>
                                    </td>
                                    <td class="price">${{$item->product->price}}</td>
                                    <td>
                                        <div class="quantity">
                                            <div class="number">
                                                <input type="text" value="{{ $item->product->available_qty }}" id="product_qty{{ $key }}" hidden>
                                                <input type="text" name="" id="avail_qty" hidden>
                                                <span class="minus" onclick=""><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                <input type="text" onchange="checkQty(this)" class="cart_qty" value="{{$item->qty}}" name="cart_qty[]"/>
                                                <span class="plus" onclick=""><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total_price">${{$item->product->price * $item->qty}}</td>
                                </tr>
                            @endif
                            @php
                                array_push($products,$item->product_id);
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <div class="site-btn-4 btn-common text-end">
                                    <button type="submit">Update Cart</button>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                @else
                    <p class="p-5 text-center">Your Cart Is Empty...</p>
                    <div class="site-btn-4 btn-common text-center">
                        <a href="{{route('get-gestures')}}">Add Products</a>
                    </div>
                @endif
            </form>
        </div>
    </section>

    @if ($check_null != 0)
        <section class="subtotal_wrapp pb-5">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <div class="subtotal_wrapp_inner">
                            <table>
                                <tbody>
                                    <tr>
                                        <th class="text-start">Total</th>
                                        <td class="text-end">${{$total}}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <div class="site-btn-4 btn-common text-center">
                                                <a href="{{route('checkout')}}" class="w-100">Proceed to CheckOut</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
@section('bodyExtra')
    <script>
        @if (Session::has('cart-update-success'))
            toastr.options =
            {
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ Session::get('cart-update-success') }}");
        @endif
        @if (Session::has('cart-remove-success'))
            toastr.options =
            {
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ Session::get('cart-remove-success') }}");
        @endif

        // function checkQty(quantity) {
        //     var input_qty = $(quantity).val();
        //     var product_qty = $(quantity).prev().prev().val();
        //     if(input_qty > product_qty)
        //     {
        //         alert('The limit exceeded');
        //         $(product_qty).next().hide();
        //     }
        //     else
        //     {
        //         $(product_qty).next().hide();
        //     }
        };
    </script>
@endsection
