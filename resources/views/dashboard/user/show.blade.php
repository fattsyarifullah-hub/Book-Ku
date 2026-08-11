@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Users Detail')

@section('content')
<p>{{$user->name}}</p>
<h3>{{$user->email}}</h3>
<h6>{{$user->address}}</h6>

@endsection