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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">    
</head>
<body>
    <!--navbar-->
<nav class="navbar navbar-expand-lg navbar-dark py-3 fixed-top">
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
                    <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Produk
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ url('/stok-benih') }}">Stok Benih</a></li>
                        <li><a class="dropdown-item" href="{{ url('/tanaman') }}">Tanaman</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Permohonan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/pelaporan') }}">Pelaporan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar -->

    <section id="hero" class="px-0">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="{{ asset('assets/image/gambar_header1.png') }}" class="d-block w-100" alt="Slide 1">
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="{{ asset('assets/image/hero2.jpg') }}" class="d-block w-100" alt="Slide 2">
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="{{ asset('assets/image/hero3.webp') }}" class="d-block w-100" alt="Slide 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="carousel-caption d-none d-md-block">
            <div class="hero-title">
                <h1 class="text-white">Selamat Datang di</h1>
                <h1 class="text-green">Taman Agro Standar</h1>
                <p class="lead mt-3">Nikmati keindahan alam dan belajar lebih banyak tentang berbagai jenis tanaman yang ada di taman kami. Dengan berbagai fitur interaktif, Anda bisa memindai barcode pada setiap tanaman untuk mendapatkan informasi lebih detail, serta memantau stok benih yang tersedia.</p>
                <!-- Tombol untuk Scroll ke Bagian Denah Taman -->
                <a href="#denah" class="btn btn-light btn-lg mt-4 scroll-btn">
                    <span>Denah Taman</span>
                    <i class="bi bi-arrow-down-circle"></i> <!-- Ikon Panah -->
                </a>
            </div>
        </div>
    </section>

    <!--virtual tour-->
    <section id="virtual" class="py-5">
        <div class="container text-center">
            <h2>Virtual Tour</h2>
            <img src="{{ asset('assets/image/header_bsip.png') }}" class="img-fluid mt-4" alt="Virtual Tour Sample">
        </div>
    </section>

    <!--denah taman-->
    <section id="denah" class="py-5">
        <div class="container text-center">
            <h2>Denah Taman</h2>
            <div class="position-relative">
                <img src="{{ asset('assets/image/denah_taman.png') }}" class="img-fluid mt-4" alt="Denah Taman">
                <div class="location-icon" style="top: 30%; left: 40%;" data-detail="<b>Taman Horti</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."></div>
                <div class="location-icon" style="top: 50%; left: 60%;" data-detail="<b>Area hortikultura</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."></div>
                <!-- Tambahkan lebih banyak ikon lokasi sesuai kebutuhan -->
            </div>
            <div id="location-detail" class="mt-4"></div>
        </div>
    </section>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/62XXXXXXXXXX" class="whatsapp-button" target="_blank">
        <img src="{{ asset('assets/icons/whatsapp.png') }}" alt="WhatsApp">
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        // JavaScript to add background to navbar on scroll
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // JavaScript to handle location icon click
        document.querySelectorAll('.location-icon').forEach(function(icon) {
            icon.addEventListener('click', function() {
                var detail = this.getAttribute('data-detail');
                document.getElementById('location-detail').innerHTML = detail;
            });
        });
    </script>
</body>
<!-- Footer -->
<footer class="footer text-white py-4">
    <div class="container">
        <div class="row">
            <!-- Maps Kantor -->
            <div class="col-md-6">
                <h5>Lainnya</h5>
                <iframe src="https://www.google.com/maps/dir/-6.5774051,106.7824544/taman+agro+inovasi/@-6.5773881,106.7801571,16z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x2e69c44f337f79a9:0xe4c07124a7d489d!2m2!1d106.7881595!2d-6.5788163?entry=ttu" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <!-- Kontak dan Social Media -->
            <div class="col-md-6">
                <h5>Kontak & Sosial Media</h5>
                <p>Alamat: Jl. Contoh No. 123, Kota, Negara</p>
                <p>Email: info@example.com</p>
                <p>Telepon: +62 123 456 789</p>
                <div class="social-media">
                    <a href="https://facebook.com" target="_blank" class="me-2">
                        <img src="{{ asset('assets/icons/facebook.png') }}" alt="Facebook" width="24" height="24">
                    </a>
                    <a href="https://twitter.com" target="_blank" class="me-2">
                        <img src="{{ asset('assets/icons/twitter.png') }}" alt="Twitter" width="24" height="24">
                    </a>
                    <a href="https://instagram.com" target="_blank">
                        <img src="{{ asset('assets/icons/instagram.png') }}" alt="Instagram" width="24" height="24">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
</html>
