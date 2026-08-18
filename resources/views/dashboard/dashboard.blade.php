@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="content" style="padding-top: 10px;">
    <!-- Stats Grid -->
    <div class="stats-grid">
        <!-- Stat Card: Books -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Books</span>
                <div class="stat-icon" style="font-size: 18px;">📚</div>
            </div>
            <div class="stat-value">{{ $bookCount }}</div>
            <div class="stat-change" style="color: var(--primary);">Active in catalog</div>
        </div>

        <!-- Stat Card: Categories -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Categories</span>
                <div class="stat-icon" style="font-size: 18px;">📁</div>
            </div>
            <div class="stat-value">{{ $categories }}</div>
            <div class="stat-change" style="color: var(--primary);">Different genres</div>
        </div>

        <!-- Stat Card: Users -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Users</span>
                <div class="stat-icon" style="font-size: 18px;">👥</div>
            </div>
            <div class="stat-value">{{ count($user) }}</div>
            <div class="stat-change" style="color: var(--primary);">Registered accounts</div>
        </div>

        <!-- Stat Card: Latest Orders -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Latest Orders</span>
                <div class="stat-icon" style="font-size: 18px;">🛒</div>
            </div>
            <div class="stat-value">{{ count($orderlast) }}</div>
            <div class="stat-change" style="color: var(--primary);">Recent transactions</div>
        </div>
    </div>

    <!-- Dashboard Grid -->
    <div class="dashboard-grid">
        <!-- Left: Latest Orders Table -->
        <div class="orders-card">
            <h3 class="card-title">Latest Orders</h3>
            <div class="table-wrapper">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orderlast as $o)
                            <tr>
                                <td class="invoice">{{ $o->invoice_number }}</td>
                                <td>Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: var(--text-muted); padding: 20px;">No recent orders.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Active Users list -->
        <div class="card">
            <h3 class="card-title">Active Users</h3>
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
