@extends('layouts.app')

@section('title', 'Create Request')

@section('main')
<div class="container m-nav py-3">

    <h1 class="fw-bold h3">Create Request</h1>

    <form action="{{ route('requests.store') }}" method="post">
        @csrf
        <div class="">
            <label class="form-label fw-bold" for="doctorId">Doctor</label>
            <select name="doctor_id" id="doctorId" class="form-select">
                <option selected disabled value="">Select Doctor...</option>
                @foreach ($doctors as $doctor)
                <option {{ ((old('doctor_id') ?? $doctorId) == $doctor->id) ? 'selected' : '' }} value="{{ $doctor->id }}">
                    {{ $doctor->user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-4">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" class="form-control"
                rows="5">{{ old('description') }}</textarea>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection