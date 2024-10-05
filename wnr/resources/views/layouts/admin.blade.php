<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the sidebar */
        body {
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #785c44;
            min-height: 100vh;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: ;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        .logout-form {
            position: absolute;
            bottom: 20px;
            left: 15px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <h3 class="text-light">Admin Panel</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    Manage Users
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.library.index') }}" class="nav-link {{ request()->routeIs('admin.library.index') ? 'active' : '' }}">
                    Manage Books
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.approvals.index') }}" class="nav-link {{ request()->routeIs('admin.approvals.index') ? 'active' : '' }}">
                    Manage Approvals
                </a>
            </li>
        </ul>

        <!-- Logout Button -->
        <div class="logout-form">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">
                    {{ __('Logout') }}
                </button>
            </form>
        </div>
    </nav>
..
    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
