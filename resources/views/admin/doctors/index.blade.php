@extends('layouts.dashboard')

@section('main')
<h4>Doctors</h4>
<div class="table-responsive mt-3">
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Speciality</th>
            <th>Verified</th>
            <th>Registered When</th>
            <th></th>
        </thead>

        <tbody>
            @if ($doctors->count())
            @foreach ($doctors as $doctor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $doctor->user->name }}</td>
                <td>{{ $doctor->user->email }}</td>
                <td>{{ $doctor->user->phone }}</td>
                <td>{{ $doctor->speciality }}</td>
                <td>{{ $doctor->verified ? 'Verified' : 'Not Verified' }}</td>
                <td>{{ $doctor->created_at->format('m/d/Y') }}</td>
                <td>
                    <form class="ms-2" action="{{ route('admin.doctors.update', $doctor) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-primary">
                            Verify
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td class="py-2" colspan="8">No Doctors Registered Yet</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection