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

                <a href="{{ route('dashboard.index') }}"
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
            <a href="{{ route('dashboard.profile.edit') }}" class="sidebar-profile">
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
            <header class="topbar" data-route="{{ request()->route() ? request()->route()->getName() : '' }}">
                <div class="topbar-left">
                    <h1 class="page-title">
                        @yield('page-title', 'Dashboard')
                    </h1>
                    <div class="bm-search-box">
                        <svg class="bm-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <input id="bm-search-input" type="text" class="bm-search-input" placeholder="Search...">
                    </div>
                </div>

                <div class="topbar-right">
                    @if(request()->routeIs('dashboard.book.*'))
                        <a id="bm-add-btn" href="{{ route('dashboard.book.create') }}" class="bm-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="16" height="16">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Add Book
                        </a>
                    @elseif(request()->routeIs('dashboard.category.*'))
                        <a id="bm-add-btn" href="{{ route('dashboard.category.create') }}" class="bm-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="16" height="16">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Add Category
                        </a>
                    @else
                        <a id="bm-add-btn" href="#" class="bm-btn-primary" style="display:none;">Add</a>
                    @endif

                    <button class="notification">
                        🔔
                    </button>
                </div>
            </header>

            <!-- konten -->
            @yield('content')
        </main>

    </div>
</body>
<script>
    (function () {
        const header = document.querySelector('.topbar');
        const route = header ? header.dataset.route || '' : '';
        const input = document.getElementById('bm-search-input');
        if (!input) return;

        input.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();

            if (route.startsWith('dashboard.book')) {
                document.querySelectorAll('#bm-books-table tbody tr[data-search]').forEach(function (row) {
                    row.style.display = q === '' || row.dataset.search.includes(q) ? '' : 'none';
                });
            } else if (route.startsWith('dashboard.category')) {
                document.querySelectorAll('.cm-card[data-search]').forEach(function (card) {
                    card.style.display = q === '' || card.dataset.search.includes(q) ? '' : 'none';
                });
            } else if (route.startsWith('dashboard.user')) {
                document.querySelectorAll('.bm-tr[data-search]').forEach(function (card) {
                    card.style.display = q === '' || card.dataset.search.includes(q) ? '' : 'none';
                });
            }
        });
    })();
</script>
</html>