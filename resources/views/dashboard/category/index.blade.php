@extends('layouts.dashboard')
@section('title', 'Category Management')
@section('page-title', 'Category Management')

@section('content')
<div class="cm-wrapper">
    {{-- Category Grid --}}
    <div class="cm-grid">
        @forelse ($allcategory as $c)
        <div class="cm-card" data-search="{{ strtolower($c->name) }}">
            {{-- Card Top: name + book count badge --}}
            <div class="cm-card-top">
                <h2 class="cm-card-name">{{ $c->name }}</h2>
                <span class="cm-books-badge">
                    {{ $c->books_count }} {{ $c->books_count === 1 ? 'Book' : 'Books' }}
                </span>
            </div>

            {{-- Books list preview --}}
            <div class="cm-books-preview">
                @forelse ($c->books->take(3) as $book)
                    <span class="cm-book-chip">{{ $book->title }}</span>
                @empty
                    <span class="cm-empty-note">No books yet</span>
                @endforelse
                @if ($c->books->count() > 3)
                    <span class="cm-book-chip cm-book-chip-more">+{{ $c->books->count() - 3 }} more</span>
                @endif
            </div>

            {{-- Actions --}}
            <div class="cm-card-footer">
                <a id="cm-{{ $c->id }}" href="{{ route('dashboard.category.show', $c->id) }}" class="cm-action-link cm-action-view">Detail</a>
                <a id="cm-edit-{{ $c->id }}" href="{{ route('dashboard.category.edit', $c->id) }}" class="cm-action-link cm-action-edit">Edit</a>
                <form action="{{ route('dashboard.category.destroy', $c->id) }}" method="POST"
                    onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button id="cm-delete-{{ $c->id }}" type="submit" class="cm-action-link cm-action-delete">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <div class="cm-empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48">
                <rect x="3" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/>
                <rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            <p>Belum ada kategori</p>
            <a href="{{ route('dashboard.category.create') }}" class="cm-btn-primary" style="margin-top: 12px;">Tambah Kategori</a>
        </div>
        @endforelse
    </div>

</div>
@endsection