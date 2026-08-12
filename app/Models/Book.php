<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// model buku yang wajib memiliki kategori dan bisa diisi oleh banyak order item
class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'author',
        'stock',
        'price',
        'image',
    ];

    // satu buku wajib memiliki satu kategori
    public function Category() {
        return $this->belongsTo(Category::class);
    }

    // satu buku bisa dimiliki banyak order item
    public function orderitem() {
        return $this->hasMany(OrderItem::class);
    }
}
