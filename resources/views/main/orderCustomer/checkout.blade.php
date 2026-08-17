@extends('layouts.main')

@section('content')

@if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
    
    <h2>Checkout</h2>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf

        <h5>Detail Pembelian</h5>
        @foreach ($items as $list)
            <h3>{{ $list['title'] }}</h3>
            <p>{{ $list['quantity'] }} x {{ Number::currency($list['price'], 'IDR', 'id', precision: 0) }}</p>
            <p>{{ Number::currency($list['subtotal'], 'IDR', 'id', precision: 0)}}</p>
        @endforeach

        <p>Total : {{ Number::currency($total, 'IDR', 'id', precision: 0) }}</p>
        
        <h5>alamat pengiriman</h5>
        <textarea name="address" id="" cols="30" rows="10" required> {{old('address', $address)}}</textarea>

        <button type="submit">Pesan</button>
    </form>
@endsection
