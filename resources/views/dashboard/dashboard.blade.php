@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<h2 class="font-semibold text-xl text-red-900 leading-tight">
    {{ __('Dashboard') }}
</h2>

<h3>Ringkasan ceunah</h3>

<div class="total-category">
    <p> {{ $categories }}</p>
</div>

<div class="total-user">
    @foreach ($user as $item)
        
    <p> {{ $item->name }}</p>
    @endforeach
</div>

<div class="order-latest">
    @foreach ($orderlast as $o)
        
    <p> {{ $o->invoice_number }}</p>
    <p>{{$o->total_price}}</p>
    @endforeach
</div>

<div class="book-total">
    <p> {{ $bookCount }}</p>
</div>
@endsection