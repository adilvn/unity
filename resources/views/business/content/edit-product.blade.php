@extends('visitor.layout.mainlayout')
@section('title', 'Edit Product')
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
                            <h2>Edit Product</h2>
                            <div class="site-btn-4 btn-common">
                                <a href="{{route('business-add-product')}}"> Add New</a>
                            </div>
                        </div>
                        <div class="add_product_wrapp">
                            <form action="{{route('update-product')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="pr_id" value="{{$product->id}}">
                                <div class="mb-3">
                                    <select class="form-select" name="pr_cat" id="">
                                        <option value="0" {{ $product->cat == null ? 'Selected' : ''}}>Select Category</option>
                                        <option value="1" {{ $product->cat == 1 ? 'Selected' : ''}}>Coffee</option>
                                        <option value="2" {{ $product->cat == 2 ? 'Selected' : ''}}>Meals</option>
                                        <option value="3" {{ $product->cat == 3 ? 'Selected' : ''}}>Beds</option>
                                    </select>
                                    <span class="text-danger small">
                                        @error('pr_cat')
                                            Select Product Category
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Product Name" value="{{$product->name}}" value="{{old('pr_name')}}" name="pr_name">
                                        <label for="productName">Product Name</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('pr_name')
                                            Prodcut Name Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Store Name" value="{{Auth::user()->store_name}}" name="pr_sname" disabled>
                                        <label for="StoreName">Store Name</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('pr_sname')
                                            Store Name Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Location" value="{{Auth::user()->store_location.", ".Auth::user()->pcode.", ".Auth::user()->country}}" name="pr_slocation" disabled>
                                        <label for="Location">Location</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('pr_slocation')
                                            Store Location Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" placeholder="Regular Price" value="{{$product->price}}" value="{{old('price')}}" name="price">
                                            <label for="Price">Regular Price ($)</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('price')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" placeholder="Quantity" value="{{$product->qty}}" value="{{old('pr_quantity')}}" name="pr_quantity">
                                            <label for="Quantity">Quantity</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('pr_quantity')
                                                Prodcut Quantity Required
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Description" rows="10" name="description">{{$product->desc}}</textarea>
                                        <label for="Description">Product Description</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('description')
                                            {{-- Prodcut Description Required --}}
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="URL" value="{{$product->url}}" value="{{old('url')}}" name="url">
                                        <label for="url">URL</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('url')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <div class="upload_photo">
                                        <label for="formFile" class="form-label">Product Image</label>
                                        <div class="edit-product-img-box">
                                            <div class="edit-product-img position-relative">
                                                <img id="productImage" class="author-avtar" src="{{asset('images/product_images/'.$product->img)}}">
                                                <div class="w-100 h-100 d-flex align-items-end justify-content-center position-absolute top-0 left-0 pb-3">
                                                    <i class="fas fa-camera text-white fs-2" style="cursor:pointer" onclick="showImage()"></i>
                                                    <input type="file" id="formFile"  name="pr_img" style="display:none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger small">
                                        @error('pr_img')
                                            Prodcut Image Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="site-btn-4 btn-common">
                                    <button type="submit">Publish</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bodyExtra')
    <script>
        @if (Session::has('product-update-error'))
            toastr.options =
            {
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ Session::get('product-update-error') }}");
        @endif
        function fasterPreview( uploader ) {
            if ( uploader.files && uploader.files[0] ){
                $('#productImage').attr('src',
                    window.URL.createObjectURL(uploader.files[0]) );
            }
        }

        function showImage(){
            $("#formFile").click();
        }
        $("#formFile").change(function(){
            fasterPreview( this );
        });
    </script>
@endsection
