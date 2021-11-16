@extends('visitor.layout.mainlayout')
@section('title', 'Forgot Password')
@section('content')
    <section class="login">
        <div class="container">
            <div class="row justify-content-center d-padding">
                <div class="col-lg-6 col-md-8">
                    <div class="login_wrapp p-4">
                        <h2 class="text-center mb-3">Forgot Password</h2>
                        <form action="{{ route('forgot') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" value="{{old('email')}}" id="floatingInput" placeholder="Enter your email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <label for="floatingInput">Email Address</label>
                            </div>
                            <div class="forgot_password text-end">
                                <a href="{{route('login-page')}}" class="d-inline-block">Back to Login</a>
                            </div>
                            <div class="site-btn-4 btn-common text-center">
                            <button type="submit" class="w-100">Send Request</button>
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
            @if (Session::has('sent-mail'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                }
                toastr.success("{{ Session::get('sent-mail') }}");
            @endif

            @if (Session::has('no-email-found'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                }
                toastr.error("{{ Session::get('no-email-found') }}");
            @endif
        });
    </script>
@endsection
