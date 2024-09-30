@extends('layouts.app')

@section('title', 'WNR JOURNAL - Home')

@section('content')
<div class="container mt-5">
    <div class="jumbotron text-center">
        <h1>Welcome to WNR JOURNAL</h1>
        <p>Discover and share amazing books</p>
    </div>

    <!-- Featured Books Title -->
    <h2 class="text-center mt-5 mb-4">Featured Books</h2>

    <!-- Carousel -->
    <div id="bookCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row text-center">
                    @for ($i = 1; $i <= 4; $i++)
                    <div class="col-3">
                        <div class="card">
                            <img src="https://via.placeholder.com/250x300?text=Book+{{ $i }}" class="card-img-top" alt="Book {{ $i }}">
                            <div class="card-body">
                                <h5 class="card-title">Book Title {{ $i }}</h5>
                                <p class="card-text">Author {{ $i }}</p>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
            <div class="carousel-item">
                <div class="row text-center">
                    @for ($i = 5; $i <= 8; $i++)
                    <div class="col-3">
                        <div class="card">
                            <img src="https://via.placeholder.com/250x300?text=Book+{{ $i }}" class="card-img-top" alt="Book {{ $i }}">
                            <div class="card-body">
                                <h5 class="card-title">Book Title {{ $i }}</h5>
                                <p class="card-text">Author {{ $i }}</p>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- End of Carousel -->
</div>

<style>
    .carousel-inner {
        padding: 20px 0; /* Add padding for carousel items */
    }

    .card {
        margin: 0 auto; /* Center the cards */
    }

    .card-title {
        font-size: 1.1rem; /* Adjust title size */
    }

    .card-text {
        font-size: 0.9rem; /* Adjust author size */
        color: #666; /* Adjust author color */
    }
</style>
@endsection
