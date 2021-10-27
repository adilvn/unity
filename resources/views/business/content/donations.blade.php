@extends('visitor.layout.mainlayout')
@section('title', 'Orders')
@section('content')
<section class="owner-profie-sec">
    <div class="container-fluid p-0">
      <div class="row two-col-row">
        <div class="col store-menu-col p-0">
          <div class="left-store-menu">
            <h2 class="owner-name">{{Str::title("Hello ".Auth::user()->fname." ".Auth::user()->lname."!")}}</h2>
            <ul>
              <li><a href="{{route('business-profile')}}">My Profile</a></li>
              <li><a href="{{route('get-products')}}">My Products</a></li>
              <li><a href="{{route('get-business-orders')}}" class="active">Updated Donators <span class="notification-icon"><i class="fas fa-bell"></i></span></a></li>
              <li><a href="{{route('business-payment')}}">Payment Detail</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-9 store-content-col">
          <div class="store-content-wrap">
            <div class="top-heading">
              <h2>Updated Donators</h2>
            </div>
            <div class="donation_table table-responsive">
              @if (count($orders) > 0)
                <table>
                    <thead>
                    <tr>
                        <th>date</th>
                        <th>Donators Name</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @php
                                $donator = \App\Models\User::where('id',$order->donator_id)->first();
                                $product = \App\Models\Product::where('id',$order->product_id)->first();
                            @endphp
                            <tr>
                                <td>{{date("d M Y", strtotime($order->created_at))}}</td>
                                <td>{{$donator->fname}}</td>
                                <td>${{intval($product->price)}}</td>
                                <td>{{$order->qty}}</td>
                                <td>${{intval($product->price * $order->qty)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              @else
                <p class="p-5 text-center">No Orders Found ...</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
