<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'phone_number', 'address'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // satu user bisa memiliki banyak order
    public function order() {
        return $this->hasMany(Order::class);
    }

    // mengakses buku apa yang di dalam cart melalui cart item
    public function cartbook() {
        return $this->belongsToMany(Book::class, 'cart_items')->withPivot('id', 'quantity')->withTimestamps();
    }

    // satu user bisa memiliki banyak cart item
    public function cartitem() {
        return $this->hasMany(CartItem::class);
    }
}
