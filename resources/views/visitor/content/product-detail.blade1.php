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
                                    <input type="text" value="1" name="qty"/>
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
                <div class="review_wrapp">
                    <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Review" rows="7"></textarea>
                            <label for="Review">Write Your Review</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email Address</label>
                        </div>
                        <div class="site-btn-4 btn-common">
                            <button type="button">Submit</button>
                        </div>
                </div>
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
        });
    </script>
@endsection

