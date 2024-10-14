@extends('layouts.app')

@section('title', 'Reader Details')

@section('content')
<div class="container mt-5">
    <h1>{{ $book->title }}</h1>
    
    <!-- Display the book image -->
    @if($book->image)
        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="book-cover-image mb-3">
    @else
        <img src="https://via.placeholder.com/250x300?text={{ urlencode($book->title) }}" alt="No Image Available" class="book-cover-image mb-3">
    @endif

    <p>{{ $book->description }}</p>
    <p><strong>Author:</strong> {{ $book->user->name }}</p>
    <p><strong>Genre:</strong> {{ $book->genre }}</p>

    <h2>Chapters</h2>

    @if($book->chapters->isEmpty())
        <p>No chapters available.</p>
    @else
        <ul class="list-group">
            @foreach($book->chapters as $chapter)
                <li class="list-group-item">
                    <h5>
                        <a href="{{ route('readers.chapters.show', ['bookId' => $book->id, 'chapterId' => $chapter->id]) }}">
                            {{ $chapter->title }}
                        </a>
                    </h5>
                </li>
            @endforeach
        </ul>
    @endif
</div>

<style>
    .book-cover-image {
        width: 250px;
        height: 300px;
        object-fit: cover; /* Ensures the image covers the area without distortion */
    }
</style
@endsection
