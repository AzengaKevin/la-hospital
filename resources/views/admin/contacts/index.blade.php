@extends('layouts.dashboard')

@section('main')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subject</th>
            <th></th>
        </thead>

        <tbody>
            @if ($contacts->count())
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->subject }}</td>
                <td>
                    <div class="d-flex">
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.contacts.show', $contact) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <form class="ms-2" action="{{ route('admin.contacts.destroy', $contact) }}" method="post">
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
            <tr colspan="6">

            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection