@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="container mt-5">
                <h1>User Dashboard</h1>
                <p>Welcome to your dashboard, {{ auth()->user()->name }}!</p>
            </div>    
            <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <!-- Temporary Logout Button -->
                    <div class="mt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
