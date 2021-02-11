@extends('layouts.app')

@section('title', 'Single Request')

@section('main')

<div class="container m-nav p-3">
    <h1 class="h4 text-muted fw-bold">Single Request</h1>

    <div class="mt-3">
        <ul class="nav nav-tabs">
            <li class="nav-item" role="presentation">
                <a href="#request" role="tab" data-bs-toggle="tab" class="nav-link active">Request Details</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#response" role="tab" data-bs-toggle="tab" class="nav-link">Response</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane p-3 active" role="tabpanel" id="request">

                <div>{{ $request->description }}</div>


                <div class="mt-4">
                    <h6 class="fw-bold">Action Center</h6>

                    <div class="d-flex">
                        <a href="{{ route('requests.edit', $request) }}" class="btn btn-primary">Edit</a>
                        <form class="ms-3" action="{{ route('requests.destroy', $request) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane p-3" role="tabpanel" id="response">

                @foreach ($request->response as $response)
                <div class="">
                    <h5 class="fw-bold">{{ $response->type }}</h5>

                    <p>{{ $response->description }}</p>

                    <div class="text-muted">
                        <div>
                            @if (!is_null($response->appointment))
                            @foreach ($response->appointment as $key => $value)
                            <div class="row">
                                <div class="col-md-4">{{ Str::title($key) }}</div>
                                <div class="col-md-8 fw-bold">{{ $value }}</div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div>
                            @if (!is_null($response->prescription))
                            @foreach ($response->prescription as $key => $value)
                            <div class="row">
                                <div class="col-md-4">{{ Str::title($key) }}</div>
                                <div class="col-md-8 fw-bold">{{ $value }}</div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection