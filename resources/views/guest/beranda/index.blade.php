@extends('layouts.main')
@section('content')
    <style>
        .scroll-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 1.2rem;
            color: #00452C;
            border: 2px solid #333333;
            border-radius: 30px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .scroll-btn:hover {
            background-color: #00452C;
            color: #ffffff;
        }

        .scroll-btn i {
            font-size: 1.5rem;
        }
        #heroCarousel .carousel-item img {
            width: 100%;
            height: 700px; 
            object-fit: cover;
        }
        .carousel-caption {
            text-align: left;
            left: 10%;
            bottom: 15%;
            right: 20%;
            max-width: 50%;
        }

        .hero-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .text-green {
            color: #28a745;
        }

        .hero-title p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        #virtual img {
            width: 100%;
            height: auto;
        }

        #denah {
            position: relative;
        }

        .location-icon {
            position: absolute;
            width: 40px;
            height: 40px;
            cursor: pointer;
        }

        .location-icon i {
            font-size: 2rem;
            color: red;
        }

        #location-detail {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .whatsapp-button img {
            width: 50px;
            height: 50px;
        }

        .modal-header {
            background-color: #00452C;
            color: white;
        }

        .modal-body {
            font-size: 1rem;
            color: #333;
        }

        .highlight-area {
            position: absolute;
            border: 2px solid white; /* Ganti warna border menjadi putih */
            opacity: 1;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.1); /* Ganti background menjadi putih dengan opasitas */
        }

        .highlight-area:hover {
            opacity: 1;
            background-color: rgba(255, 255, 255, 0.4); /* Ganti background hover menjadi putih dengan opasitas */
        }
    </style>

    <h1>INI TES</h1>
    <section id="hero" class="px-0">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/image/gambar_header1.png') }}" class="d-block w-100" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/image/hero2.jpg') }}" class="d-block w-100" alt="Slide 2">
                </div>
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
                <h1 class="text-white">{{ $welcomeText->title1 }}</h1>
                <h1 class="text-green">{{ $welcomeText->title2 }}</h1>
                <p class="lead mt-3">{{ $welcomeText->description }}</p>
                <a href="#denah" class="btn btn-light btn-lg mt-4 scroll-btn">
                    <span>Denah Taman</span>
                    <i class="bi bi-arrow-down-circle"></i>
                </a>
            </div>
        </div>
    </section>

    <section id="denah" class="py-5">
        <div class="container text-center">
            <h2>Denah Taman</h2>
            <div class="position-relative">
                <img src="{{ asset('assets/image/denahTaman.jpg') }}" class="img-fluid mt-4" alt="Denah Taman">
                <div class="highlight-area" style="top: 15%; left: 56%; width: 345px; height: 200px;"></div>
                <div class="highlight-area" style="top: 10%; left: 88%; width: 133px; height: 280px;"></div>
                <div class="highlight-area" style="top: 58%; left: 85%; width: 170px; height: 120px;"></div>
                <div class="highlight-area" style="top: 55%; left: 69%; width: 170px; height: 140px;"></div>
                <div class="highlight-area" style="top: 55%; left: 61%; width: 85px; height: 100px;"></div>
                <div class="highlight-area" style="top: 53%; left: 50%; width: 130px; height: 130px;"></div>
                <div class="highlight-area" style="top: 15%; left: 15%; width: 435px; height: 375px;"></div>
                <div class="highlight-area" style="top: 78%; left: 0%; width: 1120px; height: 90px;"></div>
                <div class="highlight-area" style="top: 26%; left: 0%; width: 150px; height: 275px;"></div>
                <div class="location-icon" style="top: 20%; left: 57%;" data-detail="<b>Area hortikultura</b><br>Lorem ipsum dolor sit amet." data-audio="{{ asset('assets/sound/vo_ikon1.mp3') }}">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="location-icon" style="top: 30%; left: 5%;" data-detail="<b>Kafe</b><br>Lorem ipsum dolor sit amet." data-audio="{{ asset('assets/sound/sound2.mp3') }}">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
            </div>
        </div>
    </section>

    

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
                <div class="modal-body">
                    <div id="location-detail"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navbar Scroll Effect
            var navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 0) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Location Icon Click Event
            var locationIcons = document.querySelectorAll('.location-icon');
            var locationDetail = document.getElementById('location-detail');
            var audioElement = null;

            locationIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    var detail = this.getAttribute('data-detail');
                    var audioSrc = this.getAttribute('data-audio');
                    locationDetail.innerHTML = detail;

                    if (audioElement) {
                        audioElement.pause();
                    }

                    audioElement = new Audio(audioSrc);
                    audioElement.play();

                    var locationModal = new bootstrap.Modal(document.getElementById('locationModal'));
                    locationModal.show();
                });
            });

            // Stop audio when modal is closed
            var locationModalEl = document.getElementById('locationModal');
            locationModalEl.addEventListener('hidden.bs.modal', function() {
                if (audioElement) {
                    audioElement.pause();
                }
            });
        });
    </script>
@endsection
