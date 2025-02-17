@extends('layouts.main')
@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-detailbenih {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            margin-top: 100px;
        }
        .product-detail {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .product-image {
            max-width: 300px;
            width: 100%;
        }
        .product-image img {
            width: 100%;
            max-width: 300px; /* Atur sesuai kebutuhan */
            max-height: 300px; /* Atur sesuai kebutuhan */
            object-fit: cover; /* Memastikan gambar tetap proporsional */
            border-radius: 8px;
        }
        .swiper {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .swiper-slide img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .swiper-button-prev,
        .swiper-button-next {
            color: #007bff;
        }
        .swiper-pagination-bullet-active {
            background-color: #007bff;
        }
        .product-info {
            flex: 1;
            padding: 20px 0px 0px 20px;
        }
        .product-info h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .price {
            font-size: 24px;
            color: #28a745;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .btn {
            margin: 8px 0;
            cursor: pointer;
            font-size: 16px;
        }
        .product-section {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .product-section h3 {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
        }
        .product-section .info-item {
            display: flex;
            align-items: baseline;
            margin-bottom: 5px;
        }
        .product-section .info-item strong {
            min-width: 200px;
        }
        
    </style>

    <div class="container">
        <div class="form-detailbenih">
            <div class="product-detail">
                <div class="product-image">
                    @if($benih->url_gambar)
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach(json_decode($benih->url_gambar) as $gambar)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $gambar) }}" alt="{{ $benih->nama }}">
                                    </div>
                                @endforeach
                            </div>
                            <!-- Tambahkan navigasi -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <!-- Tambahkan pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    @endif
                </div>

                <div class="product-info">
                    <h1>Benih {{ $benih->nama }}</h1>
                    <div class="price">Rp{{ number_format($benih->harga, 0, ',', '.') }}</div>
                    <div class="quantity">
                        <label>{{ $benih->deskripsi }}</label>
                    </div>
                </div>
            </div>

            <div class="product-section">
                <h3 style="margin-top: 0px;">Informasi Produk</h3>
                <div class="info-item">
                    <strong>Stok</strong>
                    <p>{{ $benih->stok }}</p>
                </div>
                <div class="info-item">
                    <strong>Netto</strong>
                    <p>{{ $benih->netto }} gr</p>
                </div>
                <div class="info-item">
                    <strong>Lokasi barang</strong>
                    <p>{{ $benih->lokasi }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SwiperJS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
@endsection
