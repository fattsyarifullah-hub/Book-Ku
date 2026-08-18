<div>
    <h1>Pesanan berhasil</h1>
</div>

<div>
    <h2>Invoice</h2>
    <strong>Nomor Invoice : {{$order->invoice_number }}</strong>

    <p><strong>Tanggal : {{ $strDate }}</strong></p>
    <p><strong>Alamat : {{$order->address}}</strong></p>
    

    <div class="payment-method">
        <p><strong>Metode Pembayaran : {{$payment?->payment_method_label ?? 'Belum Ditentukan'}}</strong></p>
        <p>
            <strong>Status Pembayaran :
                @if ($order->status === 'processing')
                Lunas
                @elseif ($order->status === 'pending')
                Menunggu Pembayaran
                @else
                {{ ucfirst($order->status) }}
                @endif
            </strong>
        </p>
    </div>

    <h5>Detail produk</h5>
    @foreach ($order->orderItem as $items)
        <p>Judul Buku :{{$items->title}}</p>
        <p>Jumlah : {{$items->quantity}}</p>
        <p>Harga {{Number::currency($items->price, 'IDR', 'id', precision: 0)}}</p>
    @endforeach
    <h4>Total : {{Number::currency($order->total_price, 'IDR', 'id', precision: 0)}}</h4>
</div>

<a href="{{ route('catalog.index') }}">Kembali ke katalog</a>