<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-layout">
        <!-- ini buat sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon">
                    📖
                </div>
                <span class="logo-text">
                    BooKu
                </span>
            </div>

            
            <!-- baut navigasi -->
            <nav class="sidebar-nav">

                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="nav-text">
                        Dashboard
                    </span>
                </a>
                
                <a href="{{ route('dashboard.book.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.book.index') ? 'active' : '' }}">
                    <span class="nav-text">
                        Book
                    </span>
                </a>

                <a href="{{ route('dashboard.category.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.category.index') ? 'active' : '' }}">
                    <span class="nav-text">
                        Category
                    </span>
                </a>

                <a href="{{ route('dashboard.user.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.user.index') ? 'active' : '' }}">
                    <span class="nav-text">
                        Users
                    </span>
                </a>

                <a href="{{ route('dashboard.order.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.order.index') ? 'active' : '' }}">
                    <span class="nav-text">
                        Orders
                    </span>
                </a>

            </nav>

            <!-- propil admin -->
            <a href="{{ route('profile.edit') }}" class="sidebar-profile">
                <div class="profile-wrapper">
                    A
                </div>
                <div class="profile-info">
                    <div class="profile-name">
                        sementara ini dlu
                    </div>
                    <div class="profile-role">
                        mimin
                    </div>
                </div>
            </a>
        </aside>

        <!-- konten utama -->
        <main class="main-content">
            <!-- topbar -->
            <header class="topbar">
                <h1 class="page-title">
                    @yield('page-title', 'Dashboard')
                </h1>

                <button class="notification">
                    🔔
                </button>
            </header>

            <!-- konten -->
            @yield('content')
        </main>

    </div>
</body>
</html>