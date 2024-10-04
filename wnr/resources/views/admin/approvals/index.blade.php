@extends('layouts.admin')

@section('title', 'Pending Book Approvals')

@section('content')
<div class="container mt-5">
    <h1>Pending Book Approvals</h1>

    @if($books->isEmpty())
        <p>No books are awaiting approval.</p>
    @else
        <ul class="list-group">
            @foreach($books as $book)
                <li class="list-group-item">
                    <h5>{{ $book->title }}</h5>
                    <p>{{ $book->description }}</p>
                    <a href="{{ route('admin.approvals.showBook', $book->id) }}" class="btn btn-primary">View Book</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

