<?php

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('customer order history page displays user history', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Fiction']);
    $book = Book::create([
        'category_id' => $category->id,
        'title' => 'Laravel for Beginners',
        'description' => 'A practical guide',
        'author' => 'Jane Doe',
        'stock' => 20,
        'price' => 120000,
        'image' => 'books/default.jpg',
    ]);

    $order = Order::create([
        'user_id' => $user->id,
        'invoice_number' => 'BK-2026-0001',
        'order_date' => now(),
        'total_price' => 240000,
        'address' => 'Jl. Merdeka No. 12',
        'status' => 'processing',
    ]);

    OrderItem::create([
        'order_id' => $order->id,
        'book_id' => $book->id,
        'quantity' => 2,
        'price' => 120000,
    ]);

    $response = $this
        ->actingAs($user)
        ->get('/history/account');

    $response
        ->assertOk()
        ->assertSee('Order History')
        ->assertSee('BK-2026-0001');
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'wrong-password',
        ]);

    $response
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect('/profile');

    $this->assertNotNull($user->fresh());
});
