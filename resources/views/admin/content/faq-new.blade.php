@extends('admin.layout.adminlayout')
@section('title', 'Create FAQ')
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
                    <p class="text-subtitle text-muted">For Super Admin To Create FAQ</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('get-faqs') }}">FAQ's</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create FAQ</li>
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
                                                    if (isset($faq) && $faq->id > 0) {
                                                        $route = route('update-faq', ['id' => $faq->id]);
                                                    } else {
                                                        $route = route('save-faq');
                                                    }
                                                @endphp
                                                <form class="form" action="{{ $route }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="question">Question</label>
                                                                    <input type="text" name="question" id="question-column first-name-icon" class="form-control" placeholder="Enter the question" value="{{ $faq->question ?? '' }}">
                                                                    @error('question')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="answer" class="form-label">Answer</label>
                                                                <textarea class="form-control" name="answer" id="" rows="3" placeholder="Enter the answer">{{ $faq->answer ?? '' }}</textarea>
                                                                @error('answer')
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
            @if (Session::has('save-faq'))
                toastr.options = {
                'timeOut': '3000',
                'closeButton': true,
                'progressBar': true,
                }
                toastr.success("{{ Session::get('save-faq') }}");
            @endif
        });
    </script>
@endsection
