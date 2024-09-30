@extends('layouts.app')

@section('title', 'Books')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($books as $book)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ Str::limit($book->body, 100) }}</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
