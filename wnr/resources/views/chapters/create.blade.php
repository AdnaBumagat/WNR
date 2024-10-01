@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Add a Chapter to "{{ $book->title }}"</h1>

    <form action="{{ route('chapters.store', $book->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Chapter Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Chapter Content</label>
            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Chapter</button>
    </form>
</div>
@endsection
