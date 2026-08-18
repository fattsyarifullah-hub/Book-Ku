<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
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
                <a href="{{ url('/') }}" class="nav-link">
                    Home
                </a>
                <a href="#" class="nav-link">
                    Catalog
                </a>
                <a href="#" class="nav-link">
                    Orders
                </a>
                <a href="#" class="cart-link">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M223.5-103.5Q200-127 200-160t23.5-56.5Q247-240 280-240t56.5 23.5Q360-193 360-160t-23.5 56.5Q313-80 280-80t-56.5-23.5Zm400 0Q600-127 600-160t23.5-56.5Q647-240 680-240t56.5 23.5Q760-193 760-160t-23.5 56.5Q713-80 680-80t-56.5-23.5ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>
                </a>
                <a href="{{ route('customer.edit') }}" class="profile">
                    <span class="notification">A</span>
                    <span class="profile-name">
                        {{ Auth::user()->name }}
                    </span>
                </a>
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
                <div class="social-links">
                    <a href="#">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="#">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>

        </div>

    </footer>

</body>
</html>