@extends('layouts.main')

@section('content')
<h1>Buku Terlaris Bulan Ini</h1>

@foreach ($bestSeller as $item)
    
<div class="best-seller">
    <img src="{{ asset('storage/imagebook/' . $item->image) }}" alt="{{ $item->title }}">
    <h5>{{ $item->title }}</h5>
    <p>{{ $item->author}}</p>
    <p>{{ Number::currency($item->price, 'IDR', 'id', precision:0)}}</p>
    <small>Terjual {{$item->total_sold}} dalam {{$date}}</small>
</div>
@endforeach

@endsection