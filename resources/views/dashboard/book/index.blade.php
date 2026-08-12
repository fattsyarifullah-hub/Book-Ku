@extends('layouts.dashboard')
@section('title', 'Book Management')
@section('page-title', 'Book Management')

@section('content')
<div class="bm-wrapper">

    {{-- Header Bar --}}
    <div class="bm-header">
        <div class="bm-header-left">
            <div class="bm-search-box">
                <svg class="bm-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input id="bm-search-input" type="text" class="bm-search-input" placeholder="Search books by title, author...">
            </div>
        </div>
        <div class="bm-header-right">
            <a id="bm-add-book-btn" href="{{ route('dashboard.book.create') }}" class="bm-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="16" height="16">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Add Book
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bm-card">
        <div class="bm-table-wrapper">
            <table class="bm-table" id="bm-books-table">
                <thead>
                    <tr>
                        <th class="bm-th">Book Info</th>
                        <th class="bm-th">Category</th>
                        <th class="bm-th bm-th-right">Price</th>
                        <th class="bm-th bm-th-right">Stock</th>
                        <th class="bm-th bm-th-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allbook as $item)
                    <tr class="bm-tr" data-search="{{ strtolower($item->title . ' ' . $item->author) }}">
                        <td class="bm-td">
                            <div class="bm-book-info">
                                <div class="bm-book-img-wrap">
                                    <img class="bm-book-img"
                                        src="{{ asset('storage/imagebook/' . $item->image) }}"
                                        alt="{{ $item->title }}">
                                </div>
                                <div class="bm-book-meta">
                                    <div class="bm-book-title">{{ $item->title }}</div>
                                    <div class="bm-book-author">{{ $item->author }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="bm-td bm-td-muted">
                            {{ $item->Category->name ?? '-' }}
                        </td>
                        <td class="bm-td bm-td-right bm-price">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td class="bm-td bm-td-right">
                            @if ($item->stock <= 10)
                                <span class="bm-stock bm-stock-low">{{ $item->stock }} units</span>
                            @else
                                <span class="bm-stock">{{ $item->stock }} units</span>
                            @endif
                        </td>
                        <td class="bm-td bm-td-center">
                            <div class="bm-actions">
                                <a id="bm-detail-{{ $item->id }}" href="{{ route('dashboard.book.show', $item->id) }}" class="bm-action-btn bm-action-view" title="Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </a>
                                <a id="bm-edit-{{ $item->id }}" href="{{ route('dashboard.book.edit', $item->id) }}" class="bm-action-btn bm-action-edit" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('dashboard.book.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button id="bm-delete-{{ $item->id }}" type="submit" class="bm-action-btn bm-action-delete" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                            <path d="M10 11v6"/><path d="M14 11v6"/>
                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="bm-empty">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                            </svg>
                            <p>Belum ada buku</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('bm-search-input').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#bm-books-table tbody tr[data-search]').forEach(function (row) {
        row.style.display = row.dataset.search.includes(q) ? '' : 'none';
    });
});
</script>
@endsection
