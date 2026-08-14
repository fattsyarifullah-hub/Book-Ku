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

        if(session()->has('checkout_items')) {
            $items = session('checkout_items');
            $total = collect($items)->sum('subtotal');
            $address = Auth::user()->address ?? '';

            return view('main.orderCustomer.checkout', compact('items', 'total', 'address'));
        }

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $book = Book::findOrFail($request->book_id);
        $quantity = $request->quantity;
        $total = $book->price * $quantity;

        $user = Auth::user();
        $address = $user->address ?? '';

        $items = [
            [
                'book_id' => $book->id,
                'title' => $book->title,
                'quantity' => $quantity,
                'price' => $book->price,
                'subtotal' => $total
            ]
        ];

        return view('main.orderCustomer.checkout', compact('items', 'total', 'address'));
    } 

    public function store(Request $request) {
        $request->validate([
            'address' => 'required|string'
        ]);

        $items = session('checkout_items');

        if (!$items || empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk checkout.');
        }

        $total = collect($items)->sum('subtotal');
        
        
        $invoice = 'INV-' . mt_rand(1000, 9999) .strtoupper(Str::random(10));

        $order = Order::create([
            'user_id' => Auth::id(),
            'invoice_number' => $invoice,
            'order_date' => now(),
            'total_price' => $total,
            'address' => $request->address,
            'status' => 'pending'
        ]);

        foreach ($items as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item['book_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
            
            $book = Book::find($item['book_id']);
            if ($book) {
                $book->decrement('stock', $item['quantity']);
            }
        }

        session()->forget('checkout_items');

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
