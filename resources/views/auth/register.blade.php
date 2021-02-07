@extends('layouts.base')

@push('styles')
<style>
    .form-signup {
        width: 100%;
        max-width: 600px;
        padding: 15px;
        margin: auto;
    }
</style>
@endpush

@section('content')

<div class="min-h-screen bg-light d-flex align-items-center">
    <form x-data="{ userType: null }" action="{{ route('register') }}" method="POST" class="form-signup text-center"
        novalidate>
        @csrf
        <div class="mb-3">
            <a href="{{ route('home') }}">
                <x-logo height="64" />
            </a>
            <div>
                <h1 class="h3 fw-normal">Please sign up</h1>
                <div>
                    <span class="fw-bold">or</span>
                    <a class="ms-1" href="{{ route('login') }}">Already Have An Account</a>
                </div>
                <x-feedback />
            </div>
        </div>


        <div class="text-start">
            <label class="fw-bold form-label" for="name">Name</label>
            <input type="text" id="name" name="user[name]" class="form-control @error('user.name') is-invalid @enderror"
                placeholder="Name" value="{{ old('user.name') }}" required autofocus>
            @error('user.name')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="row text-start mt-2">
            <div class="col-sm-6">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control @error('user.email') is-invalid @enderror" id="email"
                    name="user[email]" placeholder="Email Address..." value="{{ old('user.email') }}" required>
                @error('user.email')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-sm-6">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input type="text" class="form-control @error('user.phone') is-invalid @enderror" id="phone"
                    name="user[phone]" placeholder="Phone Number..." value="{{ old('user.phone') }}" required>
                @error('user.phone')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="text-start mt-2">
            <label class="form-label fw-bold" for="password">Password</label>
            <input type="password" id="password" name="user[password]"
                class="form-control @error('user.password') is-invalid @enderror" placeholder="Password" required>
            @error('user.password')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="row align-items-center text-start">
            <div class="col-md-4 mt-4">
                <select class="form-select @error('user.gender') is-invalid @enderror" id="country" name="user[gender]"
                    required>
                    <option value="">Select Gender...</option>
                    @foreach (\App\Models\User::genderOptions() as $item)
                    <option value="{{ $item }}" {{ old('gender') == $item ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 align-self-center mt-2 mt-md-4">
                <div class="form-check">
                    <input id="doctor" name="type" type="radio" x-on:click="userType = 'doctor'"
                        class="form-check-input @error('type') is-invalid @enderror"
                        {{ old('type') == 'doctor' ? 'selected' : '' }} value="doctor">
                    <label class="form-check-label" for="doctor">Doctor</label>
                </div>
            </div>
            <div class="col-md-4 align-self-center mt-2 mt-md-4">
                <div class="form-check">
                    <input id="patient" name="type" type="radio" x-on:click="userType = 'patient'"
                        class="form-check-input @error('type') is-invalid @enderror"
                        {{ old('type') == 'patient' ? 'selected' : '' }} value="patient">
                    <label class="form-check-label" for="patient">Patient</label>
                </div>
            </div>
        </div>

        <div x-show="userType == 'doctor'" class="mt-2 text-start">
            <label for="speciality" class="form-label fw-bold">Speciality</label>
            <select id="speciality" class="form-select @error('doctor.speciality') is-invalid @enderror"
                name="doctor[speciality]" x-bind:disabled="userType != 'doctor'">
                <option value="">Select Speciality...</option>
                @foreach (\App\Models\Doctor::specialityOptions() as $item)
                <option value="{{ $item }}" {{ old('doctor.speciality') == $item ? 'selected' : '' }}>{{ $item }}
                </option>
                @endforeach
            </select>
            @error('doctor.speciality')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div x-show="userType == 'patient'" class="text-start mt-2">
            <label class="fw-bold form-label" for="dob">Date Of Birth</label>
            <input type="date" id="dob" name="patient[dob]"
                class="form-control @error('patient.dob') is-invalid @enderror" x-bind:disabled="userType != 'patient'"
                placeholder="Date Of Birth" value="{{ old('patient.dob') }}">

            @error('patient.dob')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mt-3">
            <button class="w-100 btn btn-lg btn-primary">Sign in</button>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; All rights reserved 2021</p>
    </form>
</div>

@endsection