@extends('admin.layout.adminlayout')
@section('title', 'Contact Us Queries')
@section('headerExtra')
    <link rel="stylesheet" href="{{ asset('adminAssets/vendors/simple-datatables/style.css') }}">
@endsection
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
                    <h3>Contact Us Queries</h3>
                    <p class="text-subtitle text-muted">For Admin To Manage Contact Us Queries</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us Queries</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="contact-us-queries-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($queries as $query)
                            <tr>
                                <td>{{ $query->name ??'' }}</td>
                                <td><a href="mailto:{{ $query->email ??'' }}">{{ $query->email ??'' }}</a></td>
                                <td>{{ $query->message ??'' }}</td>
                                <td class="justify-content-evenly">
                                    <a onclick="return confirm('Are you sure you want to delete this Query?')" href="{{ route('delete-query', ['id' => $query->id]) }}" class="pt-2">
                                        <i class="bi bi-trash text-danger fs-5"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
@section('bodyExtra')
    <script src="{{ asset('adminAssets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#contact-us-queries-table');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script>
        $(function() {
        @if(Session::has('delete-query'))
        toastr.options = {
            'timeOut': '3000',
            'closeButton': true,
            'progressBar': true
        }
        toastr.success("{{ Session::get('delete-query') }}");
        @endif
        });
    </script>
@endsection
