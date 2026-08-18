<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {   
        $cartItems = Auth::user()->cartItems()->with('book')->get();
        
        return view('main.cart.index', compact('cartItems'));
    }

    public function add(Request $request, CartItem $cartItem) {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())->where('book_id', $request->book_id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'book_id' => $request->book_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Item berhasil ditambahkan ke keranjang.'); 
    }

    public function update(Request $request, CartItem $cartItem) {

        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $book = $cartItem->book;
        if ($request->quantity > $book->stock) {
            return back()->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
        }

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Jumlah item berhasil diperbarui.');
    }

    public function destroy(CartItem $cartItem) {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function checkoutByCart(Request $request) {
        $request->validate([
            'selected' => 'required|array',
            'selected.*' => 'exists:cart_items,id'
        ]);

        $selectedItems = Auth::user()->cartItems()
        ->whereIn('id', $request->selected)
        ->with('book')
        ->get();

        if ($selectedItems->isEmpty()) {
            return back()->with('error', 'Tidak ada item yang dipilih untuk checkout.');
        }

        session(['checkout_items' => $selectedItems->map(function ($item) {
            return [
                'book_id' => $item->book_id,
                'quantity' => $item->quantity,
                'price' => $item->book->price,
                'title' => $item->book->title,
                'subtotal' => $item->quantity * $item->book->price
            ];
        })]);

        return redirect()->route('order.checkout');
    }
}
