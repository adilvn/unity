@extends('visitor.layout.mainlayout')
@section('title', 'Account Is Not Verified')
@section('content')
<div class="p-5 container">
    <div class="alert alert-success" role="alert">
        <div class="d-flex align-items-center justify-content-center gap-2">
            <i class="fas fa-check-circle fs-4"></i>
            <h4 class="alert-heading">Business Application Successfully Submitted!</h4>
        </div>
        <hr>
        <p class="text-center">An admin will review your application and you'll get an confirmation email very soon.</p>
    </div>
</div>
@endsection
