@extends('visitor.layout.mainlayout')
@section('title', 'Give Hope For The Homeless')
@section('content')
    <section class="home-hero-section d-padding">
        <div class="container">

            <div class="row hero-row">

                <div class="col-md-5 mb-md-0 mb-5 text-sm-start text-center">
                <div class="left-part">

                        <h3>Give hope for the homeless</h3>
                        <h1>Unity, Provide hope, Groceries, Meals, Beds</h1>
                        <p>Officia at, risus maxime temporibus excepturi consequat sapiente, felis at in fusce, doloremque interdum! Repellat dolor sollicitudin risus.</p>
                        <div class="site-btn-3 btn-common">
                            <a href="{{route('get-gestures')}}">Donate Now</a>
                        </div>

                    </div>
                </div>

                <div class="col-md-7">
                    <div class="right-part">
                        <img src="images/hero-img.png">
                    </div>
                </div>


            </div>

        </div>
    </section>


    <section class="d-padding home-section-2">
        <div class="container">
            <div class="row heading-h2 text-center justify-content-center">
                <div class="col-md-9">
                    <h2>Donation Updates Title</h2>
                    <p>Suspendisse in justo mauris. Morbi vitae lectus est. Pellentesque commodo nisi id erat pretium, sit amet facilisis orci condimentum. Nam urna diam, pulvinar ut purus ornare, condimentum tincidunt justo. Suspendisse sed risus enim.</p>
                </div>

            </div>
            <div class="row icon-row">
                <div class="col-md-4 mb-md-0 mb-4">
                    <a href="{{url('/gestures/coffees')}}" class="category_box">
                        <div class="icon-box-wrap">

                            <div class="icon-wrap">
                                <img src="images/hot-drink-blue.png">
                            </div>

                            <h2> Hot Drinks ({{$coffees}})</h2>

                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-md-0 mb-4">
                    <a href="{{url('/gestures/meals')}}" class="category_box">
                        <div class="icon-box-wrap">

                            <div class="icon-wrap">
                                <img src="images/dinner-blue.png">
                            </div>

                            <h2> Hot Meals ({{$meals}})</h2>

                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{url('/gestures/beds')}}" class="category_box">
                        <div class="icon-box-wrap">

                            <div class="icon-wrap">
                                <img src="images/bed-blue.png">
                            </div>

                            <h2> Bed for Night ({{$beds}})</h2>

                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section class="d-padding home-section-3">
        <div class="container">
            <div class="row heading-h2 text-center justify-content-center">
                <div class="col-md-9">
                    <h2>Available Meals/Room/Drinks</h2>
                    <p>It’s no secret that what goes around comes around. Offer a kind gesture to someone in need and let that altruistic energy flow. A cup of coffee, some food, or just a safe place to sleep; you have the power to make a positive difference in someone's life.</p>
                </div>

            </div>
            @if (count($products) > 0)
                <div class="row product-row">
                    @foreach ($products as $product)
                        <div class="col-md-3 col-sm-6">
                            <div class="product-box">
                                <a href="{{url('/product')}}/{{$product->url}}">

                                    <div class="product-meta-top">
                                        <h2>{{$product->name}}</h2>
                                        <p class="location">{{$product->users->store_location.", ".$product->users->pcode.", ".$product->users->country}}</p>
                                    </div>
                                        <img src="{{asset('images/product_images/'.$product->img)}}">
                                    <div class="product-meta-bottom">
                                        <p>Remaining <span class="remaining-no">{{$product->available_qty}}</span></p>
                                    </div>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row btn-center d-padding">
                    <div class="site-btn-4 btn-common">
                        <a href="{{route('get-gestures')}}">View All</a>
                    </div>
                </div>
            @else
                <p class="p-5 text-center">No Donation Found ...</p>
            @endif
        </div>
    </section>
    @include('visitor.inc.cta')
    @include('visitor.inc.gallery')
@endsection
@section('bodyExtra')
    <script>
        $(function() {
            @if (Session::has('visitor-register-success'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ Session::get('visitor-register-success') }}");
            @endif

            @if (Session::has('alert-for-admins'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ Session::get('alert-for-admins') }}");
            @endif
        });
    </script>
@endsection
