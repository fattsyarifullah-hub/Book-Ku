@extends('layouts.main')

@section('content')

    <div class="catalog-page">

        <div class="catalog-layout">
            {{-- SIDE FILTER --}}
            <aside class="catalog-sidebar">

                <form action="{{ route('catalog.index') }}" method="GET" id="filterForm">

                    {{-- Category --}}
                    <div class="filter-box">

                        <h2 class="filter-title">
                            Genre Utama
                        </h2>

                        <div class="category-list">
                            <label class="category-item">
                                <input type="checkbox" name="categories[]" value="" onchange="this.form.submit()">
                                <span>Semua Kategori</span>
                            </label>

                            @foreach ($categories as $category)
                                <label class="category-item">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        onchange="this.form.submit()"
                                        {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>

                                    <span>
                                        {{ $category->name }}
                                    </span>

                                    <span class="category-count">
                                        {{ $category->books_count }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Author --}}
                    <div class="filter-box">
                        <h2 class="filter-title">
                            Penulis
                        </h2>

                        <div class="author-search">
                            <input type="text" name="search_author" value="{{ request('search_author') }}"
                                placeholder="Cari penulis...">
                            <div class="author-buttons">
                                <button type="submit">
                                    Search
                                </button>

                                <a href="{{ route('catalog.index') }}">
                                    Reset
                                </a>

                            </div>

                        </div>

                    </div>

                    {{-- Price --}}
                    <div class="filter-box">
                        <h2 class="filter-title">
                            Rentang Harga
                        </h2>

                        <div class="price-list">
                            <label class="price-item">
                                <input type="radio" name="price_range" value="under_50" onchange="this.form.submit()"
                                    {{ request('price_range') === 'under_50' ? 'checked' : '' }}>
                                <span>
                                    Dibawah Rp50.000
                                </span>

                            </label>

                            <label class="price-item">
                                <input type="radio" name="price_range" value="50_to_100" onchange="this.form.submit()"
                                    {{ request('price_range') === '50_to_100' ? 'checked' : '' }}>
                                <span>
                                    Rp50.000 - Rp100.000
                                </span>

                            </label>

                            <label class="price-item">
                                <input type="radio" name="price_range" value="over_100" onchange="this.form.submit()"
                                    {{ request('price_range') === 'over_100' ? 'checked' : '' }}>

                                <span>Di atas Rp100.000

                                </span>
                            </label>
                        </div>
                    </div>

                    {{-- CLEAR FILTER --}}
                    <div class="clear-filter">

                        <a href="{{ route('catalog.index') }}">
                            Clear All Filters
                        </a>

                    </div>

                </form>

            </aside>

            {{-- CATALOG --}}
            <main class="catalog-content">
                {{-- Header --}}
                <div class="catalog-header">

                    <div class="catalog-heading">

                        <h1>
                            Katalog Buku
                        </h1>

                        <p>
                            Menampilkan
                            {{ $books->firstItem() ?? 0 }}-{{ $books->lastItem() ?? 0 }}
                            dari
                            {{ $books->total() }}
                            buku
                        </p>

                    </div>

                    <div class="catalog-sort">
                        <span>
                            Urutkan:
                        </span>

                        <select>
                            <option>
                                Terpopuler
                            </option>

                            <option>
                                Harga Terendah
                            </option>

                            <option>
                                Harga Tertinggi
                            </option>

                            <option>
                                Terbaru
                            </option>
                        </select>

                    </div>

                </div>

                {{-- Books --}}
                @if ($books->isEmpty())
                    <div class="empty-books">
                        Tidak ada buku yang sesuai filter ini.
                    </div>
                @else
                    <div class="book-grid">
                        @foreach ($books as $book)
                            <article class="book-card">
                                <a href="{{ route('catalog.show', $book->id) }}"
                                    style="text-decoration: none; color: inherit;">

                                    {{-- Image --}}
                                    <div class="book-image">

                                        <img src="{{ asset('storage/imagebook/' . $book->image) }}"
                                            alt="{{ $book->title }}">

                                    </div>

                                    {{-- Info --}}
                                    <div class="book-info">

                                        <h2 class="book-title">
                                            {{ $book->title }}
                                        </h2>

                                        <p class="book-author">
                                            {{ $book->category->name }}
                                        </p>

                                        <p class="book-author">
                                            {{ $book->author }}
                                        </p>

                                        {{-- FOOTER --}}
                                        <div class="book-footer">
                                            <p class="book-price">
                                                {{ Number::currency($book->price, 'IDR', 'id', precision: 0) }}
                                            </p>


                                        </div>

                                    </div>

                                </a>

                            </article>
                        @endforeach
                    </div>
                @endif

                {{-- PAGINATION --}}
                <div class="catalog-pagination">

                    {{ $books->withQueryString()->links() }}

                </div>

            </main>

        </div>

    </div>
@endsection
