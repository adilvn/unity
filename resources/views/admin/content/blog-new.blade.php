@extends('admin.layout.adminlayout')
@section('title', 'Create Blog')
@section('headerExtra')
    <a href="{{ asset('adminAssets/vendors/summernote/summernote.min.css') }}"></a>
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
                                                                <label for="image">Image</label>
                                                                    <input type="file" name="img" id="img first-name-icon" class="form-control" placeholder="Upload an image" value="{{ $blog->image ?? '' }}">
                                                                    @error('img')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="title">Title</label>
                                                                    <input type="text" name="title" id="title first-name-icon" class="form-control" placeholder="Enter the blog title" value="{{ $blog->title ?? '' }}">
                                                                    @error('title')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="description" class="form-label">Description</label>
                                                                <textarea id="summernote" class="form-control" name="desc" rows="3" placeholder="Enter the blog description">{{ $blog->description ?? '' }}</textarea>
                                                                @error('desc')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="url">URL</label>
                                                                    <input type="text" name="url" id="url first-name-icon" class="form-control" placeholder="Enter the blog url" value="{{ $blog->url ?? '' }}">
                                                                    @error('url')
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
    <script src="{{ asset('adminAssets/vendors/summernote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
