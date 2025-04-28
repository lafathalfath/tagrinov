<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/icons/logo.png') }}">
    <meta name="theme-color" content="#38b77a">
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
        /* text-decoration: underline; */
    }
    .navbar {
        transition: background-color 0.3s ease;
    }

    .navbar.scrolled {
        background-color: rgba(255, 255, 255, 1);
    }
    .navbar-dark .navbar-nav .nav-link {
        color: white;
    }

    .navbar-dark .navbar-brand {
        color: white;
    }
    .navbar-toggler {
        border-color: #00573d; /* Warna border hijau untuk tombol toggle */
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 87, 61, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e"); /* Ikon toggle warna hijau */
    }
    footer {
    color: white;
    padding: 30px 0px 20px 0px;
    background-color: #00452C;
}

footer h4 {
    margin-top: 0;
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
                        <a class="nav-link" href="{{ route('tanaman.index') }}">Koleksi</a>
                    </li>
                    <li class="nav-item {{ request()->url()==route('stokbenih.index')?'active':'' }}">
                        <a class="nav-link" href="{{ route('stokbenih.index') }}">Stok Benih</a>
                    </li>
                    <li class="nav-item {{ request()->url()==route('guest.permohonan.kunjungan.index')?'active':'' }}">
                        <a class="nav-link" href="{{ route('guest.permohonan.kunjungan.index') }}">Permohonan Kunjungan</a>
                    </li>
                    <li class="nav-item {{ request()->url()==route('events.index')?'active':'' }}">
                        <a class="nav-link" a href="{{ route('events.index') }}">Event</a>
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

@php
    $footer = App\Models\FooterSetting::first();
@endphp
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 map mb-4 mb-lg-0">
                {!! $footer->map_link !!}
            </div>
            <div class="col-lg-6 col-md-12 contact-info">
                <h4>KONTAK</h4>
                <p><i class="fas fa-phone"></i> {{ $footer->phone }}</p>
                <p><i class="fas fa-fax"></i> {{ $footer->fax }}</p>
                <p><i class="fas fa-envelope"></i> <a href="mailto:{{ $footer->email }}">{{ $footer->email }}</a></p>
                <p>{{ $footer->address }}</p>
                <p><a href="{{ $footer->website_link }}" target="_blank">{{ $footer->website_link }}</a></p>
                <div class="social-links">
                    @if (!empty($footer->facebook_link))
                        <a href="{{ $footer->facebook_link }}" target="_blank"><i class="fab fa-facebook"></i></a>
                    @endif

                    @if (!empty($footer->youtube_link))
                        <a href="{{ $footer->youtube_link }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif

                    @if (!empty($footer->instagram_link))
                        <a href="{{ $footer->instagram_link }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif

                    @if (!empty($footer->twitter_link))
                        <a href="{{ $footer->twitter_link }}" target="_blank"><i class="fab fa-x-twitter"></i></a>
                    @endif

                    @if (!empty($footer->tiktok_link))
                        <a href="{{ $footer->tiktok_link }}" target="_blank"><i class="fab fa-tiktok"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <p class="bottom-text">&copy; 2024 Balai Besar Penerapan Standar Instrumen Pertanian & IPB. All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
