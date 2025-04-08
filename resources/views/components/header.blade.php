<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.svg') }}" alt="Mi Imagen">
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
                    <a class="nav-link {{ request()->is('cards*') ? 'active' : 'underline' }}"
                        href="{{ route('sets') }}">
                        {{ __('Cards') }}
                    </a>
                </li>
                @auth
                    <li>
                        <span class="authenticated-link"><a
                                class="nav-link {{ request()->is('your-decks') ? 'active' : 'underline' }}"
                                href="{{ route('your-decks') }}">
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
                    <x-deck-create-modal />
                    <li class="nav-item">
                        <a href="{{ route('decks') }}" class="nav-link underline">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('logout') ? 'active' : 'underline' }}"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                    {{-- <li class="nav-item dropdown">
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
                </li> --}}
                @endguest
            </ul>
        </div>
    </div>
</nav>
