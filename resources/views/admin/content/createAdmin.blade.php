@extends('admin.layout.adminlayout')
@section('title','Dashboard')
@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Create Admin</h3>
                <p class="text-subtitle text-muted">For Super Admin To Create New Admin Role</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('get-admins') }}">Admins</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Admin</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <section id="multiple-column-form">
                        <div class="row match-height">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            @php
                                            if(isset($user))
                                            {
                                            $route = route('update-admin', ['id' => $user->id]);
                                            }
                                            else
                                            {
                                            $route = route('store-admin');
                                            }
                                            @endphp
                                            <form class="form" action="{{ $route }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="first-name-column">Username</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="username" id="username-column first-name-icon" class="form-control" placeholder="Enter Username" name="fname-column" value="{{ $user->username ??'' }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person-badge"></i>
                                                                </div>
                                                            </div>
                                                            @error('username')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="city-column">First Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="fname" id="first-name-column first-name-icon" class="form-control" placeholder="Enter First Name" name="city-column" value="{{ $user->fname ??'' }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person"></i>
                                                                </div>
                                                            </div>
                                                            @error('fname')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="city-column">Last Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="lname" id="last-name-column first-name-icon" class="form-control" placeholder="Enter Last Name" name="city-column" value="{{ $user->lname ??'' }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person"></i>
                                                                </div>
                                                            </div>
                                                            @error('lname')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="email-id-column">Email</label>
                                                            <div class="position-relative">
                                                                <input type="email" name="email" id="email-id-column first-name-icon" class="form-control" name="email-id-column" placeholder="Enter Email" value="{{ $user->email ??'' }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-envelope"></i>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="company-column">Password</label>
                                                            <div class="position-relative">
                                                                <input type="password" name="password" id="password-column" class="form-control" name="company-column" placeholder="Enter Password">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-lock"></i>
                                                                </div>
                                                            </div>
                                                            @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('bodyExtra')
<script>
    $(function() {
        @if(Session::has('success'))
        toastr.options = {
            'timeOut': '3000',
            'closeButton': true,
            'progressBar': true,
        }
        toastr.success("{{Session::get('success')}}");
        @endif
    });
</script>
@endsection
