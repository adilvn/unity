@extends('admin.layout.adminlayout')
@section('title', 'Update Contact Info')
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
                    <h3>Update Contact Info</h3>
                    <p class="text-subtitle text-muted">For Admin to Update Contact Information</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Contact Info</li>
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
                                                    if (isset($contactInfo) && $contactInfo->id > 0) {
                                                        $route = route('update-contact-info', ['id' => $contactInfo->id]);
                                                    } else {
                                                        $route = route('save-contact-info');
                                                    }
                                                @endphp
                                                <form class="form" action="{{ $route }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="position">Brief Detail</label>
                                                                <textarea name="detail" class="form-control" id="" rows="3">{{ $contactInfo->brief_detail ??'' }}</textarea>
                                                                @error('detail')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="location">Address</label>
                                                                <input type="text" name="address"
                                                                    class="form-control" placeholder="Enter the address" value="{{ $contactInfo->address ??'' }}">
                                                                @error('address')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="phone">Phone Number</label>
                                                                <input type="text" name="phone"
                                                                    class="form-control" placeholder="Enter the phone number" value="{{ $contactInfo->ph_no ??'' }}">
                                                                @error('phone')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="phone">Email</label>
                                                                <input type="text" name="email"
                                                                    class="form-control" placeholder="Enter the email" value="{{ $contactInfo->email ??'' }}">
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit"
                                                                class="btn btn-primary me-1 mb-1">Submit</button>
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
            @if (Session::has('save-contact-info'))
                toastr.options = {
                'timeOut': '3000',
                'closeButton': true,
                'progressBar': true,
                }
                toastr.success("{{ Session::get('save-contact-info') }}");
            @endif
        });
    </script>
@endsection
