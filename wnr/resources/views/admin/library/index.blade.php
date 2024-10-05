@extends('layouts.admin')

@section('title', 'Approved Books')

@section('content')
<div class="container mt-5">
    <h1>Approved Books</h1>

    @if($books->isEmpty())
        <p>No books have been approved yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->user->name }}</td>
                        <td>{{ $book->genre }}</td>
                        <td>
                            <!-- Display if the book is featured or not -->
                            @if($book->is_featured)
                                <span class="badge bg-success">Featured</span>
                            @else
                                <span class="badge bg-secondary">Not Featured</span>
                            @endif
                        </td>
                        <td>
                            <!-- Button to toggle the featured status -->
                            <form action="{{ route('admin.library.toggleFeatured', $book->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary">
                                    {{ $book->is_featured ? 'Unfeature' : 'Feature' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
