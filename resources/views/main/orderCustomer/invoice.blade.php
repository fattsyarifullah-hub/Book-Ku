@extends('layouts.main')

@section('title', 'Invoice #' . $order->invoice_number . ' | BooKu')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6 print:hidden">
        <a href="{{ url('/') }}" class="hover:text-indigo-600 transition-colors">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('customer.history') }}" class="hover:text-indigo-600 transition-colors">Pesanan</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-slate-800 font-medium">Invoice</span>
    </nav>

    <!-- Success Header Banner -->
    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 mb-8 flex items-center gap-4 shadow-sm print:hidden">
        <div class="w-12 h-12 rounded-xl bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div>
            <h2 class="text-lg font-bold text-emerald-900">Pesanan Berhasil Disimpan!</h2>
            <p class="text-sm text-emerald-700 mt-0.5">Terima kasih telah berbelanja di BooKu. Detail invoice pesanan Anda ada di bawah ini.</p>
        </div>
    </div>

    <!-- Printable Invoice Paper Card -->
    <div class="bg-white rounded-2xl p-6 sm:p-10 shadow-sm border border-slate-100 mb-8">
        <!-- Invoice Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-8 border-b border-slate-100">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 text-white flex items-center justify-center font-bold text-lg">
                        <i class="bi bi-book"></i>
                    </div>
                    <span class="text-xl font-bold text-slate-900">BooKu</span>
                </div>
                <p class="text-xs text-slate-400">Personal Literary Sanctuary</p>
            </div>
            <div class="text-left sm:text-right">
                <span class="inline-block px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-bold uppercase tracking-wider mb-1">INVOICE</span>
                <h3 class="text-lg font-extrabold text-slate-900">{{ $order->invoice_number }}</h3>
                <p class="text-xs text-slate-500 mt-0.5">Tanggal: {{ $strDate }}</p>
            </div>
        </div>

        <!-- Meta Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-8 py-4 bg-slate-50 rounded-xl p-5 border border-slate-100">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block mb-1">Alamat Pengiriman</span>
                <p class="text-sm font-medium text-slate-800 leading-relaxed">{{ $order->address }}</p>
            </div>
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block mb-1">Informasi Pembayaran</span>
                <p class="text-sm font-medium text-slate-800">Metode: <span class="font-semibold">{{ $payment?->payment_method_label ?? 'Belum Ditentukan' }}</span></p>
                <div class="mt-2 flex items-center gap-2">
                    <span class="text-sm font-medium text-slate-800">Status:</span>
                    @if ($order->status === 'processing')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                            Lunas
                        </span>
                    @elseif ($order->status === 'pending')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                            Menunggu Pembayaran
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-800 border border-slate-200">
                            {{ ucfirst($order->status) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Order Items Table -->
        <div class="mb-8">
            <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-3">Detail Produk</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-400 uppercase text-xs">
                            <th class="py-3 px-2 font-semibold">Judul Buku</th>
                            <th class="py-3 px-2 font-semibold text-center">Jumlah</th>
                            <th class="py-3 px-2 font-semibold text-right">Harga Satuan</th>
                            <th class="py-3 px-2 font-semibold text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($order->orderItem as $items)
                            <tr>
                                <td class="py-3.5 px-2 font-semibold text-slate-800">
                                    {{ $items->book->title ?? $items->title }}
                                </td>
                                <td class="py-3.5 px-2 text-center text-slate-600">
                                    {{ $items->quantity }}
                                </td>
                                <td class="py-3.5 px-2 text-right text-slate-600">
                                    {{ Number::currency($items->price, 'IDR', 'id', precision: 0) }}
                                </td>
                                <td class="py-3.5 px-2 text-right font-bold text-slate-900">
                                    {{ Number::currency($items->quantity * $items->price, 'IDR', 'id', precision: 0) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Total Box -->
        <div class="border-t border-slate-200 pt-4 flex flex-col items-end">
            <div class="w-full sm:w-72 bg-slate-50 rounded-xl p-4 border border-slate-100 space-y-2">
                <div class="flex items-center justify-between text-slate-600 text-sm">
                    <span>Subtotal</span>
                    <span class="font-medium text-slate-800">{{ Number::currency($order->total_price, 'IDR', 'id', precision: 0) }}</span>
                </div>
                <div class="flex items-center justify-between text-slate-600 text-sm">
                    <span>Pengiriman</span>
                    <span class="font-medium text-emerald-600">Gratis</span>
                </div>
                <div class="border-t border-slate-200 pt-2 flex items-center justify-between">
                    <span class="text-base font-bold text-slate-900">Total Akhir</span>
                    <span class="text-xl font-extrabold text-indigo-600">
                        {{ Number::currency($order->total_price, 'IDR', 'id', precision: 0) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap items-center justify-between gap-4 print:hidden">
        <a href="{{ route('catalog.index') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-semibold text-sm transition-all shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Katalog
        </a>

        <button onclick="window.print()" 
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm transition-all shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Invoice
        </button>
    </div>
</div>
@endsection