<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            <img src="{{ asset('images/logo.svg') }}" alt="deckfoundry">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('home') ? 'active' : 'underline' }}" href="{{ route('home') }}">
                        {{ __('header.home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('decks*') ? 'active' : 'underline' }}"
                        href="{{ route('decks') }}">
                        {{ __('header.decks') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cards*') ? 'active' : 'underline' }}"
                        href="{{ route('sets') }}">
                        {{ __('header.cards') }}
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('your-decks*') ? 'active' : 'underline' }}"
                            href="{{ route('your-decks') }}">
                            {{ __('header.your_decks') }}
                        </a>
                    </li>
                @endauth
            </ul>


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav login-links">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active' : 'underline' }}"
                                href="{{ route('login') }}">
                                {{ __('header.login') }}
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('register') ? 'active' : 'underline' }}"
                                href="{{ route('register') }}">
                                {{ __('header.register') }}
                            </a>
                        </li>
                    @endif
                @else
                    <div class="deck-create-normal">

                        <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#createDeckModal">
                            <img class="add-deck-img" src="{{ asset('images/add.svg') }}" alt="add deck">
                        </button>
                    </div>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="user-dropdown-text">{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="userDropdown">
                                @if (!auth()->user()->subscribed('prod_SE108n2SgYwi6u'))
                                    <li><a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); window.location.href = '/pricing'">{{ __('header.premium') }}</a>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); window.location.href = '/success'">{{ __('header.check_sub') }}</a>
                                    </li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('header.logout') }}
                                    </a>
                                </li>
                            </ul>

                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@if (auth()->check())
    @if (auth()->check() && (auth()->user()->subscribed('prod_SE108n2SgYwi6u') || auth()->user()->decks()->count() < 12))
        <x-deck-create-modal />
    @else
        <x-deck-limit-modal />
    @endif
@else
@endif
