@extends('admin.layout.adminlayout')
@section('title', 'Careers')
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
                    <h3>Careers</h3>
                    <p class="text-subtitle text-muted">For Admin To Manage Careers</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Careers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="careers-table">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($careers as $career)
                            <tr>
                                <td>{{ $career->position ??'' }}</td>
                                <td>{{ $career->location ??'' }}</td>
                                <td>{{ $career->type ??'' }}</td>
                                <td>
                                    <a href="{{ route('update-career-status', ['id' => $career->id]) }}">
                                        <button class="badge btn {{ $career->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $career->status == 1 ? 'Enabled' : 'Disabled' }}</button>
                                    </a>
                                </td>
                                <td class="justify-content-evenly">
                                    <a href="{{ route('edit-careers', ['id' => $career->id])}}" class="pt-2">
                                        <i class="bi bi-pencil-square text-success fs-5"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete this career?')" href="{{ route('delete-career', ['id' => $career->id]) }}" class="pt-2">
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
        let table1 = document.querySelector('#careers-table');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script>
        $(function() {
        @if(Session::has('delete-career'))
        toastr.options = {
            'timeOut': '3000',
            'closeButton': true,
            'progressBar': true
        }
        toastr.success("{{ Session::get('delete-career') }}");
        @endif
        });
    </script>
@endsection
