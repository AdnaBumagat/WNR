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

    <!-- Carousel for Featured Readers -->
    @if ($featuredBooks->isNotEmpty())
        <div id="bookCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($featuredBooks->chunk(4) as $index => $chunk)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row text-center">
                            @foreach ($chunk as $book)
                                <div class="col-3">
                                    <a href="{{ route('readers.show', $book->id) }}"> <!-- Use reader route -->
                                        <div class="card">
                                            <!-- Display the actual image or fallback to placeholder -->
                                            <img src="{{ $book->image ? asset('storage/' . $book->image) : 'https://via.placeholder.com/250x300?text=' . urlencode($book->title) }}" class="card-img-top card-image" alt="{{ $book->title }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $book->title }}</h5>
                                                <p class="card-text">{{ $book->user->name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
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
    @else
        <p class="text-center">No featured Books available at the moment.</p>
    @endif

    <!-- Approved Books Title -->
    <h2 class="text-center mt-5 mb-4">Approved Books</h2>

    <!-- Approved Books List -->
    @if ($approvedBooks->isNotEmpty())
        <div class="row">
            @foreach ($approvedBooks as $book)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('readers.show', $book->id) }}"> <!-- Use reader route -->
                        <div class="card">
                            <!-- Display the actual image or fallback to placeholder -->
                            <img src="{{ $book->image ? asset('storage/' . $book->image) : 'https://via.placeholder.com/250x300?text=' . urlencode($book->title) }}" class="card-img-top card-image" alt="{{ $book->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">{{ $book->user->name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $approvedBooks->links() }}
        </div>
    @else
        <p class="text-center">No approved books available at the moment.</p>
    @endif
</div>

<style>
    .carousel-inner {
        padding: 20px 0; /* Add padding for carousel items */
    }

    .card {
        margin: 0 auto; /* Center the cards */
    }

    /* Ensure consistent image size */
    .card-image {
        width: 100%;         /* Full width inside the card */
        height: 300px;       /* Fixed height for all images */
        object-fit: cover;   /* Ensures the image covers the area without distortion */
    }

    .card-title {
        font-size: 1.1rem;   /* Adjust title size */
    }

    .card-text {
        font-size: 0.9rem;   /* Adjust author size */
        color: #666;         /* Adjust author color */
    }
</style>
@endsection
