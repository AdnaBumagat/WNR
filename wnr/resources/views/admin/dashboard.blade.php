@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Welcome to the Admin Dashboard</h1>

    <div class="row mt-4">
        <!-- Admin Count Card -->
        <div class="col-md-4 mb-3">
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
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">
                        <strong>{{ $regularUserCount }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- Approved Books Count Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Approved Books</h5>
                    <p class="card-text">
                        <strong>{{ $approvedBookCount }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- Featured Books Count Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Featured Books</h5>
                    <p class="card-text">
                        <strong>{{ $featuredBookCount }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- Approval Requests Count Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Approval Requests</h5>
                    <p class="card-text">
                        <strong>{{ $approvalRequestCount }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
