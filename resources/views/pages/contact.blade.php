@extends('layouts.app')

@section('title', 'Contact Us')

@section('main')
<div class="container m-nav">

    <h1 class="fw-bold h3 py-3">Contact Page</h1>

    <div>
        <x-feedback />
    </div>

    <div class="d-flex flex-column flex-lg-row">
        <!-- Embedded contact map -->
        <div>
            <iframe class="rounded shadow w-100"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2958.709737684041!2d34.78177205997248!3d-0.6919373586684242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182b3f6840164ff1%3A0x8040e0d2e546b570!2sKisii%20University%20Main%20Campus!5e0!3m2!1ssw!2ske!4v1612866973667!5m2!1ssw!2ske"
                width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
        </div>
        <!-- Contact Form -->
        <div class="flex-grow-1 ms-0 mt-4 mt-lg-0 ms-lg-5">
            <h3 class="fw-bold">Get In Touch With Us</h3>

            <form action="{{ route('contacts.store') }}" method="POST">
                @csrf
                <div class="form-group mt-3">
                    <input type="text" name="name" id="name" placeholder="Name..." class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group mt-3">
                    <input type="email" name="email" id="email" placeholder="Email Address..." class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group mt-3">
                    <input type="text" name="phone" id="phone" placeholder="Phone Number..." class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="form-group mt-3">
                    <input type="text" name="subject" id="subject" placeholder="Subject..." class="form-control" value="{{ old('subject') }}">
                </div>
                <div class="form-group mt-3">
                    <textarea name="message" class="form-control" id="message" cols="30" rows="3">{{ old('message') }}</textarea>
                </div>

                <div class="mt-5 clearfix">
                    <button class="btn btn-success float-end">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection