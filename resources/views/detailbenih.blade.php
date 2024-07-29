<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f5f5f5;
        }
        header {
            background-color: #000;
            opacity: 50%;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header img {
            vertical-align: middle;
        }
        nav {
            flex-grow: 1;
            text-align: center;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-weight: 500;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            text-align: left;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .product-detail {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .product-image {
            flex: 1;
            text-align: center;
        }
        .product-image img {
            width: 100%;
            max-width: 400px;
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
            margin-bottom: 20px;
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
            display: inline-block;
            padding: 10px 20px;
            margin: 5px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-add {
            background-color: #28a745;
            color: white;
            margin-right: 10px;
        }
        .btn-buy {
            background-color: #17a2b8;
            color: white;
        }
        .btn-store {
            background-color: #ff5722;
            color: white;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            margin: 5px 0;
            text-decoration: none;
            display: inline-block;
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
        footer {
            background-color: #009144;
            color: white;
            padding: 20px;
            text-align: center;
        }
        footer .contact-info, footer .map {
            display: inline-block;
            vertical-align: top;
            margin: 0 20px;
        }
        footer .contact-info {
            text-align: left;
        }
        footer .map iframe {
            border: 0;
            width: 450px;
            height: 250px;
            border-radius: 8px;
        }
        footer a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="60">
        <nav>
            <a href="{{ url('/') }}">Beranda</a>
            <div class="dropdown">
                <a href="#">Produk</a>
                <div class="dropdown-content">
                    <a href="{{ url('/stokbenih') }}">Stok Benih</a>
                    <a href="{{ url('/tanaman') }}">Tanaman</a>
                </div>
            </div>
            <a href="#">Permohonan</a>
            <a href="{{ url('/kunjungan') }}">Pelaporan</a>
        </nav>
        <img src="{{ asset('images/id_flag.png') }}" alt="Indonesian Flag" height="15">
    </header>
    <div class="container">
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
                    <button onclick="decreaseQuantity()">-</button>
                    <input type="number" id="quantity" value="1" min="1">
                    <button onclick="increaseQuantity()">+</button>
                </div>
                <div>
                    <button class="btn btn-add">+ Tambahkan</button>
                    <button class="btn btn-buy">Beli Sekarang</button>
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
    <footer>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.8860998470195!2d106.7875092695418!3d-6.579033999588393!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5311ad80031%3A0xae42de3ba17aceb7!2sBalai%20Besar%20Penerapan%20Standar%20Instrumen%20Pertanian%20(BBPSIP)!5e0!3m2!1sen!2sid!4v1721834025093!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="contact-info">
            <p>(0251) 8351277 / WA : 085218339006</p>
            <p>(0251) 8350928 <a href="https://bbpsip.bsip.pertanian.go.id" target="_blank">https://bbpsip.bsip.pertanian.go.id</a></p>
            <p><a href="mailto:bsip.bbpsip@pertanian.go.id">bsip.bbpsip@pertanian.go.id</a></p>
            <p>Jl. Tentara Pelajar No.10, RT.01/RW.07, Ciwaringin,<br> Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16124</p>
            <div>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <p>&copy; 2024 Balai Besar Penerapan Standar Instrumen Pertanian. All Right Reserved</p>
    </footer>
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
</body>
</html>
