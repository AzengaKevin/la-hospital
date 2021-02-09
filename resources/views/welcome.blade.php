@extends('layouts.app')

@section('main')
<div id="homepage-carousel-ctrls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 object-fit" src="{{ asset('/img/lab.jpg') }}" height="663" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 object-fit" src="{{ asset('/img/aparatus.jpg') }}" height="663" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 object-fit" src="{{ asset('/img/balance-diet.jpg') }}" height="663" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#homepage-carousel-ctrls" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#homepage-carousel-ctrls" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>
@endsection