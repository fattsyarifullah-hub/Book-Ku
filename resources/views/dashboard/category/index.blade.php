@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Category Management')

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

    
    <a href="{{ route('dashboard.category.create') }}">Create new Category</a>
    @foreach ($allcategory as $c)
        <h1>{{ $c->name }}</h1>
        <a href="{{ route('dashboard.category.show', $c->id) }}">Detail</a>
        <a href="{{ route('dashboard.category.edit', $c->id) }}">Edit</a>
        <form action="{{ route('dashboard.category.destroy', $c->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        <p>{{$c->books_count}} @if ($c->books_count > 1)
            <small>Books</small>
        @else
            <small>Book</small>
        @endif</p>
    @endforeach
</body>
@section('content')
    <h1>hi</h1>

@endsection
