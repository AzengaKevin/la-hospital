@extends('layouts.base')

@push('styles')
<style>
    #sidebar {
        width: 20%;
    }

    .min-h-75{
        min-height: 75px;
    }

</style>
@endpush

@section('content')
<div class="d-flex min-h-screen">
    <x-sidebar />
    <main id="main" class="flex-grow-1">
        <header class="bg-light">
            <div class="d-flex justify-content-between min-h-75 align-items-center px-3 h-100">
                <div>
                    <button><i class="fa fa-bars"></i></button>
                </div>
                <div class="flex-grow-1 d-flex">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('requests.index') }}">Your Requests</a></li>
                                @can('act-as-a-doctor')
                                <li><a class="dropdown-item" href="{{ route('doctor.requests.index') }}">Patients
                                        Requests</a></li>
                                @endcan
                                <li><a class="dropdown-item" role="button" href="#" data-bs-toggle="modal"
                                        data-bs-target="#logout-modal">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="p-3">
            @yield('main')
        </div>
    </main>
</div>
@endsection