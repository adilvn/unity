@extends('visitor.layout.mainlayout')
@section('title', Str::title($cat_name))
@section('content')
    <section class="inner_header gestures">
        <div class="container">
            <h2>Gestures</h2>
            <p class="text-white">It’s no secret that what goes around comes around. Offer a kind gesture to someone in need and let that altruistic energy flow. A cup of coffee, some groceries, or just a safe place to sleep; you have the power to make a positive difference in someone's life.</p>
        </div>
    </section>

    <section class="gestures_wrapp d-padding ">
        <div class="container">
            <div class="row heading-h2 text-center justify-content-center mb-5">
                <div class="col-md-9">
                    <h2>Available Meals/Room/Drinks</h2>
                    <p>Suspendisse in justo mauris. Morbi vitae lectus est. Pellentesque commodo nisi id erat pretium, sit amet facilisis orci condimentum. Nam urna diam, pulvinar ut purus ornare, condimentum tincidunt justo. Suspendisse sed risus enim.</p>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active">
                    <div class="row">
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                <div class="col-md-3 col-sm-6">
                                    <div class="product-box">

                                        <a href="{{url('/product')}}/{{$product->url}}">

                                            <div class="product-meta-top">
                                            <h2>{{$product->name}}</h2>
                                            <p class="location">{{$product->users->store_location}}</p>
                                            </div>
                                                <img src="{{asset('images/product_images/'.$product->img)}}">
                                            <div class="product-meta-bottom">
                                                <p>Remaining <span class="remaining-no">{{$product->available_qty}}</span></p>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="p-5 text-center">No {{Str::title($cat_name)}} Found ...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('visitor.inc.cta')
    @include('visitor.inc.gallery')
@endsection
