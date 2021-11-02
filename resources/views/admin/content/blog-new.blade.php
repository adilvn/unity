@extends('admin.layout.adminlayout')
@section('title', 'Create Blog')
@section('headerExtra')
    <link rel="stylesheet" href="{{ asset('adminAssets/vendors/summernote/summernote-lite.min.css') }}">
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
                    <h3>Create Blog</h3>
                    <p class="text-subtitle text-muted">For Admin To Create Blog</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('get-blogs') }}">Blogs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @php
                            if (isset($blog) && $blog->id > 0) {
                                $route = route('update-blog', ['id' => $blog->id]);
                            } else {
                                $route = route('save-blog');
                            }
                        @endphp
                        <form class="form" action="{{ $route }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="img" class="form-label">Image</label>
                                        <input class="form-control" type="file" name="img" placeholder="Upload an image">
                                        @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title first-name-icon" class="form-control"
                                            placeholder="Enter the blog title" value="{{ $blog->title ?? '' }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="desc" id="summernote" placeholder="Enter Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="url">URL</label>
                                        <input type="text" name="url" id="url first-name-icon" class="form-control"
                                            placeholder="Enter the blog url" value="{{ $blog->url ?? '' }}">
                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bodyExtra')
    <script>
        $(function() {
            @if (Session::has('save-blog'))
                toastr.options = {
                'timeOut': '3000',
                'closeButton': true,
                'progressBar': true,
                }
                toastr.success("{{ Session::get('save-blog') }}");
            @endif
        });
    </script>
    <script src="{{ asset('adminAssets/vendors/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 220,
        });
    </script>
@endsection
