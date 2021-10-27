@extends('visitor.layout.mainlayout')
@section('title', 'My Products')
@section('content')
    <section class="owner-profie-sec">
        <div class="container-fluid p-0">
            <div class="row two-col-row">
                <div class="col store-menu-col p-0">
                    <div class="left-store-menu">
                        <h2 class="owner-name">{{Str::title("Hello ".Auth::user()->fname." ".Auth::user()->lname."!")}}</h2>
                        <ul>
                            <li><a href="{{route('business-profile')}}">My Profile</a></li>
                            <li><a href="{{route('get-products')}}" class="active">My Products</a></li>
                            <li><a href="{{route('get-business-orders')}}">Updated Donators <span class="notification-icon"><i class="fas fa-bell"></i></span></a></li>
                            <li><a href="{{route('business-payment')}}">Payment Detail</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 store-content-col">
                    <div class="store-content-wrap">
                        <div class="top-heading">
                            <h2>My Product List</h2>
                            <div class="site-btn-4 btn-common">
                                <a href="{{route('business-add-product')}}"> Add Product</a>
                            </div>
                        </div>
                        @if (count($products) > 0)
                        <ul class="product-list-part">
                            @foreach ($products as $product)
                                <li>
                                    <p class="qty-box"> Qty <span>{{$product->qty}}</span></p>
                                    <div class="product-img-content">
                                        <div class="store-img">
                                            <img src="{{asset('images/product_images/'.$product->img)}}">
                                        </div>
                                        <div class="product-brief">
                                            <h3>{{Auth::user()->store_name}}</h3>
                                            <h2>{{$product->name}}</h2>
                                            <p>{{Auth::user()->store_location}}</p>
                                        </div>
                                    </div>

                                    <div class="bottom-edit-part">
                                        <a href="{{url('/business/product/edit')}}/{{$product->id}}"><i class="far fa-edit"></i></a>
                                        <a onclick="return confirm('Are you sure you want to delete this product?')" href="{{url('/business/product/delete')}}/{{$product->id}}"><i class="fas fa-times"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @else
                            <p class="p-5 text-center">No Product Found ...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bodyExtra')
    <script>
        @if (Session::has('product-update-success'))
            toastr.options =
            {
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ Session::get('product-update-success') }}");
        @endif
        @if (Session::has('product-added-success'))
            toastr.options =
            {
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ Session::get('product-added-success') }}");
        @endif
    </script>

@endsection
