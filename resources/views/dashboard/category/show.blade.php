@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Category Detail')

@section('content')
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

@endsection