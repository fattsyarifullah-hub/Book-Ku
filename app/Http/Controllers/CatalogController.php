<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class CatalogController extends Controller
{
    public function index(Request $request)
    {   
        $categories = Category::with('books')->get();

        $authors = Book::select('author')
        ->distinct()
        ->whereNotNull('author')
        ->pluck('author');

        $query = Book::with('category');

        // filter 1 berdasarkan kategori
        if ($request->has('categories') && is_array($request->categories)) {
            $query->whereIn('category_id', $request->categories);
        }

        // filter 2 berdasarkan author
        if ($request->has('authors') && is_array($request->authors)) {
            $query->whereIn('author', $request->authors);
        }

        if ($request->filled('price_range')) {
            match ($request->price_range) {
                'under_50' => $query->where('price', '<', 50000),
                '50_to_100' => $query->whereBetween('price', [50000, 100000]),
                'over_100' => $query->where('price', '>', 100000),
                default => null
            };
        }

        $books = $query->paginate(12)->withQueryString();

        return view('main.catalog.index', compact('categories', 'books', 'authors'));
    }

    public function show($id) {

    }
}
