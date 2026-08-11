@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Users Overview')

@section('content')
<form action="{{ route('dashboard.category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">name</label>
        <input type="text" name="name" id="name" required>
    </div>
    <button type="submit">Create</button>
</form>

@endsection