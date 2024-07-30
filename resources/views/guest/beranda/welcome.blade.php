@extends('layouts.main')
@section('content')
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
                <a href="#denah" class="btn btn-light btn-lg mt-4 scroll-btn">
                    <span>Denah Taman</span>
                    <i class="bi bi-arrow-down-circle"></i> <!-- Ikon Panah -->
                </a>
            </div>
        </div>
    </section>

    <!-- Virtual Tour -->
    <section id="virtual" class="py-5">
        <div class="container text-center">
            <h2>Virtual Tour</h2>
            <img src="{{ asset('assets/image/header_bsip.png') }}" class="img-fluid mt-4" alt="Virtual Tour Sample">
        </div>
    </section>

    <!-- Denah Taman -->
    <section id="denah" class="py-5">
        <div class="container text-center">
            <h2>Denah Taman</h2>
            <div class="position-relative">
                <img src="{{ asset('assets/image/denah_taman.png') }}" class="img-fluid mt-4" alt="Denah Taman">
                <!-- ikon 7 -->
                <div class="location-icon" style="position: absolute; top: 30%; left: 40%;" 
                    data-detail="<b>Taman Horti</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." 
                    data-audio="{{ asset('assets/image/sound3.mp3') }}">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: red;"></i>
                </div>
                <!-- ikon 1 -->
                <div class="location-icon" style="position: absolute; top: 30%; left: 60%;" 
                    data-detail="<b>Area hortikultura</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." 
                    data-audio="{{ asset('assets/image/sound2.mp3') }}">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: red;"></i>
                </div>
                <!-- ikon 8 -->
                <div class="location-icon" style="position: absolute; top: 30%; left: 5%;" 
                    data-detail="<b>Rumah Bibit</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." 
                    data-audio="{{ asset('assets/image/sound2.mp3') }}">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: red;"></i>
                </div>
                <!-- ikon 2 -->
                <div class="location-icon" style="position: absolute; top: 30%; right: 3%;" 
                    data-detail="<b>Kafe</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." 
                    data-audio="{{ asset('assets/image/sound2.mp3') }}">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: red;"></i>
                </div>
                <!-- ikon 5 -->
                <div class="location-icon" style="position: absolute; top: 65%; left: 60%;" 
                    data-detail="<b>Tanaman Hias</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." 
                    data-audio="{{ asset('assets/image/sound2.mp3') }}">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: red;"></i>
                </div>
                <!-- ikon 3 -->
                <div class="location-icon" style="position: absolute; top: 65%; right: 7%;" 
                    data-detail="<b>Perairan Panel Surya</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." 
                    data-audio="{{ asset('assets/image/sound2.mp3') }}">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: red;"></i>
                </div>
                <!-- ikon 4 -->
                <div class="location-icon" style="position: absolute; top: 65%; right: 22%;" 
                    data-detail="<b>Kopi & Kelor</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." 
                    data-audio="{{ asset('assets/image/sound2.mp3') }}">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: red;"></i>
                </div>
                <!-- ikon 6 -->
                <div class="location-icon" style="position: absolute; top: 55%; left: 50%;" 
                    data-detail="<b>Gazebo</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." 
                    data-audio="{{ asset('assets/image/sound2.mp3') }}">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: red;"></i>
                </div>
                <!-- ikon 9 -->
                <div class="location-icon" style="position: absolute; top: 85%; left: 50%;" 
                    data-detail="<b>Area hortikultura</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." 
                    data-audio="{{ asset('assets/image/sound2.mp3') }}">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: red;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/6285218339006" class="whatsapp-button" target="_blank">
        <img src="{{ asset('assets/icons/whatsapp.png') }}" alt="WhatsApp">
    </a>

    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Detail Lokasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="location-modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        document.querySelectorAll('.location-icon').forEach(function(icon) {
            icon.addEventListener('click', function() {
                var detail = this.getAttribute('data-detail');
                var audioSrc = this.getAttribute('data-audio');

                var popup = document.createElement('div');
                popup.className = 'popup';
                popup.innerHTML = `
                    <div class="popup-content">
                        <span class="popup-close">&times;</span>
                        <div class="popup-body">${detail}</div>
                    </div>
                `;
                document.body.appendChild(popup);

                var clickSound = new Audio(audioSrc);
                clickSound.play();

                popup.querySelector('.popup-close').addEventListener('click', function() {
                    clickSound.pause();
                    clickSound.currentTime = 0;
                    document.body.removeChild(popup);
                });
            });
        });
    </script>
@endsection
