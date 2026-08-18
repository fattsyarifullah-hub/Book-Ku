@extends('layouts.main')

@section('title', 'Checkout | BooKu')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
        <a href="{{ url('/') }}" class="hover:text-indigo-600 transition-colors">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-slate-800 font-medium">Checkout</span>
    </nav>

    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Checkout Pesanan</h1>
        <p class="text-slate-500 text-sm mt-1">Lengkapi detail alamat pengiriman untuk menyelesaikan pesanan Anda.</p>
    </div>

    <!-- Flash Notifications -->
    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3.5 rounded-xl text-sm">
            <div class="font-semibold mb-1">Terjadi Kesalahan:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3.5 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3.5 rounded-xl text-sm font-medium">
            {{ session('error') }}
        </div>
    @endif

    <!-- Checkout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left: Address & Form Card -->
        <div class="lg:col-span-7 bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-100">
            <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2 border-b border-slate-100 pb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Alamat Pengiriman
            </h2>

            <form action="{{ route('order.store') }}" method="POST" id="checkoutForm">
                @csrf
                <div class="mb-6">
                    <label for="address" class="block text-sm font-semibold text-slate-700 mb-2">
                        Alamat Lengkap Pengiriman <span class="text-red-500">*</span>
                    </label>
                    <textarea name="address" 
                              id="address" 
                              rows="5" 
                              class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm text-slate-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400" 
                              placeholder="Masukkan nama penerima, no. HP, nama jalan, RT/RW, kelurahan, kecamatan, kota, dan kode pos..."
                              required>{{ old('address', $address) }}</textarea>
                </div>

                <button type="submit" 
                        class="w-full bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-semibold py-4 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2 text-base">
                    <span>Buat Pesanan & Lanjut Pembayaran</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Right: Order Summary Card -->
        <div class="lg:col-span-5 bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-100 lg:sticky lg:top-24">
            <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2 border-b border-slate-100 pb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Ringkasan Pesanan
            </h2>

            <!-- Items List -->
            <div class="divide-y divide-slate-100 mb-6 max-h-[320px] overflow-y-auto pr-1">
                @foreach ($items as $list)
                    <div class="py-3.5 first:pt-0 last:pb-0 flex items-start justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-slate-800 truncate">{{ $list['title'] }}</h4>
                            <p class="text-xs text-slate-500 mt-0.5">
                                {{ $list['quantity'] }} x {{ Number::currency($list['price'], 'IDR', 'id', precision: 0) }}
                            </p>
                        </div>
                        <div class="text-sm font-bold text-slate-900 text-right">
                            {{ Number::currency($list['subtotal'], 'IDR', 'id', precision: 0) }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Total Price Summary Box -->
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 space-y-2">
                <div class="flex items-center justify-between text-slate-600 text-sm">
                    <span>Subtotal Produk</span>
                    <span class="font-medium text-slate-800">{{ Number::currency($total, 'IDR', 'id', precision: 0) }}</span>
                </div>
                <div class="flex items-center justify-between text-slate-600 text-sm">
                    <span>Biaya Pengiriman</span>
                    <span class="font-medium text-emerald-600">Gratis</span>
                </div>
                <div class="border-t border-slate-200 pt-2 mt-2 flex items-center justify-between">
                    <span class="text-base font-bold text-slate-900">Total Pembayaran</span>
                    <span class="text-xl font-extrabold text-indigo-600">
                        {{ Number::currency($total, 'IDR', 'id', precision: 0) }}
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
