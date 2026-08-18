@extends('layouts.main')

@section('title', $book->title . ' | BooKu')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
        <a href="{{ url('/') }}" class="hover:text-indigo-600 transition-colors">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('catalog.index') }}" class="hover:text-indigo-600 transition-colors">Katalog</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-slate-800 font-medium truncate max-w-xs">{{ $book->title }}</span>
    </nav>

    <!-- Main Detail Card -->
    <div class="bg-white rounded-2xl p-6 sm:p-10 shadow-sm border border-slate-100 grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-start">
        
        <!-- Book Cover Image Column -->
        <div class="md:col-span-5 flex flex-col items-center">
            <div class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-8 flex justify-center items-center relative overflow-hidden shadow-inner min-h-[360px]">
                <img src="{{ asset('storage/imagebook/' . $book->image) }}" 
                     alt="{{ $book->title }}"
                     class="max-h-[300px] w-auto object-cover rounded-lg shadow-xl transition-transform duration-300 hover:scale-105">
            </div>

            <!-- Stock Status Badge -->
            <div class="w-full mt-4 flex items-center justify-center">
                @if ($book->stock <= 10)
                    <div class="w-full text-center px-4 py-2.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 font-medium text-sm flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Sisa Stok Terbatas: <strong>{{ $book->stock }}</strong> unit</span>
                    </div>
                @else
                    <div class="w-full text-center px-4 py-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 font-medium text-sm flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Stok Tersedia: <strong>{{ $book->stock }}</strong> unit</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Book Info & Purchase Form Column -->
        <div class="md:col-span-7 flex flex-col">
            @if(isset($book->category))
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-600 w-fit mb-3">
                    {{ $book->category->name }}
                </span>
            @endif

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 leading-snug mb-2">
                {{ $book->title }}
            </h1>

            <p class="text-slate-500 font-medium text-base mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Penulis: <span class="text-slate-800 font-semibold">{{ $book->author }}</span>
            </p>

            <div class="bg-slate-50 rounded-xl p-4 sm:p-5 mb-6 border border-slate-100">
                <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold block mb-1">Harga Spesial</span>
                <span class="text-3xl sm:text-4xl font-extrabold text-indigo-600">
                    {{ Number::currency($book->price, 'IDR', 'id', precision: 0) }}
                </span>
            </div>

            <!-- Order / Cart Form -->
            <form id="orderForm" action="{{ route('order.checkout') }}" method="GET" class="mt-2">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">

                <div class="mb-6">
                    <label for="quantity" class="block text-sm font-semibold text-slate-700 mb-2">
                        Jumlah Pembelian
                    </label>
                    <div class="flex items-center gap-2 max-w-[160px]">
                        <button type="button" 
                                onclick="decrease()"
                                class="w-10 h-10 rounded-xl border border-slate-200 bg-white text-slate-600 font-bold hover:bg-slate-100 active:bg-slate-200 transition-colors flex items-center justify-center text-lg focus:outline-none">
                            -
                        </button>
                        <input type="number" 
                               name="quantity" 
                               id="quantity" 
                               class="w-16 h-10 border border-slate-200 rounded-xl text-center font-bold text-slate-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none" 
                               value="1" 
                               min="1" 
                               max="{{ $book->stock }}">
                        <button type="button" 
                                onclick="increase()"
                                class="w-10 h-10 rounded-xl border border-slate-200 bg-white text-slate-600 font-bold hover:bg-slate-100 active:bg-slate-200 transition-colors flex items-center justify-center text-lg focus:outline-none">
                            +
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button type="submit" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-semibold py-3.5 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Pesan Sekarang
                    </button>
                    <button type="button" 
                            onclick="addToCart()"
                            class="w-full bg-white hover:bg-slate-50 border-2 border-indigo-600 text-indigo-600 font-semibold py-3.5 px-6 rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Tambahkan ke Keranjang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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
        form.action = "{{ route('cart.add') }}";
        form.method = "POST";
        form.submit();
    }
</script>
@endsection