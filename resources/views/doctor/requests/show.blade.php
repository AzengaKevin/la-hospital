@extends('layouts.app')

@section('title', 'Single Request')

@section('main')

<div class="container m-nav p-3">
    <h1 class="h4 text-muted fw-bold">{{ $request->user->name }} Request</h1>

    <div>{{ $request->description }}</div>

    <div class="mt-4">
        <h6 class="fw-bold">Action Center</h6>

        <div class="d-flex ">
            <a href="" class="btn btn-primary">Respond</a>

            <form class="ms-3" action="{{ route('doctor.requests.destroy', $request) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>

@endsection