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
        .product-image img {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 8px;
        }
        .product-info {
            flex: 1;
            padding: 20px;
        }
        .product-info h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .price {
            font-size: 24px;
            color: #28a745;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .quantity {
            display: flex;
            align-items: center;
        }
        .quantity label {
            margin-right: 10px;
        }
        .quantity input {
            width: 50px;
            text-align: center;
            font-size: 16px;
            margin: 0 10px;
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
</head>
<body>
    <div class="container">
        <div class="form-detailbenih">
            <div class="product-detail">
                <div class="product-image">
                    <img src="{{ asset('images/seed1.png') }}" alt="Benih Kangkung Bangkok F1">
                </div>
                <div class="product-info">
                    <h1>Benih Kangkung</h1>
                    <div class="price">Rp. 14.850</div>
                    <div class="quantity">
                        <label for="quantity"><strong>Stok:</strong> 75</label>
                    </div>
                    <div class="quantity">
                        <label for="quantity">Kuantitas</label>
                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                        <input type="number" class="form-control text-center" id="quantity" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
                    </div>
                    <div>
                        <a href="https://wa.me/08XXXXXXXXXX" class="btn btn-success btn-add">
                            <i class="fab fa-whatsapp"></i> Pesan Sekarang
                        </a>
            </div>
                </div>
            </div>
            <div class="product-section">
                <h3>Informasi Produk</h3>
                <div class="info-item">
                    <strong>Kategori</strong>
                    <p>Tagrinov Shop Official > Produk > Benih</p>
                </div>
                <div class="info-item">
                    <strong>Berat</strong>
                    <p>0.02 Kg</p>
                </div>
                <div class="info-item">
                    <strong>Dikirim dari</strong>
                    <p>Bogor Tengah, Kota Bogor (16124)</p>
                </div>
            </div>
            <div class="product-section">
                <h3>Deskripsi Produk</h3>
                <p>Benih Kangkung BANGKOK F1 adalah kangkung tipe daun lebar, cocok ditanam di dataran rendah sampai menengah. Produksi tinggi (450 – 500 ikat / Kg benih). Tahan penyakit Powdery Mildew / blorok pada daun. Tanaman vigor dan seragam. Batang kokoh lambat berbunga. Kangkung Bangkok LP-1 bisa dipanen pada umur 20 – 25 hst.</p>
            </div>
            <div class="product-section">
                <h3>Ulasan</h3>
                <p>Belum ada ulasan...</p>
            </div>
        </div>
    </div>
    
    <script>
        function increaseQuantity() {
            let quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        function decreaseQuantity() {
            let quantityInput = document.getElementById('quantity');
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }
    </script>
@endsection
