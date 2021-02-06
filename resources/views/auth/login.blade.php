@extends('layouts.base')

@push('styles')
<style>
    .form-signup {
        width: 100%;
        max-width: 330px;
        padding: 1rem;
        margin: auto;
    }
</style>
@endpush

@section('content')

<div class="min-h-screen bg-light d-flex align-items-center">
    <form class="form-signup text-center">

        <div class="mb-3">
            <a href="{{ route('home') }}">
                <x-logo height="64" />
            </a>
            <div>
                <h1 class="h3 fw-normal">Please sign in</h1>
                <div><span class="fw-bold">or</span> <a class="ms-1" href="{{ route('register') }}">Sign up Here</a></div>
            </div>
        </div>

        <div>
            <label for="inputEmail" class="visually-hidden">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        </div>

        <div class="mt-2">
            <label for="inputPassword" class="visually-hidden">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        </div>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; All rights reserved 2021</p>
    </form>
</div>

@endsection