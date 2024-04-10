<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <title>{{ isset($title) ? $title : config('app.name', 'GJCLibrary') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/solid.min.css') }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
   </head>
<body>
    <div id="app">
<div id="main">
    <!-- navbar -->
    <nav class="navbar navbar-light bg-light mx-2" id="navbar">
       
        <div class="d-flex justify-content-between w-100">
            <div class="d-flex align-items-center">
                <button onclick="openNav()" class="openbtn openbtn-custom-style" id="menuButton">☰</button>
                <img src="{{ asset('images/gjc_logo.png') }}" alt="GJC Logo" class="logo-image mr-1" style="width: 34px;">
                <a class="navbar-brand" href="">GJC Library - Admin Panel</a>
            </div>
            <div class="text-center d-none d-md-block"> <!-- Added d-none d-md-block classes here -->
            <div class="input-group mt-2">
                <input type="text" class="form-control " placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button" id="button-addon2">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- User avatar -->
        <div class="d-flex align-items-center">
            <div class="profile-pic border border-secondary rounded">
                <button id="themeToggleBtn" class="btn" onclick="toggleTheme()"><i class="fas fa-moon"></i></button>
            </div>
            <div class="profile-pic  mx-2">
                <img src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="Profile Picture">
            </div>
            <div class="mr-2">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-2">Logout</button>
                </form>
            </div>
        </div>
        <div class="collapse sidebar-collapse" id="basic-navbar-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link text-dark" href="">">Signin</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="">">Register</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="">Team</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="">Home</a></li>
            </ul>
        </div>
    </nav>
    <!-- sidebar-->
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="">Books</a>
        <a href="">Categories</a>
        <a href="">About</a>
        <a href="">Team</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>

    <main class="py-4">
        @yield('content')
    </main>


    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    
</body>
</html>
