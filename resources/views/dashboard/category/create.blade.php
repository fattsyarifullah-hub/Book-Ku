<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <name>Document</name>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.navigation')

    <form action="{{ route('dashboard.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="name">name</label>
            <input type="text" name="name" id="name" required>
        </div>

        <button type="submit">Create</button>
    </form>
</body>

</html>
