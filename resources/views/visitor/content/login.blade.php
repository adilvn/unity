@extends('visitor.layout.mainlayout')
@section('title', 'Login To Your Account')
@section('content')
    <section class="login">
        <div class="container">
            <div class="row justify-content-center d-padding">
                <div class="col-lg-6 col-md-8">
                    <div class="login_wrapp p-4">
                        <h2 class="text-center mb-3">Login</h2>
                        <form action="{{route('user-login')}}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" value="{{old('name')}}" id="floatingInput" placeholder="user@unity.com">
                                <label for="floatingInput">Email Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" value="{{old('password')}}" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="forgot_password text-end">
                                <a href="#" class="d-inline-block">Forgot Password?</a>
                            </div>
                            <div class="site-btn-4 btn-common text-center">
                            <button type="submit" class="w-100">Login</button>
                        </div>
                        <div class="register_log mt-3">
                            <p class="text-center">Don't have an account? <a href="{{route('register-page')}}">Register</a></p>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bodyExtra')
    <script>
        $(function() {
            @if (Session::has('user-login-error'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ Session::get('user-login-error') }}");
            @endif
        });
    </script>
@endsection
