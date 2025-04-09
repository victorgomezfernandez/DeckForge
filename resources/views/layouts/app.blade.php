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
    'resources/sass/sets.scss', 'resources/sass/cards.scss', 'resources/js/app.js', 'resources/js/format-dropdown-choose.js', 
    'resources/js/create-deck-form-validation.js', 'resources/sass/decks.scss', 'resources/sass/deckdetails.scss', 
    'resources/js/live-card-search.js'])
</head>

<body style="background-color: #E0E0E0; min-height: 100vh; display: flex; flex-direction: column;">
    <div id="app" style="flex: 1;">
        <x-header />
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer style="background-color: #333333; color: white; width: 100%; padding: 20px; bottom: 0;">
        <div class="container">
            <div class="row" style="text-align: center;">
                <p>Magic: The Gathering and Wizards of the Coast are trademarks of Wizards of the Coast LLC. © 1993-2025
                    Wizards. All Rights Reserved </p>
                <p>deckforge is not related with Wizards of the Coast LLC. deckforge may use the intellectual property
                    of Wizards of the Coast LLC, as permitted under Wizards' Fan Site Policy</p>
                <p>All the data for cards information is provided by <a href="https://www.scryfall.com">Scryfall</a>
                </p>
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
    @stack('scripts')
</body>

</html>
