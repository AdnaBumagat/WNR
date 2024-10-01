@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>{{ $chapter->title }}</h1>
    <p>{!! nl2br(e($chapter->content)) !!}</p> <!-- Display the content with line breaks preserved -->

    <a href="{{ route('books.show', $chapter->book->id) }}" class="btn btn-secondary mt-4">Back to Book</a>
</div>
@endsection
