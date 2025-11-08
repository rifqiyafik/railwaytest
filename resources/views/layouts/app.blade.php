<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('image/logoptpn4.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('image/logoptpn4.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{asset('build/assets/app-lhA9k1qk.css')}}">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    .containerr{
        margin-top: 200px
    }

    .atas{
        padding-top: 120px;
    }
    /* Mode gelap global */
    .dark-mode {
        background-color: #0f1914;
        color: #ffffff;
    }

    /* Navbar dark */
    .dark-mode .navbar {
        background-color: #0a120f !important;
        border-bottom: 1px solid #193529;
    }
    /* Saat dark mode aktif, ikon sun harus tetap terang */
    .dark-mode #darkIcon.bi-sun-fill {
        color: #ffd54f !important; /* kuning terang */
    }

    /* Ikon moon saat light mode */
    #darkIcon.bi-moon-stars {
        color: #0a120f; /* abu tenang */
    }

    .dark-mode .navbar .nav-link {
        color: #ffffff !important;
    }

    .dark-mode .navbar-brand img {
        filter: brightness(85%);
    }

    /* Dropdown */
    .dark-mode .dropdown-menu {
        background-color: #0f1914;
        border-color: #193529;
    }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand pt-2" href="{{ url('/') }}">
                    <img src="{{ asset('image/logo-ptpn4.jpg') }}" alt="Logo" height="60px"
                /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('penempatan.index')}}">{{ __('Penempatan') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('asal_sekolah.index')}}">{{ __('Asal Sekolah') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('siswa.index')}}">{{ __('Data Siswa') }}</a>
                            </li>
                        @endif
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="nav-item d-flex align-items-center ms-3">
                                <button id="darkModeToggle" class="btn ">
                                    <i id="darkIcon" class="bi"></i>
                                </button>
                            </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item d-flex align-items-center ms-3">
                                <button id="darkModeToggle" class="btn ">
                                    <i id="darkIcon" class="bi"></i>
                                </button>
                            </li>
                            @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="atas">
            @yield('content')
        </main>

        <script src="{{asset('build/assets/app-W7Y791fY.js')}}"></script>

    </div>

    <script src="{{asset('build/assets/app-W7Y791fY.js')}}"></script>

    <footer class="containerr bg-dark text-light text-center py-5">
        <div class="container pt-4">
            <p>&copy; {{ date('Y') }} PT Perkebunan Nusantara IV | Phoenix. All rights reserved.</p>
        </div>
    </footer>
</body>
<script>
    const btn = document.getElementById('darkModeToggle');
    const icon = document.getElementById('darkIcon');

    function applyMode() {
        const darkEnabled = localStorage.getItem('dark-mode') === 'enabled';

        if (darkEnabled) {
            document.body.classList.add('dark-mode');
            icon.className = "bi bi-sun-fill"; // ikon terang
        } else {
            document.body.classList.remove('dark-mode');
            icon.className = "bi bi-moon-stars-fill"; // ikon gelap
        }
    }

    applyMode();

    btn.addEventListener('click', () => {
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'disabled');
        } else {
            localStorage.setItem('dark-mode', 'enabled');
        }
        applyMode();
    });
</script>
</html>
