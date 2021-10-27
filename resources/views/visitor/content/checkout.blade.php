@extends('visitor.layout.mainlayout')
@section('title', 'Checkout')
@section('content')
    <form action="">
        <section class="checkout d-padding">
            <div class="container">
                <h2 class="text-center mb-5">Checkout</h2>
                <div class="row">
                    <div class="col-12 col-md-8 mx-auto">
                        <div class="billing_detail">
                            <h4 class="mb-3">Billing details</h4>
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{Auth::user()->fname}}" disabled>
                                            <label for="FirstName">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{Auth::user()->lname}}" disabled>
                                            <label for="LastName">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" placeholder="Street Address" value="{{Auth::user()->store_name}}" disabled>
                                            <label for="StreetAddress">Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" placeholder="Town / City" value="{{Auth::user()->store_location}}" disabled>
                                            <label for="Town">Town / City</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" placeholder="Postcode" value="{{Auth::user()->pcode}}" disabled>
                                            <label for="Postcode">Postcode</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{Auth::user()->country}}" disabled>
                                            <label for="Country">Country</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{Auth::user()->phone}}" disabled>
                                            <label for="PhoneNumber">Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{Auth::user()->email}}" disabled>
                                            <label for="EmailAddress">Email Address</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="subtotal_wrapp pb-5">
            <div class="container">
                <h4 class="mb-3">Your Order</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="subtotal_wrapp_inner">
                            <table>
                                <thead>
                                    <tr>
                                        <th>PRODUCT</th>
                                        <th class="text-end">SUBTOTAL</th>
                                    </tr>
                                </thead>
                                @if ($check_null != 0)
                                    <tbody>
                                        @foreach ($cart_products as $key => $item)
                                            @php
                                                $products[] = array();
                                            @endphp
                                            @if (!in_array($item->product_id,$products))
                                                <tr>
                                                    <td>{{$item->product->name}} <span class="small">(${{intval($item->product->price)}} x {{$item->qty}})</span></td>
                                                    <td class="text-end">${{$item->product->price * $item->qty}}</td>
                                                </tr>
                                            @endif
                                            @php
                                                array_push($products,$item->product_id);
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-end" width="80%"><b>Total</b></td>
                                            <td class="text-end"><b>${{$total}}</b></td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="payment_wrapp pb-5">
            <div class="container">
                <div class="payment_wrapp_inner p-4">
                    <label for="payment_method_paypal"> PayPal <img src="{{asset('images/payment-card.png')}}" alt="PayPal acceptance mark"> </label>
                    <div class="payment_box payment_method_paypal">
                        <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                    </div>
                    <div class="site-btn-4 paypal-btns btn-common mt-4">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
@section('bodyExtra')
    <script src="https://www.paypal.com/sdk/js?client-id=AZEPyYvUQTOWUTp_SsH2OGZ3FOEqI-fGon5ffDxYkPW82JRg6BG6aPj0n3TqL9KQNW2GeTbCsCO0_5FN&disable-funding=credit"></script>
    <script>
        paypal.Buttons({
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: '{{$total}}'
                }
              }]
            });
          },
          onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                window.location.href = "{{ route('confirm-order')}}";
            });
          }
        }).render('#paypal-button-container');
    </script>
@endsection
