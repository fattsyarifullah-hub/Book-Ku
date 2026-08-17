@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Order Detail')

@section('content')
<p>{{$order->invoice_number}}</p>
<h3>{{$order->user->name}}</h3>
<h6>{{Number::currency($order->total_price, 'IDR', 'id', precision:0)}}</h6>

@endsection