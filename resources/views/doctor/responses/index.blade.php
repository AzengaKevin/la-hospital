@extends('layouts.app')

@section('title', 'Your responses')

@section('main')
<div class="container m-nav py-3">

    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-center">
        <h1 class="fw-bold h4 text-muted">Request Responses</h1>

        <button type="button" data-bs-toggle="modal" data-bs-target="#create-reponse-modal"
            class="btn btn-primary">Create Response</button>
    </div>

    <div class="py-2">
        <x-feedback />
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Type</th>
                <th>Description</th>
                <th>Response Time</th>
                <th>Agree Upon</th>
                <th>Action</th>
            </thead>

            <tbody>
                @if ($request->response->count())
                @foreach ($request->response as $response)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $response->type }}</td>
                    <td>{{ $response->description }}</td>
                    <td>{{ $response->created_at->format('d/m/Y') }}</td>
                    <td>{{ $response->agreed ? 'Agreed' : 'Not Yet' }}</td>
                    <td class="">
                        <div class="d-inline-flex justify-content-center">
                            <a href="" class="btn btn-sm btn-secondary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('doctor.requests.responses.show', ['request' => $request , 'response' =>$response]) }}"
                                class="btn btn-sm btn-primary ms-2">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form
                                action="{{ route('doctor.requests.responses.destroy', ['request' => $request, 'response' => $response]) }}"
                                method="POST" class="ms-2">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="py-2">
                    <td colspan="6">
                        <span>No responses Made Yet !</span>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <x-modals.create-response :request="$request" />

</div>
@endsection