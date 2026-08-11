<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.navigation')
    @if ($category->books->isEmpty())
        <p>belum ada buku di kategori ini</p>
    @else
        <ul>
            @foreach ($category->books as $book)
                <li>
                    <p>{{ $book->title }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</body>

</html>
