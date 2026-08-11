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

    @foreach ($alluser as $user)
    <a href="{{ route('dashboard.user.show', $user->id) }}">
        <h1>{{$user->name}}</h1>
        <h3>{{$user->email}}</h3>
        <p>{{$user->phone_number}}</p>
        <p>{{$user->address}}</p>
    </a>
    <form action="{{ route('dashboard.user.updateRole', $user->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <select name="role" id="" onchange="this.form.submit()">
            <option value="admin" {{ strtolower($user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="customer" {{ strtolower($user->role) === 'customer' ? 'selected' : '' }}>Customer</option>
        </select>
    </form>
    @endforeach
</body>

</html>
