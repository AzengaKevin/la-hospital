@extends('layouts.app')

@section('title', 'Doctors')

@section('main')
<div class="container m-nav py-3">

    <h1 class="fw-bold h3">Doctors</h1>

    <div class="mt-3">
        @foreach ($doctors as $doctor)
        <div class="">
            <div>
                <h5>{{ $doctor->user->name }} <span class="text-muted ms-2">({{ $doctor->speciality }})</span></h5>
            </div>

            <div>
                <h6 class="fw-bold">Contacts</h6>
                <div class="row">
                    <div class="col-md-4">Phone</div>
                    <div class="col-md-8">{{ $doctor->user->phone }}</div>
                </div>
                @if (!is_null($doctor->contacts))
                @foreach ($doctor->contacts as $key => $value)
                <div class="row">
                    <div class="col-md-4">{{ $key }}</div>
                    <div class="col-md-8">{{ $value }}</div>
                </div>
                @endforeach
                @endif
            </div>

            <div class="py-3">
                <a href="{{ route('requests.create', ['doctor_id' => $doctor->id]) }}" class="btn btn-sm btn-primary">Page</a>
            </div>
        </div>
        <hr>
        @endforeach
    </div>

</div>
@endsection