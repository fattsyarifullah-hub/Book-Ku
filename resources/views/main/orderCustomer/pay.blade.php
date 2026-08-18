@extends('layouts.main')

@section('title', 'Pembayaran | BooKu')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
        <a href="{{ url('/') }}" class="hover:text-indigo-600 transition-colors">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('customer.history') }}" class="hover:text-indigo-600 transition-colors">Pesanan</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-slate-800 font-medium">Pembayaran</span>
    </nav>

    <!-- Main Payment Container -->
    <div class="bg-white rounded-2xl p-6 sm:p-10 shadow-sm border border-slate-100 max-w-2xl mx-auto">
        <!-- Header & Status Badge -->
        <div class="text-center mb-8 pb-6 border-b border-slate-100">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 mb-4 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Selesaikan Pembayaran</h1>
            <p class="text-slate-500 text-sm mt-1">Pilih metode pembayaran yang aman via Midtrans Gateway</p>
            <div class="mt-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                <span>Invoice:</span>
                <span class="text-indigo-600 font-bold">{{ $order->invoice_number }}</span>
            </div>
        </div>

        <!-- Product Breakdown -->
        <div class="mb-6">
            <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-wider mb-3">Detail Item Pesanan</h3>
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 divide-y divide-slate-200/60">
                @foreach ($order->orderItem as $item)
                    <div class="py-2.5 first:pt-0 last:pb-0 flex items-center justify-between gap-4">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->book->title }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">
                                {{ $item->quantity }} unit x {{ Number::currency($item->price, 'IDR', 'id', precision: 0) }}
                            </p>
                        </div>
                        <span class="text-sm font-bold text-slate-900">
                            {{ Number::currency($item->quantity * $item->price, 'IDR', 'id', precision: 0) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Total Amount Display -->
        <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-5 mb-8 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold uppercase text-indigo-500 tracking-wider block">Total Tagihan</span>
                <span class="text-2xl sm:text-3xl font-extrabold text-indigo-700">
                    {{ Number::currency($order->total_price, 'IDR', 'id', precision: 0) }}
                </span>
            </div>
            <div class="flex items-center gap-1 text-xs text-indigo-600 font-medium bg-white px-3 py-1.5 rounded-lg shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span>Pembayaran Aman</span>
            </div>
        </div>

        <!-- Midtrans Payment Action -->
        <button id="pay-button" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-semibold py-4 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2 text-base">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Bayar Sekarang
        </button>
    </div>
</div>

<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.getElementById('pay-button').addEventListener('click', function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = "{{ route('order.invoice', $order->id) }}";
            },
            onPending: function(result) {
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
