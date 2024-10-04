@extends('layouts.admin')

@section('title', 'Book Approval')

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
                    <h5>{{ $chapter->title }}</h5>
                    <p>{{ Str::limit($chapter->content, 100) }}</p>
                    <!-- Link to view full chapter content -->
                    <a href="{{ route('admin.approvals.showChapter', $chapter->id) }}" class="btn btn-primary btn-sm">Read Full Chapter</a>
                </li>
            @endforeach
        </ul>
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
@endsection
