@extends('layouts.app')

@section('title', 'Wattpad Clone - Home')

@section('content')
<div class="container mt-5">
    <div class="jumbotron text-center">
        <h1>Welcome to Wattpad Clone</h1>
        <p>Discover and share amazing books</p>
    </div>

    <!-- Featured Books Carousel -->
    <h2>Featured Books</h2>
    <div id="featuredBooksCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($featuredBooks as $book)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $book->image) }}" class="d-block w-100" alt="{{ $book->title }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $book->title }}</h5>
                    <p>{{ Str::limit($book->description, 150) }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#featuredBooksCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#featuredBooksCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</div>
@endsection
