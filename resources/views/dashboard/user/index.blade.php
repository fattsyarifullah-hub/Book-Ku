@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Users Overview')

@section('content')
    @foreach ($alluser as $user)
        <h1>{{$user->name}}</h1>
        <h3>{{$user->email}}</h3>
    @endforeach

@endsection
