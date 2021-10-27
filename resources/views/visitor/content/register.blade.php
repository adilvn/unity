@extends('visitor.layout.mainlayout')
@section('title', 'Register To Unity')
@section('bodyExtra')
    <script>
        $(document).ready(function(){
            $('button[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('data-bs-target'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
                $('#myTab button[data-bs-target="' + activeTab + '"]').tab('show');
            }
        });
    </script>
    <script>
        $(function() {
            @if (Session::has('donator-register-error'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ Session::get('donator-register-error') }}");
            @endif
            @if (Session::has('business-register-error'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ Session::get('business-register-error') }}");
            @endif
        });
    </script>
@endsection
@section('content')
    <section class="inner_header gestures">
        <div class="container">
            <h2>Register</h2>
            <p class="text-white">It’s no secret that what goes around comes around. Offer a kind gesture to someone in need and let that altruistic energy flow. A cup of coffee, some groceries, or just a safe place to sleep; you have the power to make a positive difference in someone's life.</p>
        </div>
    </section>

    <section class="register_wrapp d-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="register_box p-4">
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Business Owners Register</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Donators Register</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form action="{{route('register-business')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Username" name="busername" value="{{old('busername')}}">
                                        <label for="username">Username</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('busername')
                                            Username Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="First Name" name="bfname" value="{{old('bfname')}}" >
                                        <label for="FirstName">First Name</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('bfname')
                                            First Name Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Last Name" name="blname" value="{{old('blname')}}">
                                        <label for="LastName">Last Name</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('blname')
                                            Last Name Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" placeholder="Email Address" name="bemail" value="{{old('bemail')}}">
                                        <label for="Email">Email Address</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('bemail')
                                            Email Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" placeholder="Phone Number" name="bphone" value="{{old('bphone')}}">
                                        <label for="PhoneNumber">Phone Number</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('bphone')
                                            Phone Number Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Store Name" name="bstore_name" value="{{old('bstore_name')}}">
                                        <label for="StoreName">Store Name</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('bstore_name')
                                            Store Name Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Store Location" name="bstore_location" value="{{old('bstore_location')}}">
                                        <label for="StoreLocation">Store Location</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('bstore_location')
                                            Store Location Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Postal Code" name="bpcode" value="{{old('bpcode')}}">
                                        <label for="PostalCode">Postal Code</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('bpcode')
                                            Postal Code Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Country" name="bcountry" value="{{old('bcountry')}}">
                                        <label for="Country">Country</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('bcountry')
                                            Country Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" placeholder="Password" name="bpassword">
                                        <label for="Password">Password</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('bpassword')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="bcpassword">
                                        <label for="CPassword">Password</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('bcpassword')
                                            Same Password Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12 mb-3 mt-1 text-center">
                                    <small class="small">Minimum 8 characters including uppercase, lowercase, symbol and number.</small>
                                </div>
                            </div>
                        <div class="site-btn-4 btn-common text-center">
                            <button type="submit" class="w-100">Register</button>
                        </div>
                        <div class="register_log mt-3">
                                <p class="text-center">Already have an account? <a href="{{route('login-page')}}">Login</a></p>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{route('register-donator')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Username" name="username" value="{{old('username')}}">
                                        <label for="username">Username</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('username')
                                            Username Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="First Name" name="fname" value="{{old('fname')}}" >
                                        <label for="FirstName">First Name</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('fname')
                                            First Name Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Last Name" name="lname" value="{{old('lname')}}">
                                        <label for="LastName">Last Name</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('lname')
                                            Last Name Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" placeholder="Email Address" name="email" value="{{old('email')}}">
                                        <label for="Email">Email Address</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('email')
                                            Email Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" placeholder="Phone Number" name="phone" value="{{old('phone')}}">
                                        <label for="PhoneNumber">Phone Number</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('phone')
                                            Phone Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Location" name="store_name" value="{{old('store_name')}}">
                                        <label for="StoreName">Location</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('store_name')
                                            Location Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="City" name="store_location" value="{{old('store_location')}}">
                                        <label for="StoreLocation">City</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('store_location')
                                            City Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Postal Code" name="pcode" value="{{old('pcode')}}">
                                        <label for="PostalCode">Postal Code</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('pcode')
                                            Postal Code Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="Country" name="country" value="{{old('country')}}">
                                        <label for="Country">Country</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('country')
                                            Country Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                        <label for="Password">Password</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('password')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">
                                        <label for="CPassword">Password</label>
                                    </div>
                                    <span class="text-danger small">
                                        @error('cpassword')
                                            Same Password Required
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12 mb-3 mt-1 text-center">
                                    <small class="small">Minimum 8 characters including uppercase, lowercase, symbol and number.</small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div>
                                        <select class="form-select" name="user_type">
                                        <option value="0">Select Role</option>
                                        <option value="1">Normal</option>
                                        <option value="2">Donator</option>
                                        </select>
                                    </div>
                                    <span class="text-danger small">
                                        @error('user_type')
                                            Select User Role
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="site-btn-4 btn-common text-center">
                                <button type="submit" class="w-100">Register</button>
                            </div>
                            <div class="register_log mt-3">
                                <p class="text-center">Already have an account? <a href="{{route('login-page')}}">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
