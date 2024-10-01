@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <h1>Welcome to the Admin Dashboard</h1>
    <p>This page is only accessible by admin users.</p>
</div>

                    <!-- Temporary Logout Button -->
                    <div class="mt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
@endsection
