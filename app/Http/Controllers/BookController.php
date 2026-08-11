<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $allbook = Book::all();
        return view('dashboard.book.index', compact('allbook'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $category = Category::all();
        return view('dashboard.book.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', 
            'description' => 'required|string',
            'author'      => 'required|string|max:255',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Jika upload file gambar
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $hashImage = $image->hashName();
            $image->storeAs('imagebook', $hashImage, 'public');
        }

        
        Book::create([
            'title'       => $request->title,
            'category_id' => $request->category_id, // Menyimpan ID kategori
            'description' => $request->description,
            'author'      => $request->author,
            'stock'       => $request->stock,
            'price'       => $request->price,
            'image'       => $hashImage,
        ]);

        return redirect()->route('dashboard.book.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('dashboard.book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $category = Category::all();
        $editbook = Book::findOrFail($id);
        return view('dashboard.book.edit', compact('editbook', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $editbook = Book::findOrFail($id);

        $request->validate([
            'title' => 'max:1000|string',
            'category_id' => 'exists:categories,id',
            'description' => 'max:1000|string',
            'author' => 'max:255|string',
            'stock' => 'integer|min:0',
            'price' => 'numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Jika upload file gambar
        ]);

        if ($request->hasFile('image')) {
            if ($editbook->image) {
                Storage::delete('public/image/' . $editbook->image);
            }

            $image = $request->file('image');
            $hashImage = $image->hashName();
            $image->storeAs('imagebook', $hashImage, 'public');

            $editbook->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'author' => $request->author,
                'stock' => $request->stock,
                'price' => $request->price,
                'image' => $hashImage,
            ]); 
        } else {
            $editbook->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'author' => $request->author,
                'stock' => $request->stock,
                'price' => $request->price,
            ]);
        }

        return redirect()->route('dashboard.book.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletebook = Book::findOrFail($id);
        $deletebook->delete();

        $deletebook->image; // Ambil nama file gambar sebelum dihapus
        if ($deletebook->image) {
            Storage::delete('public/imagebook/' . $deletebook->image);
        }

        return redirect()->route('dashboard.book.index');
    }
}
