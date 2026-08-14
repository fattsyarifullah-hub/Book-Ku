@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Create Book')

@section('content')
<div class="cr-wrapper">
    <div class="form-card">
        <form action="{{ route('dashboard.book.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div class="form-group">
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

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="string" name="author" id="author" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" required>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" required>
            </div>

            <div class="form-group">
                <button class="btn-primary" type="submit">
                    Simpan Data Buku
                </button>
            </div>
        </form>
    </div>
</div>
@endsection