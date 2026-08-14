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

    <form action="{{ route('cart.checkoutByCart') }}" method="POST" id="checkoutForm">
        @csrf
    </form>

    @if ($cartItems->isEmpty())
        <p>keranjang kosong</p>
    @else
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll">Pilih semua</th>
                    <th>Buku</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $list)
                    <tr>
                        <td>
                            <input type="checkbox" name="selected[]" id="" value="{{ $list->id }}"
                                class="item-checkbox" form="checkoutForm">
                        </td>
                        <td>{{ $list->book->title }}</td>
                        <td>{{ Number::currency($list->book->price, 'IDR', 'id', precision: 0) }}</td>
                        <td>
                            <form action="{{ route('cart.update', $list->id) }}" method="POST"
                                class="update-quantity-form">
                                @csrf
                                <div class="input-group">
                                    <input type="number" name="quantity" value="{{ $list->quantity }}" min="1"
                                        max="{{ $list->book->stock }}" data-id="{{ $list->id }}"
                                        class="form-control quantity-input">
                                    <button type="submit">Update</button>

                                </div>
                            </form>
                        </td>
                        <td class="subtotal" data-price="{{ $list->book->price }}" data-quantity="{{ $list->quantity }}">
                            {{ Number::currency($list->quantity * $list->book->price, 'IDR', 'id', precision: 0) }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $list->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total : <span id="totalPrice">Rp 0</span></h4>
        <button type="submit" form="checkoutForm">Pesan Sekarang</button>
    @endif

    <script>
        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.item-checkbox:checked').forEach(function(checkbox) {
                const row = checkbox.closest('tr');
                const subtotalText = row.querySelector('.subtotal').innerText;
                const subtotal = parseFloat(subtotalText.replace(/[^0-9]/g, ''));
                if (!isNaN(subtotal)) total += subtotal;
            });
            document.getElementById('totalPrice').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        document.querySelectorAll('.item-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', calculateTotal);
        });

        // Tombol "Pilih Semua"
        document.getElementById('selectAll').addEventListener('change', function() {
            document.querySelectorAll('.item-checkbox').forEach(function(cb) {
                cb.checked = this.checked;
            });
            calculateTotal();
        });

        // Saat halaman dimuat, hitung total awal
        window.onload = function() {
            calculateTotal();
        };

        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('change', function() {
                const row = this.closest('tr');
                const price = parseFloat(row.querySelector('.subtotal').dataset.price);
                const qty = parseInt(this.value) || 0;
                const subtotal = price * qty;
                row.querySelector('.subtotal').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                row.querySelector('.subtotal').dataset.quantity = qty;
                calculateTotal(); // update total
            });
        });
    </script>
@endsection
