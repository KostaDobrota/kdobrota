<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <x-application-logo class="h-9" />
            <span class="ms-2 fw-bold text-success">Masline</span>
        </a>

        <!-- Hamburger -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Navigation Links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold text-success' : '' }}" href="{{ route('home') }}">
                        Почетна
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('catalog') ? 'active fw-bold text-success' : '' }}" href="{{ route('catalog') }}">
                        Производи
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active fw-bold text-success' : '' }}" href="{{ route('about') }}">
                        О нама
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active fw-bold text-success' : '' }}" href="{{ route('contact') }}">
                        Контакт
                    </a>
                </li>
            </ul>

            <!-- Right Side Navigation -->
            <ul class="navbar-nav align-items-center">
                <!-- Shopping Cart -->
                <li class="nav-item me-3">
                    <a href="{{ route('cart') }}" class="nav-link position-relative">
                        <i class="fas fa-shopping-cart fs-5"></i>
                        @php
                            $cartCount = session()->has('cart') ? count(session()->get('cart')) : 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                {{ $cartCount }}
                                <span class="visually-hidden">производа у корпи</span>
                            </span>
                        @endif
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.png') }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="rounded-circle me-2"
                                 width="32"
                                 height="32">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm" aria-labelledby="navbarDropdown">
                            @if(auth()->user()->hasRole('admin'))
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>
                                        Контролна табла
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-cog me-2"></i>Админ панел
                                    </a>
                                </li>
                            @elseif(auth()->user()->hasRole('editor'))
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('editor.index') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>
                                        Контролна табла
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('editor.index') }}">
                                        <i class="fas fa-edit me-2"></i>Уређивање
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('profile') }}">
                                    <i class="fas fa-user me-2"></i>
                                    Профил
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        Одјава
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-success me-2">Пријава</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-success">Регистрација</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
