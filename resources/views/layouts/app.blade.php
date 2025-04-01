<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{!! asset('images/logo-sm.svg') !!}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/sass/header.scss', 'resources/sass/login-register.scss',
    'resources/js/app.js'])
</head>

<body style="background-color: #E0E0E0;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="Mi Imagen">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('home') ? 'active' : 'underline' }}"
                                href="{{ route('home') }}">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('decks') ? 'active' : 'underline' }}"
                                href="{{ route('decks') }}">
                                {{ __('Decks') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('cards') ? 'active' : 'underline' }}"
                                href="{{ route('cards') }}">
                                {{ __('Cards') }}
                            </a>
                        </li>
                        @auth
                        <li>
                            <span class="authenticated-link"><a
                                    class="nav-link {{ request()->is('cards') ? 'active' : 'underline' }}"
                                    href="{{ route('cards') }}">
                                    {{ __('Your decks') }}
                                </a></span>
                        </li>
                        @endauth
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active' : 'underline' }}"
                                href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('register') ? 'active' : 'underline' }}"
                                href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer style="background-color: #333333; color: white; width: 100%; padding: 20px; position: absolute; bottom: 0;">
        <div class="container">
            <div class="row" style="text-align: center;">
                <p>Magic: The Gathering and Wizards of the Coast are trademarks of Wizards of the Coast LLC. © 1993-2025
                    Wizards. All Rights Reserved </p>
                <p>deckforge is not related with Wizards of the Coast LLC. deckforge may use the intellectual property
                    of Wizards of the Coast LLC, as permitted under Wizards' Fan Site Policy</p>
                <p>All the data for cards information is provided by <a href="https://www.scryfall.com">Scryfall</a></p>
            </div>
            <div class="row">
                <div style="display: flex; flex-direction: row; gap: 20px; justify-content: center;">
                    <a href="https://www.github.com/victorgomezfernandez">
                        <i class="fa-brands fa-github" style="color: #d82596; font-size: 25px;"></i>
                    </a>
                    <a href="mailto:victorgoferjim@gmail.com">
                        <i class="fa-solid fa-envelope" style="color: #d82596; font-size: 25px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>