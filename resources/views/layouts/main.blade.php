<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/icons/logo.png') }}">
    <title>Taman Agro Standar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Audio for Popup -->
    <audio id="click-sound" src="{{ asset('assets/image/sound3.mp3') }}" preload="auto"></audio>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<style>
    .nav-link {
        color: green !important;
    }
    .nav-link:hover {
        font-weight: bold !important;
    }
    .active {
        font-weight: bold !important;
        display: flex;
        flex-direction: column;
        text-decoration: underline;
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
<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark py-2 fixed-top bg-light shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/icons/logo.png') }}" height="55" width="55" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->path()=='/'?'active':'' }}" aria-current="page" href="/">Beranda</a>
                    </li>
                    <li class="nav-item {{ request()->url()==route('tanaman.index')?'active':'' }}">
                        <a class="nav-link" href="{{ route('tanaman.index') }}">Koleksi Tanaman</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Permohonan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/kunjungan') }}">Permohonan Kunjungan</a></li>
                            <li><a class="dropdown-item" href="{{ url('/tanaman') }}">Permohonan Benih</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Stok Benih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/testimoni/create') }}">Testimoni</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
    <div style="margin-top: 80px;">
        @yield('content')
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
