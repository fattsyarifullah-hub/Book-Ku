<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// model pivot antara book dan user
class CartItem extends Model
{
    protected $table = 'cart_items';
   
    // satu cart item wajib memiliki satu user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // satu cart item wajib memiliki satu buku 
    public function book() {
        return $this->belongsTo(Book::class);
    }
}
