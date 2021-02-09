@extends('layouts.base')

@section('content')

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-success fixed-top">
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
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">Contact
                            Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('doctors.index') ? 'active' : '' }}"
                            href="{{ route('doctors.index') }}">Doctors</a>
                    </li>

                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-md-0">

                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('requests.index') }}">Requests</a></li>
                            <li><a class="dropdown-item" role="button" href="#" data-bs-toggle="modal"
                                    data-bs-target="#logout-modal">Logout</a></li>
                        </ul>
                    </li>
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
    @yield('main')
</div>
<x-modals.logout />
@endsection