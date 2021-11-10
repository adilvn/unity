@extends('admin.layout.adminlayout')
@section('title','Dashboard')
@section('headerExtra')
<link rel="stylesheet" href="{{asset('adminAssets/vendors/simple-datatables/style.css')}}">
<style>
    .create-admin {
        margin-left: auto;
        padding: 15px 35px 0 0;
    }
</style>
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
                <h3>Admins</h3>
                <p class="text-subtitle text-muted">For Super Admin To Manage Admins</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Admins</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="create-admin">
                <a href="{{ route('create-admin') }}"><button class="btn btn-primary">Create Admin</button></a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="admins-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Store Name</th>
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
                            <td>{{$user->store_name}}</td>
                            <td>
                                <a href="{{url('/admin/users/admins/status')}}/{{$user->id}}">
                                    <button class="badge btn {{ $user->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                        {{ $user->status == 1 ? 'Activated' : 'Deactivated' }}
                                    </button>
                                </a>
                            </td>
                            <td class="d-flex justify-content-evenly">
                                <a href="{{ route('edit-admin', ['id' => $user->id])}}" class="pt-2">
                                    <i class="bi bi-pencil-square text-success fs-5"></i>
                                </a>
                                <a onclick="return confirm('Are you sure you want to delete this admin?')" href="{{ route('delete-admin', ['id' => $user->id]) }}" class="pt-2">
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



<!-- Modal -->
<!-- <div class="modal fade" id="createAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-admin') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="basicInput">Username</label>
                        <input type="text" name="username" class="form-control" id="basicInput" placeholder="Enter username" id="username">
                        @if($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                        @error('')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="basicInput">First Name</label>
                        <input type="text" name="fname" class="form-control" id="basicInput" placeholder="Enter first name" id="fname">
                        @if($errors->has('fname'))
                        <span class="text-danger">{{ $errors->first('fname') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Last Name</label>
                        <input type="text" name="lname" class="form-control" id="basicInput" placeholder="Enter last name" id="lname">
                        @if($errors->has('lname'))
                        <span class="text-danger">{{ $errors->first('lname') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Email</label>
                        <input type="email" name="email" class="form-control" id="basicInput" placeholder="Enter email" id="email">
                        @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Password</label>
                        <input type="password" name="password" class="form-control" id="basicInput" placeholder="Enter password" id="password">
                        @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="create">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
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
        @if(Session::has('admin-delete'))
        toastr.options = {
            "timeOut": "3000",
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ Session::get('admin-delete') }}");
        @endif

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

<!-- <script>
    $(document).ready(function () {
        $(#create).click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                header: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
            });
            $.ajax({
                url: "{{ route('store-admin') }}",
                method: "POST",
                data: {
                    username: jQuery('#username').val(),
                    fname: jQuery('#fname').val(),
                    lname: jQuery('#lname').val(),
                    email: jQuery('#email').val(),
                    password: jQuery('#password').val(),
                },
                success: function (result) {
                    // jQuery('.alert').show();
                    // jQuery('.alert').html(result.success);
                }
            });
        });
    });
</script> -->
@endsection
