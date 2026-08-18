<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BooKu')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav>
        <div class="title">
            <h1>Boo</h1>
            <span>Ku</span>
        </div>

        <div class="action">
            <a href="{{ url('/') }}">home</a>
            <a href="{{ route('catalog.index') }}">catalog</a>
            <a href="{{ route('cart.index') }}">cart</a>
            <a href="{{ route('customer.index') }}">profile</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>

</html>
