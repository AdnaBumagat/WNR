@extends('layouts.app')

@section('title', 'Manage Featured Books')

@section('content')
<div class="container mt-5">
    <h1>Manage Featured Books</h1>
    <div class="row">
        @foreach($books as $book)
        <div class="col-md-4 mb-3">
            <div class="card">
                @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top" alt="{{ $book->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                    <form method="POST" action="{{ route('books.toggleFeatured', $book->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $book->featured ? 'btn-danger' : 'btn-success' }}">
                            {{ $book->featured ? 'Remove from Featured' : 'Mark as Featured' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
