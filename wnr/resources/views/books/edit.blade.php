@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Edit Book</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $book->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" value="{{ $book->genre }}" required>
        </div>

        <!-- Image upload field -->
        <div class="mb-3">
            <label for="image" class="form-label">Book Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">

            <!-- Show current image if it exists -->
            @if($book->image)
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" style="width: 150px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
</div>
@endsection
