@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Orders Management')

@section('content')
<div class="bm-wrapper">
    <div class="bm-card">
        <div class="bm-table-wrapper">
            <table class="bm-table">
                <thead>
                    <th class="bm-th">Invoice Number</th>
                    <th class="bm-th">User</th>
                    <th class="bm-th">Order Date</th>
                    <th class="bm-th">Total Price</th>
                    <th class="bm-th">Address</th>
                    <th class="bm-th">Status</th>
                    <th class="bm-th">Action</th>
                </thead>
                <tbody>
                    @foreach ($order as $list)
                    <tr>
                        <td class="bm-td">
                            <h3>{{$list->invoice_number}}</h3>
                        </td>
                        <td class="bm-td">
                            <p>{{$list->user->name}}</p>
                        </td>
                        <td class="bm-td">
                            <p>{{\Carbon\Carbon::parse($list->order_date)->format('d-m-Y')}}</p>
                        </td>
                        <td class="bm-td">
                            <p>{{ Number::currency($list->total_price, 'IDR', 'id', precision:0)}}</p>
                        </td>
                        <td class="bm-td">
                            <p>{{$list->address}}</p>
                        </td>
                        <td class="bm-td">
                            <form action="{{ route('dashboard.order.updateStatus', $list->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" id="" onchange="this.form.submit()">
                                    <option value="pending" {{ strtolower($list->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ strtolower($list->status) === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ strtolower($list->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                        </td>
                        <td class="bm-td">
                            <a class="bm-action-btn bm-action-view" href="{{ route('dashboard.order.show', $list->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>    

@endsection