@extends('visitor.layout.mainlayout')
@section('title', 'Business Profile')
@section('bodyExtra')
    <script>
        $(function() {
            @if (Session::has('business-register-success'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ Session::get('business-register-success') }}");
            @endif
            @if (Session::has('business-update-success'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ Session::get('business-update-success') }}");
            @endif
            @if (Session::has('business-update-error'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ Session::get('business-update-error') }}");
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
        });
        function fasterPreview( uploader ) {
            if ( uploader.files && uploader.files[0] ){
                $('#profileImage').attr('src',
                    window.URL.createObjectURL(uploader.files[0]) );
            }
        }

        function showImage(){
            $("#avatarImg").click();
        }
        $("#avatarImg").change(function(){
            fasterPreview( this );
        });
    </script>
@endsection
@section('content')
    <section class="owner-profie-sec">
        <div class="container-fluid p-0">
            <div class="row two-col-row">
                <div class="col store-menu-col p-0">
                    <div class="left-store-menu">
                        <h2 class="owner-name">{{Str::title("Hello ".Auth::user()->fname." ".Auth::user()->lname."!")}}</h2>
                        <ul>
                            <li><a href="{{route('business-profile')}}" class="active">My Profile</a></li>
                            <li><a href="{{route('get-products')}}">My Products</a></li>
                            <li><a href="{{route('get-business-orders')}}">Updated Donators <span class="notification-icon"><i class="fas fa-bell"></i></span></a></li>
                            <li><a href="{{route('business-payment')}}">Payment Detail</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 store-content-col">
                    <div class="store-content-wrap">
                        <div class="top-heading">
                            <h2>My Profile</h2>
                            {{-- <div class="site-btn-4 btn-common">
                                <a href="#">Edit Profile</a>
                            </div> --}}
                        </div>
                        <form action="{{route('business-update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="profile-hero-section">
                                <div class="left-profile align-items-center">
                                    <div class="profile-image">
                                        <div class="profile-box-img position-relative">
                                            <img id="profileImage" class="author-avtar" src="
                                            @if (Auth::user()->profile_pic == null)
                                                https://eu.ui-avatars.com/api/?name={{Auth::user()->fname}}+{{Auth::user()->lname}}&background=1c252c&color=fff&size=256
                                            @else
                                                {{asset('images/profile_images/'.Auth::user()->profile_pic)}}
                                            @endif
                                            ">
                                            <div class="w-100 h-100 d-flex align-items-end justify-content-center position-absolute top-0 left-0 pb-3">
                                                <i class="fas fa-camera text-white fs-2" style="cursor:pointer" onclick="showImage()"></i>
                                                <input type="file" name="avatar_img" id="avatarImg" style="display:none;">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger small">
                                        @error('avatar_img')
                                            Select Profile Picture
                                        @enderror
                                    </span>
                                    <div class="profile-description">
                                        <h3>{{Str::title(Auth::user()->fname." ".Auth::user()->lname)}}</h3>
                                        <div class="unity-user-main">
                                            <span class="unity-user">{{Str::upper(Auth::user()->username)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="business-profile_wrapp mt-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{Auth::user()->fname}}" name="fname">
                                            <label for="FirstName">First Name</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('fname')
                                                Required
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{Auth::user()->lname}}" name="lname">
                                            <label for="LastName">Last Name</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('lname')
                                                Required
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" value="{{Auth::user()->email}}" name="email">
                                            <label for="Email">Email</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('email')
                                                Required
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" value="{{Auth::user()->phone}}" name="phone">
                                            <label for="Phone">Phone Number</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('phone')
                                                Required
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{Auth::user()->store_name}}" name="store_name">
                                            <label for="StoreName">Store Name</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('store_name')
                                                Required
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{Auth::user()->store_location}}" name="store_location">
                                            <label for="StoreLocation">Store Location</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('store_location')
                                                Required
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{Auth::user()->pcode}}" name="pcode">
                                            <label for="PostCode">Post Code</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('pcode')
                                                Required
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" value="{{Auth::user()->country}}" name="country">
                                            <label for="Country">Country</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('country')
                                                Required
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="site-btn-4 btn-common">
                                            <button type="submit">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
