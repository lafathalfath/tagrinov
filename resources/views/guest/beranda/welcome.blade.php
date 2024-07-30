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
                <!-- Tombol untuk Scroll ke Bagian Denah Taman -->
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
                <div class="location-icon" style="position: absolute; top: 30%; left: 40%;" 
                    data-detail="<b>Taman Horti</b><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." 
                    data-audio="{{ asset('assets/image/sound3.mp3') }}">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: red;"></i>
                </div>
                <div class="location-icon" style="position: absolute; top: 50%; left: 60%;" 
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

    <!-- Location Detail Modal -->
    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Detail Lokasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="location-modal-body">
                    <!-- Konten detail lokasi akan diisi oleh JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <!-- Form Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Isi Data Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="visitorForm">
                        <div class="mb-3">
                            <label for="visitorName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="visitorName" required>
                        </div>
                        <div class="mb-3">
                            <label for="visitorWA" class="form-label">No. WA</label>
                            <input type="text" class="form-control" id="visitorWA" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
=======
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
>>>>>>> cf551ccaed4084504a1627f34954b0e2f9d571c0
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
<<<<<<< HEAD
                var audioSrc = this.getAttribute('data-audio');
                showPopup(detail, audioSrc);
            });
        });

        // Function to show popup
        function showPopup(content, audioSrc) {
            var popup = document.createElement('div');
            popup.className = 'popup';
            popup.innerHTML = `
                <div class="popup-content">
                    <span class="popup-close">&times;</span>
                    <div class="popup-body">${content}</div>
                </div>
            `;
            document.body.appendChild(popup);

            // Create audio element to play sound
            var clickSound = new Audio(audioSrc);
            clickSound.play();

            // Add event listener to close popup
            popup.querySelector('.popup-close').addEventListener('click', function() {
                clickSound.pause();
                clickSound.currentTime = 0; // Reset time to 0
                document.body.removeChild(popup);
            });
        }

        // Track clicks for showing form modal
        document.addEventListener('DOMContentLoaded', function() {
            const clickCounts = new Map();

            document.querySelectorAll('.location-icon').forEach(function(icon) {
                clickCounts.set(icon, 0);

                icon.addEventListener('click', function() {
                    const count = clickCounts.get(icon) + 1;
                    clickCounts.set(icon, count);

                    if (count === 3) {
                        clickCounts.set(icon, 0); // Reset count after showing the form
                        const formModal = new bootstrap.Modal(document.getElementById('formModal'));
                        formModal.show();
                    }
                });
            });
        });
=======
                document.getElementById('location-detail').innerHTML = detail;

                document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menampilkan popup dan memutar suara
            function showPopup(content, audioSrc) {
                var popup = document.createElement('div');
                popup.className = 'popup';
                popup.innerHTML = `
                    <div class="popup-content">
                        <span class="popup-close">&times;</span>
                        <div class="popup-body">${content}</div>
                    </div>
                `;
                document.body.appendChild(popup);

                // Buat elemen audio untuk memutar suara
                var clickSound = new Audio(audioSrc);
                clickSound.play();

                // Tambahkan event listener untuk menutup popup
                popup.querySelector('.popup-close').addEventListener('click', function() {
                    // Hentikan pemutaran suara
                    clickSound.pause();
                    clickSound.currentTime = 0; // Mengatur waktu kembali ke 0
                    
                    document.body.removeChild(popup);
                });
            }

            // Tambahkan event listener untuk ikon lokasi
            document.querySelectorAll('.location-icon').forEach(function(icon) {
                icon.addEventListener('click', function() {
                    var detail = this.getAttribute('data-detail');
                    var audioSrc = this.getAttribute('data-audio');
                    showPopup(detail, audioSrc);
                });
            });
        });
>>>>>>> cf551ccaed4084504a1627f34954b0e2f9d571c0
    </script>
@endsection