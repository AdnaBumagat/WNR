@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-between align-items-center">
    <h1>My Library</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Create a Book</a>
</div>

@if($books->isEmpty())
        <p>You haven't created any books yet.</p>
    @else
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <!-- Adjust the image size with CSS -->
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top book-image" alt="{{ $book->title }}">
                        @else
                            <img src="https://via.placeholder.com/250x300?text=No+Image" class="card-img-top book-image" alt="No Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->description }}</p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View Book</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
