@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <h1>Welcome to the Admin Dashboard</h1>

    <div class="row mt-4">

        <!-- Admin Count Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Admins</h5>
                    <p class="card-text">
                        <strong>{{ $adminCount }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- Regular Users Count Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">
                        <strong>{{ $regularUserCount }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
