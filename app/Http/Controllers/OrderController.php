<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() {
        $order = Order::all();
        return view('dashboard.order.index', compact('order'));
    }

    public function show(Order $order) {
    
        return view('dashboard.order.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order) {
        $newStatus = strtolower($request->status);

        $request->validate([
            'status' => 'required|in:pending,processing,completed',
        ]);

        $order->status = $newStatus;
        $order->save();

        return redirect()->back()->with('success', 'Status Order berhasil diperbarui.');
    }
}
