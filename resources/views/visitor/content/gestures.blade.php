@extends('visitor.layout.mainlayout')
@section('title', 'All Gestures')
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
            <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="Coffee-tab" data-bs-toggle="tab" data-bs-target="#Coffee" type="button" role="tab" aria-controls="Coffee" aria-selected="true">Coffee</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="Meals-tab" data-bs-toggle="tab" data-bs-target="#Meals" type="button" role="tab" aria-controls="Meals" aria-selected="false">Meals</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="Bed-tab" data-bs-toggle="tab" data-bs-target="#Bed" type="button" role="tab" aria-controls="Bed" aria-selected="false">Bed</button>
            </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Coffee" role="tabpanel" aria-labelledby="Coffee-tab">
                    <div class="row">
                        @if (count($coffees) > 0)
                            @foreach ($coffees as $coffee)
                                <div class="col-md-3 col-sm-6">
                                    <div class="product-box">

                                        <a href="{{url('/product')}}/{{$coffee->url}}">

                                            <div class="product-meta-top">
                                            <h2>{{$coffee->name}}</h2>
                                            <p class="location">{{$coffee->users->store_location}}</p>
                                            </div>
                                                <img src="{{asset('images/product_images/'.$coffee->img)}}">
                                            <div class="product-meta-bottom">
                                                <p>Remaining <span class="remaining-no">{{$coffee->available_qty}}</span></p>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="p-5 text-center">No Coffee Found ...</p>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="Meals" role="tabpanel" aria-labelledby="Meals-tab">
                    <div class="row">
                        @if (count($meals) > 0)
                            @foreach ($meals as $meal)
                                <div class="col-md-3 col-sm-6">
                                    <div class="product-box">

                                        <a href="{{url('/product')}}/{{$meal->url}}">

                                            <div class="product-meta-top">
                                            <h2>{{$meal->name}}</h2>
                                            <p class="location">{{$meal->users->store_location}}</p>
                                            </div>
                                                <img src="{{asset('images/product_images/'.$meal->img)}}">
                                            <div class="product-meta-bottom">
                                                <p>Remaining <span class="remaining-no">{{$meal->available_qty}}</span></p>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="p-5 text-center">No Meal Found ...</p>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="Bed" role="tabpanel" aria-labelledby="Bed-tab">
                    <div class="row">
                        @if (count($beds) > 0)
                            @foreach ($beds as $bed)
                                <div class="col-md-3 col-sm-6">
                                    <div class="product-box">

                                        <a href="{{url('/product')}}/{{$bed->url}}">

                                            <div class="product-meta-top">
                                            <h2>{{$bed->name}}</h2>
                                            <p class="location">{{$bed->users->store_location}}</p>
                                            </div>
                                                <img src="{{asset('images/product_images/'.$bed->img)}}">
                                            <div class="product-meta-bottom">
                                                <p>Remaining <span class="remaining-no">{{$bed->available_qty}}</span></p>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="p-5 text-center">No Bed Found ...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('visitor.inc.cta')
    @include('visitor.inc.gallery')
@endsection
