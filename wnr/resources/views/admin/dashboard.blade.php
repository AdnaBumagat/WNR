@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <h1>Welcome to the Admin Dashboard</h1>

    <div class="row ml-auto mt-4">
        <!-- User Count Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">
                        <strong>{{ $userCount }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
