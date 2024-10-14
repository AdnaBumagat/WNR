@extends('layouts.admin')

@section('title', 'Book Approval')

@section('content')
<div class="container mt-5">
    <h1>{{ $book->title }}</h1>

    <!-- Display the book image or a placeholder -->
    @if($book->image)
        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="book-cover-image mb-3">
    @else
        <img src="https://via.placeholder.com/250x300?text={{ urlencode($book->title) }}" alt="No Image Available" class="book-cover-image mb-3">
    @endif

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
                    <h5>{{ $chapter->title }}</h5>
                    <p>{{ Str::limit($chapter->content, 100) }}</p>
                    <!-- Link to view full chapter content -->
                    <a href="{{ route('admin.approvals.showChapter', $chapter->id) }}" class="btn btn-primary btn-sm">Read Full Chapter</a>
                </li>
            @endforeach
        </ul>
         <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $chapters->links('pagination::bootstrap-5') }} <!-- Use Bootstrap 5 pagination styling -->
    </div>
    @endif

    <form action="{{ route('admin.approveBook', $book->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-success">Approve Book</button>
    </form>

    <form action="{{ route('admin.rejectBook', $book->id) }}" method="POST" class="d-inline mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Reject Book</button>
    </form>
</div>

<style>
    .book-cover-image {
        width: 250px;
        height: 300px;
        object-fit: cover; /* Ensures the image covers the area without distortion */
    }
</style>
@endsection
