<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// model untuk kategori yang harus diisi oleh buku
class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    // satu kategori bisa memiliki banyak buku
    public function books() {
        return $this->hasMany(Book::class);
    }
}
