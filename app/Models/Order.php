<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// model yang wajib diisi oleh user dan bisa banyak order item 
class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id', 'invoice_number', 'order_date', 'total_price', 'address', 'status'];

    // satu order wajib memiliki satu user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // satu order bisa memiliki banyak order item
    public function item() {
        return $this->hasMany(OrderItem::class);
    }


}

