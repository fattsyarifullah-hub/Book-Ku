@extends('layouts.main')

@section('title', 'Book-Ku | Order History')

@section('content')
    <div class="history-page">
        <div class="history-header">
            <div>
                <p class="history-eyebrow">Your purchases</p>
                <h1>Order History</h1>
            </div>
            <a href="{{ route('catalog.index') }}" class="history-cta">Continue Shopping</a>
        </div>

        @if ($orderHistory->isEmpty())
            <div class="history-empty">
                <div class="history-empty-icon">
                    <i class="bi bi-bag"></i>
                </div>
                <h2>No orders yet</h2>
                <p>You haven’t placed any order. Start exploring our bestsellers and find your next favorite book.</p>
                <a href="{{ route('catalog.index') }}" class="history-cta">Explore Catalog</a>
            </div>
        @else
            <div class="history-summary">
                <div class="summary-card">
                    <span>Total Orders</span>
                    <strong>{{ $orderHistory->count() }}</strong>
                </div>
                <div class="summary-card">
                    <span>Total Spent</span>
                    <strong>{{ Number::currency($orderHistory->sum('total_price'), 'IDR', 'id', precision: 0) }}</strong>
                </div>
                <div class="summary-card">
                    <span>Most Recent</span>
                    <strong>{{ $orderHistory->sortByDesc('order_date')->first()->status }}</strong>
                </div>
            </div>

            <div class="history-list">
                @foreach ($orderHistory->sortByDesc('order_date') as $order)
                    @php $order->loadMissing('orderItem.book'); @endphp

                    <article class="history-order">
                        <div class="order-header">
                            <div>
                                <p class="order-label">Invoice</p>
                                <h2>{{ $order->invoice_number }}</h2>
                            </div>
                            <span class="order-status status-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div class="order-meta">
                            <div>
                                <span>Order Date</span>
                                <strong>{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d M Y') }}</strong>
                            </div>
                            <div>
                                <span>Total</span>
                                <strong>{{ Number::currency($order->total_price, 'IDR', 'id', precision: 0) }}</strong>
                            </div>
                        </div>

                        <div class="order-items">
                            @foreach ($order->orderItem as $item)
                                <div class="order-item">
                                    <div class="item-thumb">
                                        @if ($item->book && $item->book->image)
                                            <img src="{{ asset('storage/imagebook/' . $item->book->image) }}"
                                                alt="{{ $item->book->title }}">
                                        @else
                                            <div class="item-thumb-placeholder">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="item-details">
                                        <h3>{{ $item->book->title ?? 'Book' }}</h3>
                                        <p>{{ $item->quantity }} item(s) ·
                                            {{ Number::currency($item->price, 'IDR', 'id', precision: 0) }} each</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="order-footer">
                            <div class="order-address">
                                <span>Shipping Address</span>
                                <p>{{ $order->address }}</p>
                            </div>

                            <a href="{{ route('order.invoice', $order->id) }}" class="order-link">View Invoice</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>

    @push('styles')
        <style>
            :root {
                --primary: #4f46e5;
                --primary-hover: #4338ca;
                --primary-soft: #eef2ff;
                --success: #00b686;
                --warning: #f59e0b;
                --bg: #f8fafc;
                --card: #ffffff;
                --text: #0f172a;
                --muted: #64748b;
                --border: #e2e8f0;
                --shadow: 0 14px 32px rgba(15, 23, 42, 0.08);
            }

            .history-page {
                max-width: 1180px;
                margin: 0 auto;
                padding: 36px 20px 60px;
                color: var(--text);
            }

            .history-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
                margin-bottom: 28px;
            }

            .history-eyebrow {
                margin: 0 0 8px;
                color: var(--primary);
                font-size: 12px;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
            }

            .history-header h1 {
                margin: 0;
                font-size: clamp(2rem, 4vw, 2.6rem);
                font-weight: 800;
                color: var(--text);
            }

            .history-cta {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 18px;
                border-radius: 12px;
                background: var(--primary);
                color: #fff;
                text-decoration: none;
                font-size: 13px;
                font-weight: 700;
                box-shadow: 0 8px 18px rgba(79, 70, 229, 0.2);
                transition: all 0.2s ease;
            }

            .history-cta:hover {
                background: var(--primary-hover);
            }

            .history-summary {
                display: grid;
                grid-template-columns: repeat(3, minmax(180px, 1fr));
                gap: 18px;
                margin-bottom: 30px;
            }

            .summary-card {
                padding: 22px 20px;
                border: 1px solid var(--border);
                border-radius: 18px;
                background: var(--card);
                box-shadow: var(--shadow);
            }

            .summary-card span {
                display: block;
                margin-bottom: 8px;
                color: var(--muted);
                font-size: 12px;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .summary-card strong {
                font-size: clamp(1.1rem, 2vw, 1.5rem);
                color: var(--text);
            }

            .history-list {
                display: flex;
                flex-direction: column;
                gap: 22px;
            }

            .history-order {
                overflow: hidden;
                border: 1px solid var(--border);
                border-radius: 22px;
                background: var(--card);
                box-shadow: var(--shadow);
            }

            .order-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                padding: 22px 24px 18px;
                border-bottom: 1px solid var(--border);
                background: linear-gradient(180deg, rgba(79, 70, 229, 0.02), rgba(79, 70, 229, 0));
            }

            .order-label {
                margin: 0 0 5px;
                color: var(--muted);
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.1em;
                text-transform: uppercase;
            }

            .order-header h2 {
                margin: 0;
                font-size: clamp(1.1rem, 2vw, 1.6rem);
                font-weight: 800;
                color: var(--text);
            }

            .order-status {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 126px;
                padding: 9px 14px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.04em;
                text-transform: uppercase;
            }

            .status-pending {
                background: rgba(245, 158, 11, 0.12);
                color: #b45309;
            }

            .status-processing {
                background: rgba(79, 70, 229, 0.1);
                color: var(--primary);
            }

            .status-completed {
                background: rgba(0, 182, 134, 0.1);
                color: #047857;
            }

            .order-meta {
                display: grid;
                grid-template-columns: repeat(2, minmax(180px, 1fr));
                gap: 18px;
                padding: 18px 24px 0;
            }

            .order-meta div {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .order-meta span {
                color: var(--muted);
                font-size: 12px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .order-meta strong {
                font-size: 15px;
                color: var(--text);
            }

            .order-items {
                padding: 20px 24px 0;
                display: grid;
                gap: 14px;
            }

            .order-item {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 12px 14px;
                border: 1px solid var(--border);
                border-radius: 14px;
                background: #f8fafc;
            }

            .item-thumb {
                width: 62px;
                height: 82px;
                border-radius: 10px;
                overflow: hidden;
                background: var(--primary-soft);
                flex-shrink: 0;
            }

            .item-thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .item-thumb-placeholder {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
                color: var(--primary);
                font-size: 24px;
            }

            .item-details {
                min-width: 0;
            }

            .item-details h3 {
                margin: 0 0 4px;
                font-size: 15px;
                font-weight: 700;
                color: var(--text);
            }

            .item-details p {
                margin: 0;
                color: var(--muted);
                font-size: 12px;
            }

            .order-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                padding: 18px 24px 24px;
                margin-top: 14px;
                border-top: 1px solid var(--border);
            }

            .order-address {
                flex: 1;
                min-width: 0;
            }

            .order-address span {
                display: block;
                margin-bottom: 7px;
                color: var(--muted);
                font-size: 11px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .order-address p {
                margin: 0;
                color: var(--text);
                font-size: 13px;
                line-height: 1.6;
            }

            .order-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 11px 16px;
                border-radius: 12px;
                border: 1px solid var(--border);
                background: #fff;
                color: var(--text);
                text-decoration: none;
                font-size: 13px;
                font-weight: 700;
                transition: all 0.2s ease;
            }

            .order-link:hover {
                border-color: var(--primary);
                color: var(--primary);
            }

            .history-empty {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 420px;
                padding: 40px 20px;
                border: 1px solid var(--border);
                border-radius: 26px;
                background: var(--card);
                box-shadow: var(--shadow);
                text-align: center;
            }

            .history-empty-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: var(--primary-soft);
                color: var(--primary);
                font-size: 30px;
                margin-bottom: 18px;
            }

            .history-empty h2 {
                margin: 0 0 10px;
                font-size: 28px;
                color: var(--text);
            }

            .history-empty p {
                max-width: 560px;
                margin: 0 0 22px;
                color: var(--muted);
                line-height: 1.7;
            }

            @media (max-width: 768px) {
                .history-header {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .history-summary {
                    grid-template-columns: 1fr;
                }

                .order-header,
                .order-footer {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .order-meta {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    @endpush
@endsection
