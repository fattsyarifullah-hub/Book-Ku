@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Edit Book')

@section('content')
<div>
    <p>edit book page</p>

    <div>
        <form action="{{ route('dashboard.book.update', $editbook->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title"  value="{{ old('title', $editbook->title) }}">
            </div>

            <div>
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id">
                    <option value="{{ old('category_id', $editbook->category_id) }}">-- PILIH KATEGORI --</option>
                    @foreach ($category as $c)
                        <option value="{{ $c->id }}">
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" >{{ old('description', $editbook->description) }}</textarea>
            </div>

            <div>
                <label for="author">Author</label>
                <input type="text" name="author" id="author"  value="{{ old('author', $editbook->author) }}">
            </div>

            <div>
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock"  value="{{ old('stock', $editbook->stock) }}">
            </div>

            <div>
                <label for="price">Price</label>
                <input type="number" name="price" id="price"  value="{{ old('price', $editbook->price) }}">
            </div>

            <div>
                <label for="image">Image</label>
                <input type="file" name="image" id="image" value="{{ old('image', $editbook->image) }}">
            </div>

            <div>
                <button type="submit">
                    Edit Data Buku
                </button>
            </div>
        </form>
    </div>

</div>

@endsection