@extends('visitor.layout.mainlayout')
@section('title', 'Donator Profile')
@section('bodyExtra')
    <script>
        $(function() {
            @if (Session::has('donator-register-success'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ Session::get('donator-register-success') }}");
            @endif
            @if (Session::has('donator-update-success'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ Session::get('donator-update-success') }}");
            @endif
            @if (Session::has('donator-update-error'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ Session::get('donator-update-error') }}");
            @endif
            @if (Session::has('order-confirm-success'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ Session::get('order-confirm-success') }}");
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
    <section class="profile-hero-section d-padding">
        <div class="container">

            <div class="row">

                <div class="col-md-7 mb-5 mb-md-0">
                    <div class="left-profile">
                        <div class="profile-image text-center">
                            <form action="{{route('donator-update-img')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
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
                                <button type="submit" class="image-update">Upload Image</button>
                            </form>
                            {{-- <div class="profile-box-content" id="profile-box-content-lg"><a href="#" class="say-thanks">Say thanks!<i class="far fa-smile"></i></a></div> --}}
                        </div>
                        <div class="profile-description">
                            <h3>{{Str::title(Auth::user()->fname." ".Auth::user()->lname);}}</h3>
                            <div class="unity-user-main"><span class="unity-user">{{Str::upper(Auth::user()->username)}}</span></div>
                            <div class="profile-facilities">
                                <div class="facility-box">
                                    <div class="facility-box-img"><img src="{{asset('images/feather-coffee.png')}}"></div>
                                    <span class="facility-counter">{{$coffees}}</span>
                                </div>
                                <div class="facility-box">
                                    <div class="facility-box-img"><img src="{{asset('images/map-food.png')}}"></div>
                                    <span class="facility-counter">{{$meals}}</span>
                                </div>
                                <div class="facility-box">
                                    <div class="facility-box-img"><img src="{{asset('images/awesome-bed.png')}}"></div>
                                    <span class="facility-counter">{{$beds}}</span>
                                </div>
                                <div class="facility-box">
                                    <div class="facility-box-img"><img src="{{asset('images/awesome-heart.png')}}"></div>
                                    <span class="facility-counter">{{$thanks}}</span>
                                </div>
                            </div>
                            {{-- <div class="profile-box-content" id="profile-box-content-sm"><a href="#" class="say-thanks">Say thanks!<i class="far fa-smile"></i></a></div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="right-profile">
                        <div class="sharing-quote">
                            <h2>Sharing is caring</h2>
                        </div>
                        <div class="charity-des">
                            <div class="smile-face">
                                <img src="{{asset('images/smile-face.png')}}">
                            </div>
                            <div class="smile-content">
                                <h2>Favourite Charity <span>St Francis Hospital</span></h2>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>

    <section class="profile_tab_wrapp">
        <div class="tab_head">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 px-sm-3 p-0">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#profle" type="button" role="tab" aria-controls="profle" aria-selected="true">My Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#donation" type="button" role="tab" aria-controls="donation" aria-selected="false">My Donation</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Messages</button>
                        </li>
                        </ul>
                    </div>
                    <div class="col-md-2 px-sm-3 p-0">
                        <div class="logout_button">
                            <a href="{{route('user-logout')}}">Logout</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="tab_body">
            <div class="container">
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profle" role="tabpanel" aria-labelledby="profle-tab">
                    <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="edit_profile">
                            <form action="{{route('donator-update')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="fname" value="{{Auth::user()->fname}}">
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
                                            <input type="text" class="form-control" name="lname" value="{{Auth::user()->lname}}">
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
                                            <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}">
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
                                            <input type="tel" class="form-control" name="phone" value="{{Auth::user()->phone}}">
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
                                            <input type="text" class="form-control" name="store_name" value="{{Auth::user()->store_name}}">
                                            <label for="StoreName">Address</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('store_name')
                                                Required
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="store_location" value="{{Auth::user()->store_location}}">
                                            <label for="StoreLocation">City</label>
                                        </div>
                                        <span class="text-danger small">
                                            @error('store_location')
                                                Required
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="pcode" value="{{Auth::user()->pcode}}">
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
                                            <input type="tel" class="form-control" name="country" value="{{Auth::user()->country}}">
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
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="donation" role="tabpanel" aria-labelledby="donation-tab">
                    <div class="donation_table ">
                        @if (count($donations) > 0)
                            <table id="datatable-donation" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>date</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>QTY</th>
                                        <th>Owener</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donations as $donation)
                                        <tr>
                                            <td>{{date("d M Y", strtotime($donation->created_at))}}</td>
                                            <td>{{$donation->product->name}}</td>
                                            <td>${{intval($donation->product->price)}}</td>
                                            <td>{{$donation->qty}}</td>
                                            <td>{{$donation->user->store_name}} <span>{{$donation->user->store_location}}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="p-5 text-center">No Donation Found ...</p>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            @if (count($messages) > 0)
                                @foreach ($messages as $message)
                                    <div class="comments_wrapp p-2 mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 text-center pb-3 pb-md-0">
                                                <div class="user_img">
                                                    <img src="
                                                    @if ($message->user->profile_pic == null)
                                                        https://eu.ui-avatars.com/api/?name={{$message->user->fname}}+{{$message->user->lname}}&background=1c252c&color=fff&size=256
                                                    @else
                                                        {{asset('images/profile_images/'.$message->user->profile_pic)}}
                                                    @endif" alt="" class="rounded-circle">
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="comment_inner">
                                                    <h2>{{$message->user->fname." ".$message->user->lname}}</h2>
                                                    <p class="m-0  mb-md-0 mb-3">{{$message->message}}</p>
                                                    <h5>{{date("d M Y", strtotime($message->created_at))}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="pagination justify-content-center mt-4">
                                    {{ $messages->links() }}
                                </div>
                            @else
                                <p class="p-5 text-center">No Message Found ...</p>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection
