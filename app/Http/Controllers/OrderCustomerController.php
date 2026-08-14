<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Book;
use Carbon\Carbon;

class OrderCustomerController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $book = Book::findOrFail($request->book_id);
        $quantity = $request->quantity;
        $total = $book->price * $quantity;

        $user = Auth::user();
        $address = $user->address ?? '';

        return view('main.orderCustomer.checkout', compact('book', 'quantity', 'total', 'address'));
    } 

    public function store(Request $request) {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string'
        ]);

        $book = Book::findOrFail($request->book_id);
        $total = $book->price * $request->quantity;
        
        $invoice = 'INV-' . mt_rand(1000, 9999) .strtoupper(Str::random(10));

        $order = Order::create([
            'user_id' => Auth::id(),
            'invoice_number' => $invoice,
            'order_date' => now(),
            'total_price' => $total,
            'address' => $request->address,
            'status' => 'pending'
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $order->id,
            'quantity' => $request->quantity,
            'price' => $book->price,
        ]);

        $book->decrement('stock', $request->quantity);

        return redirect()->route('order.invoice', $order->id);
    }

    public function invoice(Order $order) {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'data tidak diorder');
        }

        $strDate = Carbon::parse($order->order_date)->format('d M Y H:i');

        $order->load('item.book');
        return view('main.orderCustomer.invoice', compact('order', 'strDate'));
    }
}
