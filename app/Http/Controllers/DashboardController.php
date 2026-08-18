<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Order;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        $orderCount = Order::count();
        $orderlast = Order::latest()->take(10)->get();
        $userCount = User::count();
        $user = User::latest()->take(3)->get();
        $bookCount = Book::count();
        $categories = Category::count();

        return view('dashboard.dashboard', compact('bookCount', 'orderCount', 'orderlast', 'userCount', 'user', 'categories'));
    }


}
