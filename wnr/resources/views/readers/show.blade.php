@extends('layouts.app')

@section('title', 'Reader Details')

@section('content')
<div class="container mt-5">
    <h1>{{ $book->title }}</h1>
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
@endsection
