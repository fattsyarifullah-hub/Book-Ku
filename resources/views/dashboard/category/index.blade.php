@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Category Management')

@section('content')    
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

@endsection
