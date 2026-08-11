<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// model pivot antara order dan book 
class OrderItem extends Model
{
    protected $table = 'order_items';

    // satu order item wajib memiliki satu order
    public function order() {
        return $this->belongsTo(Order::class);
    }

    // satu order item wajib memiliki satu buku
    public function book() {
        return $this->belongsTo(Book::class);
    }
}
