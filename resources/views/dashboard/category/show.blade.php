@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Category')

@section('content')
<div class="bm-wrapper">
    <div class="bm-card">
        <div class="bm-table-wrapper">
            <table class="bm-table">
                <thead>
                    <tr>
                        <th class="bm-th"><strong>Judul</strong></th>
                        <th class="bm-th"><strong>Penulis</strong></th>
                        <th class="bm-th"><strong>Stok</strong></th>
                    </tr>
                </thead>
                <tbody>
                @if ($category->books->isEmpty())
                <tr class="bm-tr">
                    <td class="bm-td">
                        <p>belum ada buku di kategori ini</p>
                    </td>
                </tr>
                @else
                @foreach ($category->books as $book)
                <tr class="bm-tr" data-search="{{ strtolower($book->title . ' ' . $book->author . ' ' . $book->stock) }}">
                    <td class="bm-td"><h3>{{ $book->title }}</h3></td>
                    <td class="bm-td"><p>{{ $book->author }}</p></td>
                    <td class="bm-td"><p>{{ $book->stock }}</p></td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection