@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-between align-items-center">
    <h1>My Library</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Create a Book</a>
</div>

@if($books && $books->isNotEmpty()) <!-- Safely checking if $books is not null and not empty -->
    <div class="list-group mt-3">
        @foreach($books as $book)
            <a href="{{ route('books.show', $book->id) }}" class="list-group-item">
                <h5 class="mb-1">Title: {{ $book->title }}</h5>
                <p class="mb-1">Description: {{ $book->description }}</p>
                <small>Genre: {{ $book->genre }}</small>
            </a>
        @endforeach
    </div>
@else
    <p>You haven't created any books yet.</p>
@endif
@endsection
