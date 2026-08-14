<h2>Checkout</h2>

<form action="{{ route('order.store') }}" method="POST">
    @csrf
    <input type="hidden" name="book_id" value="{{ $book->id }}">
    <input type="hidden" name="quantity" value="{{ $quantity }}">


    <h5>Detail Produk</h5>
    <p><strong>{{$book->title}}</strong> {{ Number::currency($book->price, 'IDR', 'id', precision: 0)}}</p>
    <p>Jumlah : {{$quantity}}</p>
    <p><strong>Total Rp {{Number::currency($total, 'IDR', 'id', precision: 0)}}</strong></p>

    <h5>Alamat Pengiriman</h5>
    <textarea name="address" id="" cols="30" rows="10" required>{{ old('address', $address) }}</textarea>

    <button type="submit">Pesan</button>
</form>