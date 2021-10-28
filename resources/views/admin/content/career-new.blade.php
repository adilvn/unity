@extends('admin.layout.adminlayout')
@section('title', 'Create Career')
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
                    <h3>Create Career</h3>
                    <p class="text-subtitle text-muted">For Admin To Create Career</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('get-careers') }}">Careers</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Career</li>
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
                                                    if (isset($career) && $career->id > 0) {
                                                        $route = route('update-career', ['id' => $career->id]);
                                                    } else {
                                                        $route = route('save-career');
                                                    }
                                                @endphp
                                                <form class="form" action="{{ $route }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="position">Position</label>
                                                                <input type="text" name="position"
                                                                    id="first-name-icon"
                                                                    class="form-control" placeholder="Enter the career position"
                                                                    value="{{ $career->position ?? '' }}">
                                                                @error('position')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="location">Location</label>
                                                                <input type="text" name="location"
                                                                    id="first-name-icon"
                                                                    class="form-control" placeholder="Enter the location"
                                                                    value="{{ $career->location ?? '' }}">
                                                                @error('location')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="type">Type</label>
                                                                <input type="text" name="type"
                                                                    id="first-name-icon"
                                                                    class="form-control" placeholder="Enter the type"
                                                                    value="{{ $career->type ?? '' }}">
                                                                @error('type')
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
            @if (Session::has('save-career'))
                toastr.options = {
                'timeOut': '3000',
                'closeButton': true,
                'progressBar': true,
                }
                toastr.success("{{ Session::get('save-career') }}");
            @endif
        });
    </script>
@endsection
