<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'midtrans_transaction_id',
        'payment_type',
        'transaction_status',
        'fraud_status',
        'gross_amount',
        'transaction_time',
        'expiry_time',
        'raw_response'
    ];

    protected $casts = [
        'transaction_time' => 'datetime',
        'expiry_time' => 'datetime',
        'gross_amount' => 'decimal:2'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
    
    // function untuk ambil data user bayar pake apa
    public function getPaymentMethodLabelAttribute() : string {
        return match ($this->payment_type) {
            'bank_transfer' => 'Transfer Bank ( Virtual Account )',
            'gopay' => 'Gopay',
            'qris' => 'QRIS',
            'credit_card' => 'Kartu Kredit/Debit',
            'shoopepay' => 'ShoopePay',
            default => 'Belum Ditentukan'
        };
    }
}
