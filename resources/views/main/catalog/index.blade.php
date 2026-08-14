@extends('layouts.main')

@section('content')
    <aside>
        <form action="{{ route('catalog.index') }}" method="GET" id="filterForm">
            <div class="filter-category">
                <h2>Filter berdasarkan kategori</h2>
                @foreach ($categories as $category)
                    <label for="">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" onchange="this.form.submit()"
                            {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                        <span>{{ $category->name }}</span>
                        <span>({{ $category->books_count }})</span>
                    </label>
                @endforeach
            </div>

            <div class="filter-author">
                <h2>Filter berdasarkan penulis</h2>
                <div class="form-search">
                    <div class="input-search">
                        <input type="text" name="search_author" value="{{ request('author') }}">
                    </div>
                    <button type="submit">Search</button>
                    <div class="reset">
                        <a href="{{ route('catalog.index') }}">
                            reset
                        </a>
                    </div>
                </div>
            </div>


            <div class="price-range">
                <label for="">
                    <input type="radio" name="price_range" value="under_50" onchange="this.form.submit()"
                        {{ request('price_range') === 'under_50' ? 'checked' : '' }}>
                    <span>Under 50 Ribu</span>
                </label>
            </div>

            <div class="price-range">
                <label for="">
                    <input type="radio" name="price_range" value="50_to_100" onchange="this.form.submit()"
                        {{ request('price_range') === '50_to_100' ? 'checked' : '' }}>
                    <span>50 - 100 Ribu</span>
                </label>
            </div>

            <div class="price-range">
                <label for="">
                    <input type="radio" name="price_range" value="over_100" onchange="this.form.submit()"
                        {{ request('price_range') === 'over_100' ? 'checked' : '' }}>
                    <span>Diatas 100 ribu</span>
                </label>
            </div>

            <div class="clear-filter">
                <a href="{{ route('catalog.index') }}">
                    Clear Filters
                </a>
            </div>
        </form>
    </aside>

    <main>
        <h1>katalog buku ({{ $books->total() }})</h1>

        @if ($books->isEmpty())
            <div class="">
                tidak ada buku yang sesuai dengan filter ini
            </div>
        @else
            @foreach ($books as $book)
                <div class="book">
                    <a href="{{ route('catalog.show', $book->id) }}">
                        <img src="{{ asset('storage/imagebook/' . $book->image) }}" alt="{{ $book->title }}">
                        <h2>{{ $book->title }}</h2>
                        <p>kategori : {{ $book->category->name ?? '-' }}</p>
                        <p>Penulis : {{ $book->author }}</p>
                        <p>Harga : {{ Number::currency($book->price, 'IDR', 'id', precision: 0) }}</p>
                    </a>
                </div>
            @endforeach
        @endif

        <div class="paginate-link">
            {{ $books->links() }}
        </div>
    </main>
@endsection
