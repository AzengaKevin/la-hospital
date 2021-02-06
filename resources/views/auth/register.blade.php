@extends('layouts.base')

@push('styles')
<style>
    .form-signup {
        width: 100%;
        max-width: 600px;
        padding: 15px;
        margin: auto;
    }
</style>
@endpush

@section('content')

<div class="min-h-screen bg-light d-flex align-items-center">
    <livewire:registration />
</div>

@endsection