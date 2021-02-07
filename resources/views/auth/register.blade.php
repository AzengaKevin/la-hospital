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
    <form x-data="{ userType: null }" class="form-signup text-center" novalidate>

        <div class="mb-3">
            <a href="{{ route('home') }}">
                <x-logo height="64" />
            </a>
            <div>
                <h1 class="h3 fw-normal">Please sign up</h1>
                <div><span class="fw-bold">or</span> <a class="ms-1" href="{{ route('login') }}">Already Have An
                        Account</a>
                </div>
            </div>
        </div>


        <div class="text-start">
            <label class="fw-bold form-label" for="name">Name</label>
            <input type="text" id="name" class="form-control" placeholder="Name" required autofocus>
        </div>

        <div class="row text-start mt-2">
            <div class="col-sm-6">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email Address..." value="" required>
            </div>

            <div class="col-sm-6">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input type="text" class="form-control" id="phone" placeholder="Phone Number..." value="" required>
            </div>
        </div>

        <div class="text-start mt-2">
            <label class="form-label fw-bold" for="inputPassword">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        </div>

        <div class="row align-items-center text-start">
            <div class="col-md-4 mt-4">
                <select class="form-select" id="country" required>
                    <option value="">Select Gender...</option>
                    @foreach (\App\Models\User::genderOptions() as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 align-self-center mt-2 mt-md-4">
                <div class="form-check">
                    <input id="doctor" name="type" type="radio" x-on:click="userType = 'doctor'"
                        class="form-check-input" value="doctor">
                    <label class="form-check-label" for="doctor">Doctor</label>
                </div>
            </div>
            <div class="col-md-4 align-self-center mt-2 mt-md-4">
                <div class="form-check">
                    <input id="patient" name="type" type="radio"
                        x-on:click="userType = 'patient'" class="form-check-input"
                        value="patient">
                    <label class="form-check-label" for="patient">Patient</label>
                </div>
            </div>
        </div>

        <div x-show="userType == 'doctor'" class="mt-2 text-start">
            <label for="speciality" class="form-label fw-bold">Speciality</label>
            <select id="speciality" class="form-select" name="speciality" x-bind:disabled="userType != 'doctor'">
                <option value="">Select Speciality...</option>
                @foreach (\App\Models\Doctor::specialityOptions() as $item)
                <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <div x-show="userType == 'patient'" class="text-start mt-2">
            <label class="fw-bold form-label" for="dob">Date Of Birth</label>
            <input type="date" id="dob" name="dob" class="form-control" x-bind:disabled="userType != 'patient'"
                placeholder="Date Of Birth">
        </div>

        <div class="mt-3">
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; All rights reserved 2021</p>
    </form>
</div>

@endsection