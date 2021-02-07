@extends('layouts.base')

@section('content')

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
                <span>
                    <x-logo height="48" width="48" /></span>
                <span class="d-none d-md-block">{{ config('app.name') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="#">Contact
                            US</a>
                    </li>
                    
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    @if (Route::has('login'))
                    @auth
                    <a class="btn btn-primary mb-2 mb-md-0" href="{{ route('home') }}">Dashboard</a>
                    <form class="ms-0 ms-md-3" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-danger">Logout</button>
                    </form>
                    @else

                    <a href="{{ route('login') }}" class="btn btn-info mb-2 mb-md-0">Login</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-secondary mb-2 mb-md-0 ms-0 ms-md-2">Register</a>
                    @endif
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
<div>
    @yield('content')
</div>
@endsection