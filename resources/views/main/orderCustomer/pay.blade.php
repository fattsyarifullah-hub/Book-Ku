@extends('layouts.main')

@section('content')
    <h2>Pilih Metode Pembayaran</h2>

    <div class="detail">
        <strong>Nomor Invoice {{ $order->invoice_number }}</strong>
        <h5>Detail Produk</h5>
        @foreach ($order->orderItem as $item)
            <p>{{ $item->book->title }} - {{ Number::currency($item->price, 'IDR', 'id', precision: 0) }} x
                {{ $item->quantity }}</p>
        @endforeach
        <h4>{{ Number::currency($order->total_price, 'IDR', 'id', precision: 0) }}</h4>
    </div>
    
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <button id="pay-button">Bayar Sekarang</button>

    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = "{{ route('order.invoice', $order->id) }}";
                },
                onPending: function(result) {
                    // untuk VA/transfer bank, transaksi belum lunas tapi metode sudah dipilih
                    window.location.href = "{{ route('order.invoice', $order->id) }}";
                },
                onError: function(result) {
                    alert('Pembayaran gagal, silakan coba lagi.');
                },
                onClose: function() {
                    alert('Kamu menutup jendela pembayaran sebelum transaksi selesai.');
                }
            });
        });
    </script>
@endsection
