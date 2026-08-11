@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Users Overview')

@section('content')
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

@endsection
