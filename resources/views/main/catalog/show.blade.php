<img src="{{ asset('storage/imagebook/' . $book->image) }}" alt="{{ $book->title }}">
<h1>{{ $book->title }}</h1>
<h3>{{ $book->author }}</h3>
<small>Harga : {{ Number::currency($book->price, 'IDR', 'id', precision: 0) }}</small>
@if ($book->stock <= 10)
    <p style="background-color: red">Sisa Stok :{{ $book->stock }}</p>
@else
    <p style="background-color: blue">Sisa Stok : {{ $book->stock }}</p>
@endif
<form id="orderForm" action="{{ route('order.checkout') }}" method="GET">
    @csrf
    <input type="hidden" name="book_id" value="{{ $book->id }}">
    <div class="form-group">
        <label for="quantity">Jumlah</label>
        <div class="input-group" style="width:150px;">
            <button type="button" class="btn btn-outline-secondary" onclick="decrease()">-</button>
            <input type="number" name="quantity" id="quantity" class="form-control text-center" value="1"
                min="1" max="{{ $book->stock }}">
            <button type="button" class="btn btn-outline-secondary" onclick="increase()">+</button>
        </div>
        <button type="submit" class="btn btn-success">Pesan Sekarang</button>
        <button type="button" class="btn btn-warning" onclick="addToCart()">Tambahkan ke Keranjang</button>
    </div>
</form>

<script>
    const quantityInput = document.getElementById('quantity');
    function increase() {
        let val = parseInt(quantityInput.value) || 0;
        let max = parseInt(quantityInput.getAttribute('max')) || Infinity;
        if (val < max) quantityInput.value = val + 1;
    }

    function decrease() {
        let val = parseInt(quantityInput.value) || 0;
        if (val > 1) quantityInput.value = val - 1;
    }
    function addToCart() {
        const form = document.getElementById('orderForm');
        // Ubah action dan method menjadi POST ke cart
        form.action = "{{ route('cart.add') }}";
        form.method = "POST";
        // Tambahkan CSRF (sudah ada @csrf di form)
        form.submit();
    }
</script>