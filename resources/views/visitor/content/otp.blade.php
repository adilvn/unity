@extends('visitor.layout.mainlayout')
@section('title', 'OTP Verification')
@section('content')
    <section class="login">
        <div class="container">
            <div class="row justify-content-center d-padding">
                <div class="col-lg-6 col-md-8">
                    <div class="login_wrapp p-4">
                        <h2 class="text-center mb-3">Check your email!</h2>
                        <form action="#" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="otp" id="floatingInput" placeholder="Enter your email">
                                @error('otp')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <label for="floatingInput">Your confirmation code</label>
                            </div>
                            <div class="site-btn-4 btn-common text-center">
                            <button type="submit" class="w-100">Verify</button>
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
            @if (Session::has('found'))
                toastr.options =
                {
                    "timeOut": "3000",
                    "closeButton": true,
                }
                toastr.error("{{ Session::get('found') }}");
            @endif
        });
    </script>
@endsection
