@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center text-light" style="background-color: #785c44;">Login</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <!-- Links Side by Side -->
                    <div class="mt-3 d-flex justify-content-between">
                        <div>
                            <a href="{{ route('register') }}">Create an account?</a>
                        </div>
                        <div>
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
