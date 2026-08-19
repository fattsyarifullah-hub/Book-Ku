<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BooKu')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    <header class="user-header">
        <div class="header-container">
            <a href="{{ url('/') }}" class="brand">
                <div class="brand-icon">
                    <img src="{{ asset('img/logo/logo.png') }}" alt="logo">
                </div>
                <span class="brand-name">
                    BooKu
                </span>
            </a>
            <nav class="user-nav">
                <a href="{{ route('main.index') }}" class="nav-link">
                    Home
                </a>
                <a href="{{ route('catalog.index') }}" class="nav-link">
                    Catalog
                </a>
                <a href="{{ route('customer.history') }}" class="nav-link">
                    Orders
                </a>
                <a href="{{ route('cart.index') }}" class="cart-link">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M223.5-103.5Q200-127 200-160t23.5-56.5Q247-240 280-240t56.5 23.5Q360-193 360-160t-23.5 56.5Q313-80 280-80t-56.5-23.5Zm400 0Q600-127 600-160t23.5-56.5Q647-240 680-240t56.5 23.5Q760-193 760-160t-23.5 56.5Q713-80 680-80t-56.5-23.5ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>
                </a>
                @auth
                    <span class="notification">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    <span class="profile-name">
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('customer.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </span>
                @endauth
                @guest
                    <a href="{{ route('login') }}">Login</a>
                @endguest
                <button class="mobile-menu">
                    <i class="bi bi-list"></i>
                </button>
            </nav>
        </div>
    </header>
    <main class="user-main">
        @yield('content')
    </main>
    <footer class="user-footer">
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">
                            <i class="bi bi-book"></i>
                        </div>
                        <span class="footer-logo-name">
                            BooKu
                        </span>
                    </div>
                    <p class="footer-description">
                        Your personal literary sanctuary.
                        Curating the finest works of fiction,
                        biography, technology, and philosophy.
                        Bound to inspire your mind.
                    </p>
                </div>
                <div class="footer-column">
                    <h3>Shop</h3>
                    <ul>
                        <li>
                            <a href="#">Browse All</a>
                        </li>
                        <li>
                            <a href="#">Bestsellers</a>
                        </li>
                        <li>
                            <a href="#">New Releases</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Our Company</h3>
                    <ul>
                        <li>
                            <a href="#">Our Story</a>
                        </li>
                        <li>
                            <a href="#">Careers</a>
                        </li>
                        <li>
                            <a href="#">Press Room</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Support</h3>
                    <ul>
                        <li>
                            <a href="#">Help Center</a>
                        </li>
                        <li>
                            <a href="#">Shipping Info</a>
                        </li>
                        <li>
                            <a href="#">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="copyright">
                    © {{ date('Y') }} BooKu e-Commerce.
                    All rights reserved.
                </p>
            </div>

        </div>

    </footer>

</body>

</html>
