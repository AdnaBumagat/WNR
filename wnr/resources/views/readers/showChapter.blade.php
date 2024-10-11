@extends('layouts.app')

@section('title', 'Chapter Content')

@section('content')
<div class="container mt-5">
    <h1>{{ $chapter->title }}</h1>
    <p>{!! nl2br(e($chapter->content)) !!}</p> <!-- Display content with line breaks -->

    <a href="{{ route('readers.show', $book->id) }}" class="btn btn-secondary mt-4">Back to Reader</a>
</div>
@endsection
