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
                    <li class="nav-item text-light"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item text-light"><a class="nav-link" href="#">Stories</a></li>
                    <li class="nav-item text-light"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
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
