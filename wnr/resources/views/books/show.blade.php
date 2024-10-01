@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>{{ $book->title }}</h1>
    <p>{{ $book->description }}</p>
    <p><strong>Genre:</strong> {{ $book->genre }}</p>
    <p><strong>Author:</strong> {{ $book->user->name }}</p>

    <h2>Chapters</h2>

    @if($book->chapters->isEmpty())
        <p>No chapters added yet.</p>
    @else
        <ul class="list-group">
            @foreach($book->chapters as $chapter)
                <li class="list-group-item">
                    <h5>
                        <a href="{{ route('chapters.show', $chapter->id) }}">{{ $chapter->title }}</a> <!-- Make the title clickable -->
                    </h5>
                    <!-- Edit and Delete Buttons for each chapter -->
                    <a href="{{ route('chapters.edit', $chapter->id) }}" class="btn btn-warning btn-sm mt-2">Edit</a>

                    <form action="{{ route('chapters.destroy', $chapter->id) }}" method="POST" class="d-inline mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('chapters.create', $book->id) }}" class="btn btn-warning mt-4">Add Chapter</a>

    <!-- Buttons for editing and deleting the book -->
    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning mt-4">Edit Book</a>

    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Book</button>
    </form>
</div>
@endsection
