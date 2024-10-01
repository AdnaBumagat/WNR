@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Edit Chapter: {{ $chapter->title }}</h1>

    <form action="{{ route('chapters.update', $chapter->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="title" class="form-label">Chapter Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $chapter->title }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Chapter Content</label>
            <textarea class="form-control" id="content" name="content" rows="10" required>{{ $chapter->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Chapter</button>
    </form>
</div>
@endsection
