<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanaman</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
            padding: 20px 100px;
            text-align: center;
        }
        .search-bar {
            margin-bottom: 30px;
        }
        .search-bar input {
            padding: 10px;
            width: 300px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 40px;
            der-radius: 4px;
        }
        .seed-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            justify-items: center;
        }
        .seed-item {
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
            text-align: center;
        }
        .seed-item:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .seed-item img {
            width: 100%;
            height: auto;
            aspect-ratio: 1/1;
            border-radius: 8px;
            object-fit: cover;
        }
        .seed-item p {
            margin: 10px 0 0;
            font-weight: 500;
            color: #333;
        }
        .seed-item a {
            text-decoration: none;
            color: inherit;
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
        <h1>Tanaman</h1>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Cari">
        </div>
        <div class="seed-grid" id="seed-grid">
            <div class="seed-item" data-name="Benih Kangkung">
                <a href="#"><img src="{{ asset('images/seed1.png') }}" alt="Benih Kangkung">
                <p>Kangkung</p></a>
            </div>
            <div class="seed-item" data-name="Benih Bawang Merah">
                <a href="#"><img src="{{ asset('images/seed2.png') }}" alt="Benih Bawang Merah">
                <p>Bawang Merah</p></a>
            </div>
            <div class="seed-item" data-name="Nama Benih 3">
                <a href="#"><img src="{{ asset('images/seed1.png') }}" alt="Nama Benih 3">
                <p>Nama Benih 3</p></a>
            </div>
            <div class="seed-item" data-name="Nama Benih 4">
                <a href="#"><img src="{{ asset('images/seed2.png') }}" alt="Nama Benih 4">
                <p>Nama Benih 4</p></a>
            </div>
            <div class="seed-item" data-name="Nama Benih 5">
                <a href="#"><img src="{{ asset('images/seed1.png') }}" alt="Nama Benih 5">
                <p>Nama Benih 5</p></a>
            </div>
            <div class="seed-item" data-name="Nama Benih 6">
                <a href="#"><img src="{{ asset('images/seed1.png') }}" alt="Nama Benih 6">
                <p>Nama Benih 6</p></a>
            </div>
            <div class="seed-item" data-name="Nama Benih 7">
                <a href="#"><img src="{{ asset('images/seed2.png') }}" alt="Nama Benih 7">
                <p>Nama Benih 7</p></a>
            </div>
            <div class="seed-item" data-name="Nama Benih 8">
                <a href="#"><img src="{{ asset('images/seed2.png') }}" alt="Nama Benih 8">
                <p>Nama Benih 8</p></a>
            </div>
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
        document.getElementById('search-input').addEventListener('input', function() {
            const searchQuery = this.value.toLowerCase();
            const seedItems = document.querySelectorAll('.seed-item');
            
            seedItems.forEach(item => {
                const itemName = item.getAttribute('data-name').toLowerCase();
                if (itemName.includes(searchQuery)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
