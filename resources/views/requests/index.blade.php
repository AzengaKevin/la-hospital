@extends('layouts.app')

@section('title', 'Your Requests')

@section('main')
<div class="container m-nav py-3">

    <h1 class="fw-bold h4 text-muted">Your Requests</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Doctor</th>
                <th>Speciality</th>
                <th>Read</th>
                <th>Responses</th>
                <th>Request Date</th>
                <th>Action</th>
            </thead>

            <tbody>
                @if ($requests->count())
                @foreach ($requests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $request->doctor->user->name }}</td>
                    <td>{{ $request->doctor->speciality }}</td>
                    <td>{{ $request->read ? 'Read' : 'Not Read' }}</td>
                    <td>{{ $request->response()->count() }}</td>
                    <td>{{ $request->created_at->format('d/m/Y') }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('requests.edit', $request) }}" class="btn btn-sm btn-secondary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('requests.show', $request) }}" class="btn btn-sm btn-primary ms-2">
                            <i class="fa fa-eye"></i>
                        </a>
                        <form action="{{ route('requests.destroy', $request) }}" method="POST" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="py-3 text-center" colspan="7"><span>No Requests Made Yet !, <a
                                href="{{ route('requests.create') }}">Create One
                                Now</a></span></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>


</div>
@endsection