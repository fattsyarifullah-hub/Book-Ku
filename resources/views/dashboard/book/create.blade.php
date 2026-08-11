@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Create Book')

@section('content')
<div>
    <form action="{{ route('dashboard.book.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id">
                <option value="">-- PILIH KATEGORI --</option>
                @foreach ($category as $c)
                    <option value="{{ $c->id }}">
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" required></textarea>
        </div>

        <div>
            <label for="author">Author</label>
            <input type="string" name="author" id="author" required>
        </div>

        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" required>
        </div>

        <div>
            <label for="price">Price</label>
            <input type="number" name="price" id="price" required>
        </div>

        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image" required>
        </div>

        <div>
            <button type="submit">
                Simpan Data Buku
            </button>
        </div>
    </form>
</div>

@endsection