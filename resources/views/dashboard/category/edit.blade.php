@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Category Edit')

@section('content')
<div class="cr-wrapper">
    <div class="form-card">
        <form action="{{ route('dashboard.category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}">
            </div>

            <div class="form-group">
                <button class="btn-primary" type="submit">Edit Kategori</button>
            </div>
        </form>
    </div>
</div>
@endsection