<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Buku</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @include('layouts.navigation')
    
    <div>
        <a href="{{ route('dashboard.book.create') }}">Create new Book</a>
        <p>index book</p>
    
        @foreach ($allbook as $item)
            <h1>{{ $item->title }}</h1>
            <p>{{ $item->description }}</p>
            <img src="{{ asset('storage/imagebook/' . $item->image) }}" alt="">
            <a href="{{ route('dashboard.book.show', $item->id) }}">Detail</a>
            <a href="{{ route('dashboard.book.edit', $item->id) }}">Edit</a>
            <form action="{{ route('dashboard.book.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"> Delete</button>
            </form>
        @endforeach
    </div>
</body>

</html>

