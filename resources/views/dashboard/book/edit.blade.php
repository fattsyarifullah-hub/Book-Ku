@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Edit Book')

@section('content')
<div class="cr-wrapper">
    <div class="form-card">
        <form action="{{ route('dashboard.book.update', $editbook->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title"  value="{{ old('title', $editbook->title) }}">
            </div>

            <div class="form-group">
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

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" >{{ old('description', $editbook->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" id="author"  value="{{ old('author', $editbook->author) }}">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock"  value="{{ old('stock', $editbook->stock) }}">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price"  value="{{ old('price', $editbook->price) }}">
                </div>
            </div>

            <!-- poster lama -->
            <div class="form-group">
                <label>Gambar buku saat ini</label>
                @if(isset($editbook) && $editbook->image)
                    <img
                        src="{{ asset('storage/imagebook/' . $editbook->image) }}"
                        alt="Gambar buku"
                        class="current-poster">
                @else
                    <p class="no-image">
                        Buku ini belum memiliki gambar.
                    </p>
                @endif
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" value="{{ old('image', $editbook->image) }}">
                <small class="form-help">Kosongkan jika tidak ingin mengganti poster.</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-primary">
                    Edit Data Buku
                </button>
            </div>
        </form>
    </div>
</div>

@endsection