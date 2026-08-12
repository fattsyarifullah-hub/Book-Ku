<img src="{{ asset('storage/imagebook/' . $book->image) }}" alt="{{ $book->title }}">
<h1>{{$book->title}}</h1>
<h3>{{$book->author}}</h3>
<small>Harga : {{ Number::currency($book->price, 'IDR', 'id', precision: 0)}}</small>
@if ($book->stock <= 10)
    <p style="background-color: red">Sisa Stok :{{$book->stock}}</p>
@else
    <p style="background-color: blue">Sisa Stok : {{$book->stock}}</p>
@endif
<div class="w-36">
    <!-- Label Quantity -->
    <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-1">
        Quantity
    </label>

    <!-- Border Container Box -->
    <div class="flex items-center justify-between border border-gray-300 rounded-md bg-white px-2 py-1 shadow-sm">
        <!-- Tombol Minus -->
        <button type="button" id="btn-decrement" 
            class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-black focus:outline-none text-lg font-medium select-none transition">
            &minus;
        </button>

        <!-- Input Angka -->
        <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $book->stock ?? 99 }}" readonly
            class="w-10 text-center font-medium text-gray-800 focus:outline-none border-none bg-transparent [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">

        <!-- Tombol Plus -->
        <button type="button" id="btn-increment" 
            class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-black focus:outline-none text-lg font-medium select-none transition">
            &#43;
        </button>
    </div>
</div>
<button><a href="{{ route('catalog.index') }}">Pesan Sekarang</a></button>
<button><a href="{{ route('main.index') }}">Tambahkan ke Keranjang</a></button>

<!-- JavaScript untuk Logika Tambah & Kurang -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const decrementBtn = document.getElementById('btn-decrement');
        const incrementBtn = document.getElementById('btn-increment');
        const quantityInput = document.getElementById('quantity');

        // Mengambil batas minimum dan maksimum dari atribut input
        const minVal = parseInt(quantityInput.getAttribute('min')) || 1;
        const maxVal = parseInt(quantityInput.getAttribute('max')) || 99;

        // Kurangi Jumlah
        decrementBtn.addEventListener('click', function () {
            let currentVal = parseInt(quantityInput.value) || 1;
            if (currentVal > minVal) {
                quantityInput.value = currentVal - 1;
            }
        });

        // Tambah Jumlah
        incrementBtn.addEventListener('click', function () {
            let currentVal = parseInt(quantityInput.value) || 1;
            if (currentVal < maxVal) {
                quantityInput.value = currentVal + 1;
            }
        });
    });
</script>
