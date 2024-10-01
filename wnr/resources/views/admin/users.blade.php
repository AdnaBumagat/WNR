@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="container mt-5">
    <h1>Manage Users</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.users') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.updateRole', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <select name="role" class="form-select" onchange="this.form.submit()">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>

                    @if($user->role !== 'admin')
                    <form method="POST" action="{{ route('admin.users.block', $user->id) }}" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning btn-sm">Block</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $users->appends(request()->query())->links() }}
    </div>
</div>
@endsection
