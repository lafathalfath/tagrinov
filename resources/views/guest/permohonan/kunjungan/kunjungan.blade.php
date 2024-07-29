<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Kunjungan</title>
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
        h2 {
            background-color: #00a65a;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 0;
            border-radius: 8px 8px 0 0;
        }
        .form-section {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 5px;
            font-weight: 600;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .form-group .rating {
            display: flex;
            gap: 10px;
            font-size: 30px;
            flex-direction: row-reverse;
            width: 30%;
        }
        .form-group .rating input {
            display: none;
        }
        .form-group .rating label {
            cursor: pointer;
            color: #ccc;
        }
        .form-group .rating input:checked ~ label {
            color: gold;
        }
        .form-group .rating input:hover ~ label {
            color: gold;
        }
        .form-group .rating input:checked ~ label:hover {
            color: gold;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            width: 100%;
        }
        .form-group.half {
            width: 48%;
        }
        .form-group.full {
            width: 100%;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .feedback {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
        }
        .feedback .info {
            margin-left: 8px;
        }
        .feedback .info h3 {
            margin: 0;
        }
        .feedback .info .date {
            font-size: 14px;
            color: gray;
        }
        .feedback .info .rating {
            color: gold;
            margin: 5px 0;
        }
        .feedback .info p {
            margin: 0;
        }
        .foto-kunjungan {
            margin: 10px 0px;
            width: auto;
            height: 200px;
            border-radius: 10px;
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
            <a href="/">Beranda</a>
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
        <h2>Ulasan Kunjungan</h2>
        <div class="form-section">
            <form action="{{ url('/kunjungan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group half">
                        <label for="nama">Nama Lengkap/Instansi</label>
                        <input type="text" id="nama" name="nama" placeholder="Nama atau Instansi" required>
                    </div>
                    <div class="form-group half">
                        <label for="rating">Rating</label>
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" required><label for="star5">&#9733;</label>
                            <input type="radio" id="star4" name="rating" value="4"><label for="star4">&#9733;</label>
                            <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
                            <input type="radio" id="star2" name="rating" value="2"><label for="star2">&#9733;</label>
                            <input type="radio" id="star1" name="rating" value="1"><label for="star1">&#9733;</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group half">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email Pengunjung" required>
                    </div>
                    <div class="form-group half">
                        <label for="tanggal">Tanggal Kunjungan</label>
                        <input type="date" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full">
                        <label for="foto">Foto (Opsional)</label>
                        <input type="file" id="foto" name="foto" accept="image/*">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full">
                        <label for="pesan">Kesan dan Pesan</label>
                        <textarea id="pesan" name="pesan" rows="4" placeholder="Isikan kesan dan pesan anda"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn">Kirim</button>
            </form>
        </div>

        @foreach($feedbacks as $feedback)
            <div class="feedback">
                <div class="info">
                    <h3>{{ $feedback['nama'] }}</h3>
                    <div class="rating">
                        @for ($i = 0; $i < $feedback['rating']; $i++)
                            &#9733;
                        @endfor
                        @for ($i = $feedback['rating']; $i < 5; $i++)
                            &#9734;
                        @endfor
                    </div>
                    <div class="date">{{ \Carbon\Carbon::parse($feedback['tanggal'])->format('F j, Y') }}</div>
                    <p>{{ $feedback['pesan'] }}</p>
                    @if(isset($feedback['foto']))
                    <img class="foto-kunjungan" src="{{ asset('storage/' . $feedback['foto']) }}" alt="Foto">
                    @endif
                </div>
            </div>
        @endforeach
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
</body>
</html>
