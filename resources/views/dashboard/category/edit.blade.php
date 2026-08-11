@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Category Edit')

@section('content')
<form action="{{ route('dashboard.category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}">
    </div>
    <button type="submit">Create</button>
</form>
@endsection