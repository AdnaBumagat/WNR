@extends('layouts.admin')

@section('title', 'Pending Book Approvals')

@section('content')
<div class="container mt-5">
    <h1>Pending Book Approvals</h1>

    @if($books->isEmpty())
        <p>No books are awaiting approval.</p>
    @else
        <ul class="list-group">
            @foreach($books as $book)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Display the book image or a placeholder -->
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="book-cover-image mb-3">
                            @else
                                <img src="https://via.placeholder.com/250x300?text={{ urlencode($book->title) }}" alt="No Image Available" class="book-cover-image mb-3">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h5>{{ $book->title }}</h5>
                            <p>{{ $book->description }}</p>
                            <a href="{{ route('admin.approvals.showBook', $book->id) }}" class="btn btn-primary">View Book</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $books->onEachSide(1)->links('pagination::bootstrap-5') }} <!-- Ensure it uses Bootstrap 5 styles -->
        </div>
    @endif
</div>

<style>
    .book-cover-image {
        width: 250px;
        height: 300px;
        object-fit: cover; /* Ensures the image covers the area without distortion */
    }
</style>
@endsection
