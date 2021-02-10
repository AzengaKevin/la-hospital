@extends('layouts.app')

@section('title', 'Your Requests')

@section('main')
<div class="container m-nav py-3">

    <h1 class="fw-bold h4 text-muted">Your Requests</h1>

    <div class="table-responsive">
        <table class="table text-center">
            <thead>
                <th>ID</th>
                <th>Patient</th>
                <th>Phone Number</th>
                <th>Age</th>
                <th>Request Date</th>
                <th>Action</th>
            </thead>

            <tbody>
                @if ($requests->count())
                @foreach ($requests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->user->phone }}</td>
                    <td>{{ $request->user->authenticable->dob }}</td>
                    <td>{{ $request->created_at->format('d/m/Y') }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="" class="btn btn-sm btn-secondary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('doctor.requests.show', $request) }}" class="btn btn-sm btn-primary ms-2">
                            <i class="fa fa-eye"></i>
                        </a>
                        <form action="" class="ms-2">
                            <button class="btn btn-sm btn-danger">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="py-2">
                    <td colspan="6">
                        <span>No Requests Made Yet !</span>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>


</div>
@endsection