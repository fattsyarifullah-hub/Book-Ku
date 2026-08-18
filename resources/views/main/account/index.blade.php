<div>
    <a href="{{ route('customer.edit') }}">Setting Account</a>

    @foreach ($user as $items)
        <p>{{$items->invoice_number}}</p>
        <small>{{ \Carbon\Carbon::parse($items->order_date)->format('d-m-Y') }}</small>
        
    @endforeach
</div>
