@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="content" style="padding-top: 10px;">
    <!-- Stats Grid -->
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Books</span>
            </div>
            <div class="stat-value">{{ $bookCount }}</div>
            <div class="stat-change" style="color: var(--primary);">Active in catalog</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Categories</span>
            </div>
            <div class="stat-value">{{ $categories }}</div>
            <div class="stat-change" style="color: var(--primary);">Different genres</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Users</span>
            </div>
            <div class="stat-value">{{ $userCount }}</div>
            <div class="stat-change" style="color: var(--primary);">Registered accounts</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Order</span>
            </div>
            <div class="stat-value">{{ $orderCount }}</div>
            <div class="stat-change" style="color: var(--primary);">Recent transactions</div>
        </div>
    </div>

    <div class="dashboard-grid">
        <!-- Left: Latest Orders Table -->
        <div class="orders-card">
            <h3 class="card-title">Latest Orders</h3>
            <div class="table-wrapper">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th class="bm-th">Invoice Number</th>
                            <th class="bm-th">Total Price</th>
                            <th class="bm-th">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderlast as $o)
                            <tr>
                                <td class="invoice">{{ $o->invoice_number }}</td>
                                <td>Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
                                
                                @switch($o->status)
                                    @case('pending')
                                        @php $statusClass = 'status-pending'; @endphp
                                        @break

                                    @case('processing')
                                        @php $statusClass = 'status-processing'; @endphp
                                        @break

                                    @case('completed')
                                        @php $statusClass = 'status-completed'; @endphp
                                        @break

                                    @default
                                        @php $statusClass = 'status-pending'; @endphp
                                        @break
                                @endswitch
                                <td>
                                    <span class="in-status {{ $statusClass }}">{{ ucfirst($o->status) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <h3 class="card-title">Latest Registered</h3>
            <div class="stock-list">
                @forelse ($user as $item)
                    <div class="stock-item">
                        <div>
                            <div class="stock-name">{{ $item->name }}</div>
                            <div class="stock-author">{{ $item->email }}</div>
                        </div>
                        <span class="stock-badge" style="background: var(--primary-light); color: var(--primary);">User</span>
                    </div>
                @empty
                    <p class="cm-empty-note">No registered users.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
