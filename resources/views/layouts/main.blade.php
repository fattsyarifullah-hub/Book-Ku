<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                <a href="#" class="nav-link">
                    Catalog
                </a>
                <a href="#" class="nav-link">
                    Orders
                </a>
                <a href="#" class="cart-link">
                    <i class="bi bi-bag"></i>
                </a>
                <a href="{{ route('customer.edit') }}" class="profile">
                    <span class="notification">A</span>
                    <span class="profile-name">
                            nigga
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
