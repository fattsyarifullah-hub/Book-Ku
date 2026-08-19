@extends('layouts.main')

@section('title', 'Book-Ku | Cart')

@section('content')

    <div class="cart-page">
        <div class="cart-header">
            <h1>
                Keranjang Belanja
            </h1>
            <p>
                Periksa buku yang ingin dipesan.
            </p>
        </div>

        @if ($errors->any())
            <div class="cart-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="cart-alert success">
                {{ session('success') }}
            </div>
        @endif

        <form action={{ route('cart.checkoutByCart') }} method="POST" id="checkoutForm">
            @csrf
        </form>

        @if ($cartItems->isEmpty())
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    Icon
                </div>
                <h2>
                    Keranjangmu Kosong
                </h2>
                <p>
                    Belum ada buku yang ditambahkan ke keranjang.
                </p>
                <a href="{{ route('catalog.index') }}" class="continue-shopping">
                    Kembali ke katalog
                </a>
            </div>
        @else
            <div class="cart-layout">
                <div class="cart-items-box">
                    <label class="cart-select-all">
                        <input type="checkbox" id="selectAll">
                        <span>
                            Pilih semua
                        </span>
                    </label>

                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th class="bm-th">
                                    Pilih
                                </th>
                                <th class="bm-th">
                                    Buku
                                </th>
                                <th class="bm-th">
                                    Info
                                </th>
                                <th class="bm-th">
                                    Harga
                                </th>
                                <th class="bm-th">
                                    Jumlah
                                </th>
                                <th class="bm-th">
                                    Total
                                </th>
                                <th class="bm-th">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cartItems as $list)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected[]" value="{{ $list->id }}"
                                            class="item-checkbox" form="checkoutForm">
                                    </td>

                                    <td>
                                        <div class="book-cart">
                                            <div class="book-cart-image">
                                                <img src="{{ asset('storage/imagebook/' . $list->book->image) }}"
                                                    alt="{{ $list->book->title }}">
                                            </div>
                                        </div>
                                    </td>

                                    <td>

                                        <div class="book-cart-info">
                                            <h3 class="book-cart-title">
                                                {{ $list->book->title }}
                                            </h3>

                                            <p class="book-cart-author">
                                                {{ $list->book->author }}
                                            </p>
                                        </div>
                                    </td>

                                    <td class="bm-td">
                                        <p class="book-price">
                                            {{ Number::currency($list->book->price, 'IDR', 'id', precision: 0) }}
                                        </p>
                                    </td>

                                    <td class="bm-td">
                                        <form action="{{ route('cart.update', $list->id) }}" method="POST"
                                            class="quantity-form">
                                            @csrf

                                            <input type="number" name="quantity" value="{{ $list->quantity }}"
                                                min="1" max="{{ $list->book->stock }}"
                                                data-id="{{ $list->id }}" data-price="{{ $list->book->price }}"
                                                class="quantity-input">

                                            <button type="submit" class="update-btn">
                                                Update
                                            </button>
                                        </form>
                                    </td>

                                    <td class="subtotal" data-price="{{ $list->book->price }}"
                                        data-quantity="{{ $list->quantity }}">
                                        {{ Number::currency($list->quantity * $list->book->price, 'IDR', 'id', precision: 0) }}
                                    </td>

                                    <td>
                                        <form action="{{ route('cart.destroy', $list->id) }}" method="POST">

                                            @csrf

                                            @method('DELETE')
                                            <button type="submit" class="delete-btn">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <aside class="cart-summary">
                    <h2 class="summary-title">
                        Ringkasan Pesanan
                    </h2>

                    <div class="summary-row">
                        <span>
                            Item dipilih
                        </span>
                        <strong id="selectedCount">
                            0
                        </strong>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-total">
                        <span>
                            Total
                        </span>
                        <strong id="totalPrice">
                            Rp 0
                        </strong>
                    </div>

                    <button type="submit" form="checkoutForm" class="checkout-btn">
                        Pesan Sekarang
                    </button>

                    <a href="{{ route('catalog.index') }}" class="continue-shopping">
                        Lanjut Belanja
                    </a>
                </aside>
            </div>
        @endif
    </div>

    <script>
        function calculateTotal() {
            let total = 0;
            let selectedCount = 0;

            document
                .querySelectorAll('.item-checkbox:checked')
                .forEach(function(checkbox) {
                    const row = checkbox.closest('tr');
                    const subtotalElement =
                        row.querySelector('.subtotal');
                    const subtotalText =
                        subtotalElement.innerText;
                    const subtotal =
                        parseFloat(
                            subtotalText.replace(/[^0-9]/g, '')
                        );
                    if (!isNaN(subtotal)) {
                        total += subtotal;
                    }
                    selectedCount++;
                });

            const totalPrice =
                document.getElementById('totalPrice');
            const selectedCountElement =
                document.getElementById('selectedCount');

            if (totalPrice) {

                totalPrice.innerText =
                    'Rp ' + total.toLocaleString('id-ID');
            }

            if (selectedCountElement) {
                selectedCountElement.innerText =
                    selectedCount;
            }
        }

        document
            .querySelectorAll('.item-checkbox')
            .forEach(function(checkbox) {

                checkbox.addEventListener(
                    'change',
                    calculateTotal
                );

            });
        const selectAll =
            document.getElementById('selectAll');

        if (selectAll) {

            selectAll.addEventListener(
                'change',
                function() {

                    document
                        .querySelectorAll('.item-checkbox')
                        .forEach(function(cb) {

                            cb.checked =
                                selectAll.checked;

                        });

                    calculateTotal();

                }
            );

        }

        document
            .querySelectorAll('.quantity-input')
            .forEach(function(input) {

                input.addEventListener(
                    'change',
                    function() {

                        const row =
                            this.closest('tr');

                        const price =
                            parseFloat(
                                row
                                .querySelector('.subtotal')
                                .dataset.price
                            );

                        const qty =
                            parseInt(this.value) || 0;

                        const subtotal =
                            price * qty;

                        const subtotalElement =
                            row.querySelector('.subtotal');

                        subtotalElement.innerText =
                            'Rp ' +
                            subtotal.toLocaleString('id-ID');

                        subtotalElement.dataset.quantity =
                            qty;

                        calculateTotal();

                    }
                );

            });
        window.addEventListener(
            'load',
            function() {

                calculateTotal();
            }
        );
    </script>
@endsection
