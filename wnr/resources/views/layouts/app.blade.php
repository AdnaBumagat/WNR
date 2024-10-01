<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #785c44;">
        <div class="container">
            <a class="navbar-brand text-light" href="#">WNR</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Stories</a></li>
                </ul>

                <!-- Right side of the navbar -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <!-- If the user is not logged in -->
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('login') }}">Login</a></li>
                    @else
                        <!-- If the user is logged in -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }} <!-- Display the user's name -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="text-center p-3" style="background-color: #f8f9fa;">
            <p class="mb-0">©2024WNR. All rights reserved.</p>
            <!-- <a class="text-dark" href="#">Privacy Policy</a> |
            <a class="text-dark" href="#">Terms of Service</a> -->
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
