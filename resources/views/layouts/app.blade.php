<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Styles -->
    <style>
        /* Add custom styles for hover behavior */
        .dropdown:hover .dropdown-menu:not(.show) {
            display: block;
        }

        /* Custom dropdown styles */
        .dropdown-menu {
            padding: 0;
            border: none;
            border-radius: 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s ease;
            color: #444;
            /* Change color to light black */
        }

        .dropdown-menu a:hover {
            background-color: #f8f9fa;
        }

        .dropdown-menu a:last-child {
            border-bottom: none;
        }

        .dropdown-toggle {
            padding: 10px 20px;
            background-color: #f8f9fa;
            color: #000;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .dropdown-toggle:hover {
            background-color: #e9ecef;
        }

        .dropdown-menu-end {
            right: 0;
            left: auto;
        }

        /* Navbar custom styles */
        .navbar-custom {
            background: linear-gradient(to right, #007bff, #6f42c1);
            /* Gradient for navbar */
        }

        .navbar-custom .navbar-brand {
            color: white !important;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: white !important;
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            color: #f8f9fa !important;
        }

        /* Button Customization */
        .btn-custom {
            border-radius: 20px;
            padding: 8px 20px;
        }
    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-custom navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Self-Workplace Inspection Information System
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Dropdown for General Configuration -->
                            <div class="dropdown">
                                <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    General Configuration
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <a class="dropdown-item" href="{{ route('users.index') }}">User Management</a>
                                    <a class="dropdown-item" href="{{ route('roles.index') }}">Role Management</a>
                                    <a class="dropdown-item" href="{{ route('oprunits.index') }}">Operating Unit
                                        Management</a>
                                </div>
                            </div>

                            <!-- Dropdown for Inspection Configuration -->
                            <div class="dropdown">
                                <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Inspection Configuration
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <a class="dropdown-item" href="{{ route('inspections.index') }}">Inspection Checklist
                                        Item</a>
                                    <a class="dropdown-item" href="{{ route('groupings.index') }}">Group Configuration</a>
                                    <a class="dropdown-item" href="{{ route('zones.index') }}">Zone Configuration</a>
                                </div>
                            </div>

                            <!-- Dropdown for Inspection -->
                            <div class="dropdown">
                                <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton3"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Inspection
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                    <a class="dropdown-item" href="{{ route('plannings.index') }}">Generate checklist</a>
                                </div>
                            </div>

                            <!-- User Profile Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton4"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton4">
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Add Bootstrap and jQuery JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>