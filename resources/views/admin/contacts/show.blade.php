@extends('layouts.dashboard')

@section('main')

<h4 class="fw-bold">Contact Details</h4>

<div>
    <div class="row">
        <div class="col-md-4">Name</div>
        <div class="col-md-8 fw-bold">{{ $contact->name }}</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">Email</div>
        <div class="col-md-8 fw-bold">{{ $contact->email }}</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">Phone</div>
        <div class="col-md-8 fw-bold">{{ $contact->phone }}</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">Subject</div>
        <div class="col-md-8 fw-bold">{{ $contact->subject }}</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">Message</div>
        <div class="col-md-8 fw-bold">{{ $contact->message }}</div>
    </div>
    <hr>

    <div class="mt-2">
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>

@endsection