@extends('layouts.dashboard')
@section('title', 'Book Detail')
@section('page-title', 'Book Detail')

@section('content')
<div class="bs-wrapper">

    {{-- Back Button --}}
    <div class="bs-back">
        <a href="{{ route('dashboard.book.index') }}" class="bs-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Back to Books
        </a>
    </div>

    {{-- Main Detail Card --}}
    <div class="bs-card">

        {{-- Book Cover --}}
        <div class="bs-cover-col">
            <div class="bs-cover-wrap">
                <img class="bs-cover-img"
                    src="{{ asset('storage/imagebook/' . $book->image) }}"
                    alt="{{ $book->title }}">
            </div>

            {{-- Action Buttons --}}
            <div class="bs-btn-group">
                <a id="bs-edit-btn" href="{{ route('dashboard.book.edit', $book->id) }}" class="bs-btn bs-btn-edit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    Edit Book
                </a>
                <form id="bs-delete-form" action="{{ route('dashboard.book.destroy', $book->id) }}" method="POST"
                    onsubmit="return confirm('Yakin hapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button id="bs-delete-btn" type="submit" class="bs-btn bs-btn-delete">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                            <path d="M10 11v6"/><path d="M14 11v6"/>
                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        {{-- Book Info --}}
        <div class="bs-info-col">

            {{-- Category Badge --}}
            <div class="bs-category-badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                    <line x1="7" y1="7" x2="7.01" y2="7"/>
                </svg>
                {{ $book->Category->name ?? 'Uncategorized' }}
            </div>

            {{-- Title & Author --}}
            <h1 class="bs-title">{{ $book->title }}</h1>
            <p class="bs-author">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                {{ $book->author }}
            </p>

            {{-- Divider --}}
            <div class="bs-divider"></div>

            {{-- Stats Row --}}
            <div class="bs-stats-row">
                <div class="bs-stat-item">
                    <div class="bs-stat-label">Price</div>
                    <div class="bs-stat-value bs-stat-price">
                        Rp {{ number_format($book->price, 0, ',', '.') }}
                    </div>
                </div>
                <div class="bs-stat-sep"></div>
                <div class="bs-stat-item">
                    <div class="bs-stat-label">Stock</div>
                    <div class="bs-stat-value {{ $book->stock <= 10 ? 'bs-stat-low' : '' }}">
                        {{ $book->stock }}
                        <span class="bs-stat-unit">units</span>
                        @if ($book->stock <= 10)
                            <span class="bs-badge-low">Low Stock</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Divider --}}
            <div class="bs-divider"></div>

            {{-- Description --}}
            <div class="bs-section">
                <div class="bs-section-label">Description</div>
                <p class="bs-description">{{ $book->description }}</p>
            </div>

            {{-- Meta --}}
            <div class="bs-meta-row">
                <div class="bs-meta-item">
                    <span class="bs-meta-label">Added</span>
                    <span class="bs-meta-value">{{ $book->created_at->format('d M Y') }}</span>
                </div>
                <div class="bs-meta-item">
                    <span class="bs-meta-label">Updated</span>
                    <span class="bs-meta-value">{{ $book->updated_at->format('d M Y') }}</span>
                </div>
            </div>

        </div>
    </div>

</div>

<style>
/* ===== Book Show / Detail Page ===== */
.bs-wrapper {
    padding: 24px 32px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    max-width: 960px;
}

/* Back Link */
.bs-back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.2s;
}

.bs-back-link:hover {
    color: var(--primary);
}

/* Main Card */
.bs-card {
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: 16px;
    display: flex;
    gap: 40px;
    padding: 36px;
    overflow: hidden;
}

/* Cover Column */
.bs-cover-col {
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.bs-cover-wrap {
    width: 200px;
    height: 280px;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: 0 8px 24px rgba(0,0,0,0.10);
    background: var(--bg-body);
}

.bs-cover-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Button Group */
.bs-btn-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;
}

.bs-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 9px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    border: none;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
    width: 100%;
    text-align: center;
}

.bs-btn-edit {
    background: var(--primary-light);
    color: var(--primary);
}

.bs-btn-edit:hover {
    background: var(--primary);
    color: #fff;
    transform: translateY(-1px);
}

.bs-btn-delete {
    background: var(--danger-bg);
    color: var(--danger);
}

.bs-btn-delete:hover {
    background: var(--danger);
    color: #fff;
    transform: translateY(-1px);
}

.bs-btn-group form {
    width: 100%;
    display: flex;
}

/* Info Column */
.bs-info-col {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* Category Badge */
.bs-category-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: var(--primary-light);
    color: var(--primary);
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    width: fit-content;
    margin-bottom: 14px;
}

/* Title & Author */
.bs-title {
    font-size: 26px;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.3;
    margin-bottom: 8px;
}

.bs-author {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    color: var(--text-secondary);
    margin-bottom: 0;
}

/* Divider */
.bs-divider {
    height: 1px;
    background: var(--border-light);
    margin: 20px 0;
}

/* Stats */
.bs-stats-row {
    display: flex;
    align-items: center;
    gap: 0;
}

.bs-stat-sep {
    width: 1px;
    height: 48px;
    background: var(--border-light);
    margin: 0 28px;
}

.bs-stat-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.bs-stat-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
}

.bs-stat-value {
    font-size: 22px;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: baseline;
    gap: 6px;
}

.bs-stat-price {
    color: var(--primary);
}

.bs-stat-low {
    color: var(--danger);
}

.bs-stat-unit {
    font-size: 13px;
    font-weight: 400;
    color: var(--text-muted);
}

.bs-badge-low {
    font-size: 10px;
    font-weight: 600;
    background: var(--danger-bg);
    color: var(--danger);
    padding: 3px 8px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    align-self: center;
}

/* Description Section */
.bs-section-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
    margin-bottom: 10px;
}

.bs-description {
    font-size: 14px;
    color: var(--text-secondary);
    line-height: 1.7;
}

/* Meta */
.bs-meta-row {
    margin-top: 20px;
    display: flex;
    gap: 24px;
}

.bs-meta-item {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.bs-meta-label {
    font-size: 11px;
    color: var(--text-muted);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

.bs-meta-value {
    font-size: 13px;
    font-weight: 500;
    color: var(--text-secondary);
}

/* Responsive */
@media (max-width: 720px) {
    .bs-card {
        flex-direction: column;
        align-items: center;
        padding: 24px;
        gap: 24px;
    }
    .bs-cover-col {
        width: 100%;
    }
    .bs-cover-wrap {
        width: 160px;
        height: 220px;
    }
    .bs-btn-group {
        flex-direction: row;
    }
    .bs-title {
        font-size: 22px;
    }
}
</style>
@endsection