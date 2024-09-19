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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Audio for Popup -->
    <audio id="click-sound" src="{{ asset('assets/image/sound3.mp3') }}" preload="auto"></audio>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }
    h3 {
        background-color: #00573d;
        color: white;
        padding: 15px;
        text-align: center;
        margin-top: 100px;
    }
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
    .navbar {
        transition: background-color 0.3s ease;
    }

    .navbar.scrolled {
        background-color: rgba(255, 255, 255, 1);
    }

    .navbar.scrolled .nav-link,
    .navbar.scrolled .navbar-brand {
        color: black !important;
    }

    .navbar-dark .navbar-nav .nav-link {
        color: white;
    }

    .navbar-dark .navbar-brand {
        color: white;
    }
    footer {
    color: white;
    padding: 30px 0px 20px 0px;
    background-color: #00452C;
    }
    .footer h5 {
        margin-top: 0;
    }

    .footer .social-media a {
        margin-right: 10px;
    }

    footer .map iframe {
        border: 0;
        width: 100%;
        height: 270px;
        border-radius: 5px;
    }
    footer .contact-info {
        text-align: left;
    }
    footer .contact-info h4 {
        font-size: 20px;
        margin-bottom: 15px;
    }
    footer .contact-info p {
        margin: 13px 0;
        display: flex;
        align-items: center;
    }
    footer .contact-info p a {
        color: white;
        text-decoration: none;
    }
    footer .contact-info p a:hover {
        text-decoration: underline;
    }
    footer .contact-info i {
        margin-right: 10px;
    }
    footer .social-links {
        margin-top: 10px;
    }
    footer .social-links a {
        color: white;
        text-decoration: none;
        margin: 0 10px;
    }
    footer .social-links a:hover {
        text-decoration: underline;
    }
    footer .bottom-text {
        margin-top: 20px;
        font-size: 14px;
        text-align: center;
    }
</style>
<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark py-2 fixed-top bg-light shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <img src="{{ asset('assets/icons/logotype.png') }}" height="55" alt="">
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
                            <li><a class="dropdown-item" href="{{ route('permohonan.kunjungan.index') }}">Permohonan Kunjungan</a></li>
                            <li><a class="dropdown-item" href="{{ route('permohonan.benih.index') }}">Permohonan Benih</a></li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->url()==route('stokBenih.index')?'active':'' }}">
                        <a class="nav-link" href="{{ route('stokBenih.index') }}">Stok Benih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/event') }}">Event</a>
                    </li>
                    <li class="nav-item {{ request()->url()==route('testimoni.index')?'active':'' }}">
                        <a class="nav-link" href="{{ route('testimoni.index') }}">Testimoni</a>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.8860998470195!2d106.7875092695418!3d-6.579033999588393!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5311ad80031%3A0xae42de3ba17aceb7!2sBalai%20Besar%20Penerapan%20Standar%20Instrumen%20Pertanian%20(BBPSIP)!5e0!3m2!1sen!2sid!4v1721834025093!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-lg-6 col-md-12 contact-info">
                <h4>KONTAK</h4>
                <p><i class="fas fa-phone"></i> (0251) 8351277 / WA : 085218339006</p>
                <p><i class="fas fa-fax"></i> (0251) 8350928</p>
                <p><i class="fas fa-envelope"></i> <a href="mailto:bsip.bbpsip@pertanian.go.id">bsip.bbpsip@pertanian.go.id</a></p>
                <p>Jl. Tentara Pelajar No.10, RT.01/RW.07, Ciwaringin, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16124</p>
     
                <p><a href="https://bbpsip.bsip.pertanian.go.id" target="_blank">https://bbpsip.bsip.pertanian.go.id</a></p>
                <div class="social-links">
                    <a href="https://www.facebook.com/BSIPPenerapan/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.youtube.com/@bsippenerapan" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://instagram.com/bsippenerapan" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com/bsippenerapan" target="_blank"><i class="fab fa-x-twitter"></i></a>
                    <a href="https://tiktok.com/@bsippenerapan" target="_blank"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>
    <p class="bottom-text">&copy; 2024 Balai Besar Penerapan Standar Instrumen Pertanian. All Rights Reserved</p>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>
