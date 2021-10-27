@extends('admin.layout.adminlayout')
@section('title','Dashboard')
@section('headerExtra')
    <link rel="stylesheet" href="{{asset('adminAssets/vendors/simple-datatables/style.css')}}">
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
                    <h3>Donators</h3>
                    <p class="text-subtitle text-muted">For Super Admin To Manage Donators</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Donators</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="admins-table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->fname." ".$user->lname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->store_name.", ".$user->store_location.", ".$user->pcode.", ".$user->country}}</td>
                                    <td>
                                        <a href="{{ route('donator-status-update', ['id' => $user->id]) }}">
                                            <button class="badge btn {{ $user->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                                {{ $user->status == 1 ? 'Activated' : 'Deactivated' }}
                                            </button>
                                        </a>
                                    </td>
                                    <td class="d-flex justify-content-evenly">
                                        <a onclick="return confirm('Are you sure you want to delete this donator?')" href="{{ route('delete-donator', ['id' => $user->id]) }}" class="pt-2">
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
    <script src="{{asset('adminAssets/vendors/simple-datatables/simple-datatables.js')}}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#admins-table');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script>
        $(function() {
            @if (Session::has('donator-delete'))
            toastr.options = {
                'timeOut': '3000',
                'closeButton': true,
                'progressBar': true,
            }
            toastr.success("{{ Session::get('donator-delete') }}");
            @endif
        });
    </script>
@endsection
