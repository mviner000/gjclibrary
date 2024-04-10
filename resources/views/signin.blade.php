@extends('layouts.app', ['title' => 'GJCLibrary - Add Book'])

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo and Text -->
        <a href="" class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('images/gjc_logo.png') }}" alt="GJC Logo" class="logo-image mr-1" style="width: 34px; margin-right: 3px">
            <span class="ml-2">GJC</span>
        </a>

        <a href="" class="btn btn-primary disabled">Register</a>
    </div>
</nav>

@section('content')
<div class="container">
    <div class="row py-5 mt-4 align-items-center">
        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
            <img src="{{ asset('images/gjc_library_logo.png') }}" alt="" class="img-fluid mb-3 d-none d-md-block">
            <h1 style="margin-top: -50px;">Welcome Back GJCian</h1>


            <p class="text-muted mb-0">Quote of the Day:</p>
            @if($latestQuote)
                    <p class="font-italic text-muted mb-0"><em>{{ $latestQuote->content }}</em>
                    @if($latestQuote->author)
                        - {{ $latestQuote->author }}
                    @endif
                    </p>
            @else
                <p class="font-italic text-muted mb-0">No quotes available</p>
            @endif

            
        </div>

        <!-- Signin Form -->
<div class="col-md-7 col-lg-6 ml-auto mt-5">
    
<!-- Error Message -->
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="padding-bottom: 0.5rem; padding-top: 0.5rem;">
    
<div class="d-flex flex-row">
<div class="row">
    <strong class="col-auto p-0 m-1">Sorry!</strong>
    <div class="col p-0 m-1">{{ $errors->first() }}</div>
</div>

</div>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif




    <form method="POST" action="{{ route('login') }}">
        @csrf <!-- CSRF Token -->

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope text-muted"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address" aria-describedby="email-address" required>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock text-muted"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password" required>
        </div>


        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Sign in</button>
        </div>

        <!-- Divider Text -->
        <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
            <div class="border-bottom w-100 ml-5"></div>
            <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
            <div class="border-bottom w-100 mr-5"></div>
        </div>

        <!-- Social Login -->
        <div class="form-group d-grid gap-2 mx-auto mb-3">
            <a href="" style="cursor: zoom-in" class="disabled btn btn-success btn-block py-2 btn-facebook">
                <i class="fab fa-google mr-2"></i>
                <span class="font-weight-bold">Continue with Google</span>
            </a>
        </div>

        <!-- Doesn't Have an Account -->
        <div class="text-center w-100">
            <p class="text-muted font-weight-bold">Don't have an account? <a href="{{ route('signup') }}" class="text-primary ml-2">Register Now</a></p>
        </div>
    </form>
</div>
<!-- End Signin Form -->

    </div>
</div>

@endsection
