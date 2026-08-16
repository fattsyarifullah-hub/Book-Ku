<?php
namespace App\Services;


use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService {
    

    // Config untuk midtrans
    public function __construct() {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    // Function untuk bikin token sesuai dengan data
    public function createSnapToken(Order $order) : string {
        // parameter yang diperlukan buat bikin token
        $params = [
            // detail transaksi ambil dari invoice dan jumlah ambil dari total harga
            'transaction_details' => [
                'order_id' => $order->invoice_number,
                'gross_amount' => (int) $order->total_price,
            ],

            // detail pembeli ambil dari data user
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone_number
            ],

            // detail item ambil dari relasi order item 
            'item_details' => $order->orderItem->map(function ($item) {
                return [
                    'id' => $item->book_id,
                    'price' => (int) $item->price,
                    'quantity' => $item->quantity,
                    'name' => $item->book->title
                ];
            })->toArray(),

            // set expired token setiap 5 menit
            'expiry' => [
                'unit' => 'minute',
                'duration' => 5,
            ],
        ];

        return Snap::getSnapToken($params);
    }
}