@extends('layouts.main')

@section('title', 'Book-Ku | Home')

@section('content')
    {{-- HERO --}}
    <section class="home-hero">
        <div class="home-container hero-content">
            <div class="hero-text">
                <span class="hero-badge">
                    <i class="bi bi-stars"></i>
                    Selamat datang di Book-Ku
                </span>
                <h1>
                    Temukan Buku yang
                    <span>Menemani Ceritamu.</span>
                </h1>
                <p>
                    Jelajahi koleksi buku pilihan kami dan temukan
                    bacaan yang cocok untuk menemani setiap perjalananmu.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('catalog.index') }}" class="hero-button">
                        Jelajahi Buku
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="#best-seller" class="hero-secondary">
                        Lihat Best Seller
                    </a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-circle"></div>
                <div class="floating-book book-one">
                    <i class="bi bi-book"></i>
                </div>
                <div class="floating-book book-two">
                    <i class="bi bi-book-half"></i>
                </div>
                <div class="hero-book">
                    <i class="bi bi-book"></i>
                    <span>BOOK<br>KU</span>
                </div>
            </div>
        </div>
    </section>

    {{-- BEST SELLER --}}
    <section class="best-section" id="best-seller">
        <div class="home-container">
            <div class="section-heading">
                <div>
                    <span class="section-label">
                        Pilihan pembaca
                    </span>
                    <h2>
                        Buku Terlaris
                    </h2>
                    <p>
                        Buku yang paling banyak diminati bulan ini.
                    </p>
                </div>
                <a href="{{ route('catalog.index') }}" class="view-all">
                    Lihat semua
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="book-grid">
                @forelse ($bestSeller as $item)
                    <article class="book-card">
                        <div class="book-image">
                            <img
                                src="{{ asset('storage/imagebook/' . $item->image) }}"
                                alt="{{ $item->title }}"
                            >
                            <span class="book-badge">
                                #{{ $loop->iteration }}
                            </span>
                        </div>
                        <div class="book-info">
                            <h3>
                                {{ $item->title }}
                            </h3>
                            <p class="book-author">
                                {{ $item->author }}
                            </p>
                            <div class="book-bottom">
                                <div>
                                    <span class="book-price">
                                        {{ Number::currency($item->price, 'IDR', 'id', precision:0) }}
                                    </span>
                                    <small>
                                        {{ $item->total_sold }} terjual
                                    </small>
                                </div>
                                <a
                                    href="{{ route('catalog.index') }}"
                                    class="book-cart"
                                    aria-label="Lihat buku"
                                >
                                    <i class="bi bi-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="empty-books">
                        <i class="bi bi-book"></i>
                        <h3>
                            Belum ada buku terlaris
                        </h3>
                        <p>
                            Koleksi buku akan muncul di sini.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- WHY BOOK-KU --}}
    <section class="why-section">
        <div class="home-container">
            <div class="why-heading">
                <span class="section-label">
                    Kenapa Book-Ku?
                </span>
                <h2>
                    Belanja buku jadi lebih menyenangkan.
                </h2>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <h3>
                        Koleksi Pilihan
                    </h3>
                    <p>
                        Temukan berbagai macam buku dari
                        berbagai genre dan kategori.
                    </p>
                </div>

                <div class="why-card">
                    <h3>
                        Pengiriman Mudah
                    </h3>
                    <p>
                        Pesananmu diproses dengan cepat
                        dan siap dikirim ke tempatmu.
                    </p>
                </div>

                <div class="why-card">
                    <h3>
                        Belanja Aman
                    </h3>
                    <p>
                        Nikmati pengalaman berbelanja buku
                        yang nyaman dan terpercaya.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection