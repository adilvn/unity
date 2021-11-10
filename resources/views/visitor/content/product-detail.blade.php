@extends('visitor.layout.mainlayout')
@section('title', $product->name)
@section('content')
    <section class="product_detail d-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-4 mb-md-0">
                    <div class="product_img">
                        <img src="{{asset('images/product_images/'.$product->img)}}" alt="" class="rounded">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="product_right_detail ps-md-5 ps-0">
                        <h4>{{$product->users->store_name}}</h4>
                        <h2 class="mb-3">{{$product->name}}</h2>
                        <p class="location"><i class="fas fa-map-marker-alt"></i> {{$product->users->store_location.", ".$product->users->pcode.", ".$product->users->country}}</p>
                        <div class="price mb-3">
                            <h3>${{$product->price}}</h3>
                        </div>
                        <p>{{Str::words($product->desc, 60, '...')}}</p>
                        <!-- <h5 class="mb-3">Remaining <span>24</span></h5> -->
                        <form action="{{route('add-cart')}}" method="POST">
                            @csrf
                            <input type="text" value="{{$product->id}}" name="pr_id" hidden>
                            <div class="quantity">
                                <label for="quantity" class="d-block mb-2">Select Quantity</label>
                                <div class="number">
                                    <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                    <input type="text" onchange="checkQty(this)" value="1" name="qty"/>
                                    <span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            @if ($product->available_qty > 0)
                                <div class="site-btn-4 btn-common mt-3">
                                    <button type="submit">Add To Cart</button>
                                    @if (count($cart) > 0)
                                        <a href="{{route('get-cart')}}" class="ms-md-3"><i class="fas fa-shopping-cart"></i> View Cart</a>
                                    @endif
                                </div>
                            @else
                                <div class="site-btn-4 btn-common mt-3">
                                    <span>No Quantity Available ...</span>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="product_description mb-5">
        <div class="container">
            <ul class="nav nav-tabs pb-4" id="myTab" role="tablist">
                <li class="nav-item ps-0" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Review</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>{{$product->desc}}</p>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @foreach ($reviews as $review)
                        <div class="review-wrap">
                            <img src="
                                @if ($review->user->profile_pic == null)
                                    https://eu.ui-avatars.com/api/?name={{$review->user->fname}}+{{$review->user->lname}}&background=1c252c&color=fff&size=256
                                @else
                                    {{asset('images/profile_images/'.$review->user->profile_pic)}}
                                @endif" alt="" class="review-img">
                            <div>
                                <p class="review-name">{{$review->user->fname." ".$review->user->lname}}</p>
                                <p class="review">{{$review->review}}</p>
                            </div>
                        </div>
                    @endforeach
                    @if (Auth::user() != null)
                        @if (Auth::user()->user_type == 2 || Auth::user()->user_type == 3)
                            <div class="review_wrapp">
                                <form action="{{route('add-review')}}" method="POST">
                                    @csrf
                                    <input type="text" name="product_id" value="{{$product->id}}" hidden>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Review" rows="7" name="review">{{old('review')}}</textarea>
                                        <label for="Review">Write Your Review</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('review')
                                            {{$message}}
                                        @enderror
                                    </span>
                                    <div class="form-floating my-3">
                                        <input type="email" class="form-control" id="floatingInput" value="{{Auth::user()->email}}" disabled placeholder="name@example.com">
                                        <label for="floatingInput">Email Address</label>
                                    </div>
                                    <div class="site-btn-4 btn-common">
                                        <button type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <p class="p-5 text-center">Please <a href="{{route('login-page')}}">Login To Donator or Normal</a> Account To Review ...</p>
                        @endif
                    @else
                        <p class="p-5 text-center">Please <a href="{{route('login-page')}}">Login To Donator or Normal</a> Account To Review ...</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('visitor.inc.cta')
    @include('visitor.inc.gallery')
@endsection
@section('bodyExtra')
    <script>
        $(function() {
            @if (Session::has('cart-added-success'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ Session::get('cart-added-success') }}");
            @endif
            @if (Session::has('cart-added-error'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ Session::get('cart-added-error') }}");
            @endif
            @if (Session::has('review-added-success'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ Session::get('review-added-success') }}");
            @endif
            @if (Session::has('review-added-error'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ Session::get('review-added-error') }}");
            @endif
        });

        // Check quantity limit of the cart with available quantuty
        function checkQty(qty) {
            var iqty = $(qty).val();
            var pqty = {{ $product->available_qty }};
            if(iqty > pqty)
            {
                alert('The limit exceeded');
                $("span.plus").hide();
                $(qty).val(pqty);
            }
            else if(iqty <= pqty)
            {
                $("span.plus").show();
            }
        }
    </script>
@endsection

