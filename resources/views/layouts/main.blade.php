<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BooKu')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">

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
                    <i class="bi bi-book"></i>
                </div>
                <span class="brand-name">
                    BooKu
                </span>
            </a>
            <nav class="user-nav">
                <a href="{{ route('catalog.index') }}" class="nav-link">
                    Catalog
                </a>
                <a href="#" class="nav-link">
                    Orders
                </a>
                <a href="#" class="cart-link">
                    <i class="bi bi-bag"></i>
                </a>
                @auth
                    <span class="notification">A</span>
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
                    <a href="{{ route('login') }}">Login DLu jink</a>
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
                            BookVault
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
                    © {{ date('Y') }} BookVault e-Commerce.
                    All rights reserved.
                </p>
            </div>

        </div>

    </footer>

</body>

</html>
