<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class MidtransNotifController extends Controller
{
    public function handle(Request $request) {
        $payload = $request->all();

        $serverKey = config('midtrans.server_key');

        $expectedSignature = hash('sha512', $payload['order_id'] . $payload['status_code'] . $payload['gross_amount'] . $serverKey);

        if ($expectedSignature !== $payload['signature_key']) {
            Log::warning('Midtrans Signature tidak valid', $payload);
            return response()->json(['message' => 'Invalid Signature'], 403);
        }

        $order = Order::where('invoice_number', $payload['order_id'])->firstOrFail();

        $transactionStatus = $payload['transaction_status'];
        $fraudStatus = $payload['fraud_status'] ?? null;

        $payment = Payment::where('order_id', $order->id)->latest()->first();

        if ($payment) {
            $payment->update([
                'midtrans_transaction_id' => $payload['midtrans_transaction_id'] ?? null,
                'payment_type' => $payload['payment_type'] ?? null,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'transaction_time' => $payload['transaction_time'] ?? null,
                'expiry_time' => $payload['expiry_time'] ?? null,
                'raw_response' => json_encode($payload)
            ]);
        }

        if ($transactionStatus === 'settlement' || ($transactionStatus === 'capture' && $fraudStatus === 'accept')) {
            $order->status = 'processing';
            $order->save();
        }

        if (in_array($transactionStatus, ['cancel', 'deny', 'expire']) && is_null($order->stock_restored_at)) {
            foreach ($order->orderItem as $items) {
                $items->book->increment('stock', $items->quantity);
            }

            $order->stock_restored_at = now();
            $order->save();
        }

        return response()->json(['message' => 'ok']);
    }
}
