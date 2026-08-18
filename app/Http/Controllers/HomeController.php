<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request) {

        $startDate = Carbon::now()->subDays(30);
        $date = Carbon::now()->format('F');

        $bestSeller = DB::table('order_items')
        ->join('orders', 'orders.id', '=', 'order_items.order_id')
        ->join('books', 'books.id', '=', 'order_items.book_id')
        ->select(
            'books.id',
            'books.title',
            'books.author',
            'books.price',
            'books.image',
            DB::raw('SUM(order_items.quantity) as total_sold')
        )
        ->where('orders.order_date', '>=', $startDate)
        ->whereIn('orders.status', ['processing', 'completed'])
        ->groupBy('books.id', 'books.title', 'books.author', 'books.price', 'books.image')
        ->orderByDesc('total_sold')
        ->take(1)
        ->get();

        return view('main.index', compact('date', 'bestSeller'));
    }
}
