@extends('admin.layout.adminlayout')
@section('title', 'FAQ\'s')
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
                    <h3>FAQ's</h3>
                    <p class="text-subtitle text-muted">For Super Admin To Manage FAQ's</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">FAQ's</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="faqs-table">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                            <tr>
                                <td>{{ $faq->question ??'' }}</td>
                                <td>
                                    <a href="{{ route('update-faq-status', ['id' => $faq->id]) }}">
                                        <button class="badge btn {{ $faq->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $faq->status == 1 ? 'Enabled' : 'Disabled' }}</button>
                                    </a>
                                </td>
                                <td class="justify-content-evenly">
                                    <a href="{{ route('edit-faq', ['id' => $faq->id])}}" class="pt-2">
                                        <i class="bi bi-pencil-square text-success fs-5"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete this FAQ?')" href="{{ route('delete-faq', ['id' => $faq->id]) }}" class="pt-2">
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
        let table1 = document.querySelector('#faqs-table');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script>
        $(function() {
        @if(Session::has('delete-faq'))
        toastr.options = {
            'timeOut': '3000',
            'closeButton': true,
            'progressBar': true
        }
        toastr.success("{{ Session::get('delete-faq') }}");
        @endif
        });
    </script>
@endsection
