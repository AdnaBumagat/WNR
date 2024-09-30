@extends('layouts.app')

@section('title', 'Add Chapter')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Chapter to {{ $book->title }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('chapters.store', $book->id) }}">
                        @csrf

                        <!-- Chapter Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Chapter Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <!-- Chapter Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Chapter Content</label>
                            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Chapter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
