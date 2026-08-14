@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Users Overview')

@section('content')
<div class="cr-wrapper">
    <div class="form-card">
        <form action="{{ route('dashboard.category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <button class="btn-primary" type="submit">Tambah Kategori</button>
            </div>
        </form>
    </div>
</div>
@endsection