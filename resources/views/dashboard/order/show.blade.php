@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Order Detail')

@section('content')
    <div class="or-status-wrapper">
    <div class="order-journey-status">
        <div
            style="background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px 32px; font-family: ui-sans-serif, system-ui, sans-serif; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">

            <h3 style="margin: 0 0 28px 0; font-size: 18px; font-weight: 700; color: #0f172a;">
                Order Journey Status
            </h3>

            @php
                // Mapping enum database ke label tampilan dan urutan step
                $statusSteps = [
                    'pending' => ['label' => 'Pending', 'level' => 1],
                    'processing' => ['label' => 'Processing', 'level' => 2],
                    'completed' => ['label' => 'Completed', 'level' => 3],
                ];

                // Mendapatkan posisi level saat ini dari objek $order
                $currentLevel = $statusSteps[$order->status]['level'] ?? 1;
            @endphp

            <div style="display: flex; align-items: center; width: 100%;">
                @foreach ($statusSteps as $statusKey => $step)
                    @php
                        $stepLevel = $step['level'];

                        // Cek apakah step ini sudah dilewati/selesai
                        $isPassed = $stepLevel < $currentLevel;
                        // Cek apakah step ini adalah status aktif saat ini
                        $isCurrent = $stepLevel === $currentLevel;
                    @endphp

                    <div style="display: flex; align-items: center; {{ !$loop->last ? 'flex-grow: 1;' : '' }}">

                        {{-- KONDISI 1: Step sudah dilewati (Centang Hijau) ATAU Seluruh Order Selesai --}}
                        @if ($isPassed || ($isCurrent && $statusKey === 'completed'))
                            <div
                                style="width: 32px; height: 32px; border-radius: 50%; background-color: #00ba7c; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg style="width: 18px; height: 18px; fill: none; stroke: #ffffff; stroke-width: 3; stroke-linecap: round; stroke-linejoin: round;"
                                    viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>

                            {{-- KONDISI 2: Step sedang berjalan / posisi aktif saat ini (Nomor Ungu) --}}
                        @elseif($isCurrent)
                            <div
                                style="width: 32px; height: 32px; border-radius: 50%; background-color: #4f46e5; color: #ffffff; font-weight: 700; font-size: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                {{ $stepLevel }}
                            </div>

                            {{-- KONDISI 3: Step belum tercapai (Nomor Abu-abu) --}}
                        @else
                            <div
                                style="width: 32px; height: 32px; border-radius: 50%; background-color: #e5e7eb; color: #6b7280; font-weight: 700; font-size: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                {{ $stepLevel }}
                            </div>
                        @endif

                        <!-- Label Status -->
                        <span
                            style="margin-left: 12px; font-weight: 600; font-size: 15px; color: #0f172a; white-space: nowrap;">
                            {{ $step['label'] }}
                        </span>

                        <!-- Garis Penghubung antar Step -->
                        @if (!$loop->last)
                            <div
                                style="flex-grow: 1; height: 2px; margin: 0 16px; background-color: {{ $stepLevel < $currentLevel ? '#00ba7c' : '#e5e7eb' }};">
                            </div>
                        @endif

                    </div>
                @endforeach
            </div>

        </div>
    </div>
    </div>
    
    <div class="or-info-wrapper">
        <div class="or-card">
            <h2><strong>Order Items</strong></h2>
            <div class="or-table-wrapper">
                <table class="bm-table">
                    <thead>
                        <th class="bm-th">Name</th>
                        <th class="bm-th">Quantity</th>
                        <th class="bm-th">Price</th>
                        <th class="bm-th">Subtotal</th>
                    </thead>
                    @foreach ($order->orderItem as $item)
                        <tbody>
                            <tr class="bm-tr">
                                <td class="bm-td">{{ $item->book->title }}</td>
                                <td class="bm-td">{{ $item->quantity }}</td>
                                <td class="bm-td">{{ Number::currency($item->book->price, 'IDR', 'id', precision:0) }}</td>
                                <td class="bm-td">{{ Number::currency($item->order->total_price, 'IDR', 'id', precision:0) }}</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                <div class="price-info">
                    <small><strong>Total Price: {{ Number::currency($item->order->total_price, 'IDR', 'id', precision:0) }}</strong></small>
                </div>
            </div>
        </div>
        <div class="or-card">
            <h3><strong>Detail Customer</strong></h3>
            <div>
                <label for="p">Nama</label>
                <p>{{ $order->user->name }}</p>
            </div>
            <div>
                <label for="p">Email</label>
                <p>{{ $order->user->email }}</p>
            </div>
            <div>
                <label for="small">Alamat</label>
                <p>{{ $order->user->address }}</p>
            </div>
        </div>
    </div>
@endsection
