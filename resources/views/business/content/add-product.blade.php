@extends('visitor.layout.mainlayout')
@section('title', 'Add New Product')
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
                            <h2>Add Product</h2>
                            <div class="site-btn-4 btn-common">
                                <a href="{{route('business-add-product')}}"> Add New</a>
                            </div>
                        </div>
                        <div class="add_product_wrapp">
                            <form action="{{route('upload-product')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <select class="form-select" name="pr_cat" id="">
                                        <option value="0">Select Category</option>
                                        <option value="1">Coffee</option>
                                        <option value="2">Meals</option>
                                        <option value="3">Beds</option>
                                    </select>
                                    <span class="text-danger small">
                                        @error('pr_cat')
                                            Select Product Category
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" id="pr_name" class="form-control" placeholder="Product Name" value="{{old('pr_name')}}" oninput="addURL()" name="pr_name">
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
                                            <input type="text" class="form-control" placeholder="Regular Price" value="{{old('price')}}" name="price">
                                            <label for="Price">Regular Price ($)</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('price')
                                                {{-- Prodcut Price Required --}}
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" placeholder="Quantity" value="{{old('pr_quantity')}}" name="pr_quantity">
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
                                        <textarea class="form-control" placeholder="Description" rows="10" name="description">{{old('description')}}</textarea>
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
                                    <div class="upload_photo">
                                        <label for="formFile" class="form-label">Upload Product Image</label>
                                        <input class="form-control" type="file" id="formFile"  name="pr_img" value="{{old('pr_img')}}">
                                    </div>
                                    <span class="text-danger small">
                                        @error('pr_img')
                                            Prodcut Image Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="pr_url" placeholder="URL" value="{{old('url')}}" name="url">
                                        <label for="url">URL</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('url')
                                            {{$message}}
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
        function addURL() {
            var name = document.getElementById("pr_name").value.replace(/[^A-Za-z ]+/g, '');
            var url = name.replaceAll(" ", "-").toLowerCase();
            if(url.charAt(url.length-1) == "-"){
                url = url.substring(0, url.length - 1);
            }
            document.getElementById("pr_url").value = url;
        }
    </script>
    <script>
        @if (Session::has('product-added-error'))
            toastr.options =
            {
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ Session::get('product-added-error') }}");
        @endif
    </script>
@endsection
