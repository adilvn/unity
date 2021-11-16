@extends('visitor.layout.mainlayout')
@section('title', 'Create New Password')
@section('content')
    <section class="login">
        <div class="container">
            <div class="row justify-content-center d-padding">
                <div class="col-lg-6 col-md-8">
                    <div class="login_wrapp p-4">
                        <h2 class="text-center mb-3">New Password</h2>
                        <form action="{{route('user-login')}}" method="POST">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Create New Password</label>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="cpassword" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Confirm Your Password</label>
                                @error('cpassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="site-btn-4 btn-common text-center">
                            <button type="submit" class="w-100">Change Password</button>
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
