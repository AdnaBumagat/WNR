@extends('layouts.admin')

@section('title', 'Approved Books')

@section('content')
<div class="container mt-5">
    <h1>Approved Books</h1>

    <!-- Export to CSV Button -->
    <a href="{{ route('admin.library.export-csv') }}" class="btn btn-success mb-4">Export to CSV</a>

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
                        <td>{{ $book->is_featured ? 'Yes' : 'No' }}</td>
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
