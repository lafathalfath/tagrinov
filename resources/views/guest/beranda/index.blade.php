@extends('layouts.main')
@section('content')
<style>
    /* Button and Icon Styling */
    .scroll-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 1.2rem;
        color: #00452C;
        background-color: #ffffff; /* Set background to white */
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

    /* Hero Section Styling */
    #heroCarousel .carousel-item img {
        width: 100%;
        height: auto; /* Make height auto for responsiveness */
        max-height: 700px; /* Limit max height */
        object-fit: cover;
    }

    .carousel-caption {
        text-align: left;
        left: 10%;
        bottom: 15%;
        right: 20%;
        max-width: 100%;
    }

    .hero-title h1 {
        font-size: 2.5rem;
    }

    .hero-title p {
        font-size: 1.2rem;
        margin-top: 10px;
    }

    /* Video Styling */
    .video-container {
        margin-top: 20px;
        text-align: center;
    }

    video {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    /* Popup Styling */
.popup-overlay,
.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 999;
}

.popup-overlay {
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
}

.popup {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.3s ease;
    max-width: 90%;
    width: 500px; /* fallback size */
    opacity: 0;
    transition: opacity 0.3s ease;
}

.popup.show {
    display: block;
    opacity: 1;
}

.popup h4 {
    color: #00452C;
    font-size: 1.5rem;
    text-align: center;
}

.popup p {
    font-size: 1rem;
    line-height: 1.5;
    margin-top: 10px;
    text-align: justify;
}

.popup button {
    display: block;
    margin: 20px auto 0;
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.popup button:hover {
    background-color: #00452C;
}

/* Responsive for small devices */
@media (max-width: 576px) {
    .popup {
        width: 90%;
        padding: 15px;
    }

    .popup h4 {
        font-size: 1.25rem;
    }

    .popup p {
        font-size: 0.95rem;
    }

    .popup button {
        width: 100%;
        padding: 10px;
    }
}
.popup {
    max-height: 80vh;
    overflow-y: auto;
}

    /* Highlight Area Styling */
    .highlight-area {
        position: absolute;
        border: 2px solid white;
        opacity: 1;
        transition: transform 0.3s ease, background-color 0.3s ease;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .highlight-area:hover {
        transform: scale(1.1);
        background-color: rgba(255, 255, 255, 0.6);
    }

    .location-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 85px;
        height: 85px;
        color: #FFFFFF;
        cursor: pointer;
        transition: transform 0.3s ease;
        font-size: 1rem;
        transform: translate(-50%, -50%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .location-icon:hover {
        transform: scale(1.2) rotate(15deg);
    }

    @media (max-width: 768px) {
        .carousel-caption {
            left: 5%;
            bottom: 10%;
            right: 5%;
            max-width: 90%;
            text-align: center;
        }

        .hero-title h1 {
            font-size: 1.8rem;  /* Ukuran font lebih kecil untuk layar kecil */
        }

        .hero-title p {
            font-size: 1rem;
        }

        .highlight-area {
            width: 80%; /* Adjust width for smaller screens */
            height: auto; /* Allow height to adjust */
            border-width: 1px;
        }
    }

    @media (max-width: 576px) {
        .carousel-caption {
            left: 5%;
            bottom: 5%;
            right: 5%;
        }

        .hero-title h1 {
            font-size: 1.5rem;  /* Ukuran font lebih kecil lagi untuk perangkat mobile */
        }

        .hero-title p {
            font-size: 0.9rem;
        }

        .highlight-area {
            width: 90%; /* Further adjust width for mobile */
            height: auto; /* Allow height to adjust */
            border-width: 1px;
        }
    }
</style>

<!-- Hero Section -->
<section id="hero" class="px-0">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/image/gambar_header1.png') }}" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/image/foto_header1.png') }}" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/image/foto_header2.png') }}" alt="Slide 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    <div class="carousel-caption d-none d-md-block">
        <div class="hero-title">
            <h1 class="text-white">{{ $welcomeText->title1 }}</h1>
            <h1 class="text-green">{{ $welcomeText->title2 }}</h1>
            <p class="lead mt-3">{{ $welcomeText->description }}</p>
            <a href="#denah" class="scroll-btn">
                <span>Denah Taman</span>
                <i class="bi bi-arrow-down-circle"></i>
            </a>
        </div>
    </div>
</section>

<!-- Denah -->
<section id="denah" class="py-5" data-aos="fade-up">
    <div class="container text-center">
        <h2>Denah Taman</h2>
        <div class="position-relative" id="panzoom-container" style="width: 100%; max-width: 1000px; margin: auto;">
            <div id="panzoom" style="overflow: hidden; position: relative;">
                <img src="{{ asset('assets/image/denahTaman.jpg') }}" class="img-fluid mt-4" alt="Denah Taman" style="max-width: 100%; height: auto;">
            </div>

            <!-- Highlight Areas -->
            <div class="highlight-area" style="top: 15%; left: 56%; width: 30%; height: 22%;">
                <div class="location-icon" data-audio-id="audioGapTanamanSayuran" data-title="Gap Tanaman Sayuran" data-detail="Gap tanaman sayuran adalah area yang dirancang khusus untuk menanam berbagai jenis sayuran segar. Di sini, pengunjung dapat melihat langsung proses pertumbuhan sayuran dari awal hingga siap panen. Gap ini dilengkapi dengan informasi tentang teknik pertanian modern yang digunakan untuk meningkatkan hasil panen dan menjaga kualitas tanaman.">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <audio id="audioGapTanamanSayuran" src="{{ asset('assets/sound/GapTanaman.mp3') }}"></audio>
            </div>

            <!-- Highlight Area 2 -->
            <div class="highlight-area" style="top: 10%; left: 88%; width: 11%; height: 31%;">
                <div class="location-icon" data-audio-id="audioCafeTagrinov" data-title="Cafe Tagrinov" data-detail="Cafe Tagrinov menawarkan pengalaman bersantai dengan nuansa alam yang segar. Menyajikan berbagai pilihan makanan dan minuman, cafe ini mengutamakan bahan-bahan segar yang dihasilkan langsung dari taman. Pengunjung dapat menikmati hidangan sambil menikmati pemandangan indah taman, menciptakan suasana yang tenang dan menyenangkan.">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <audio id="audioCafeTagrinov" src="{{ asset('assets/sound/cafe.mp3') }}"></audio>
            </div>

            <!-- Highlight Area 3 -->
            <div class="highlight-area" style="top: 58%; left: 85%; width: 15%; height: 13%;">
                <div class="location-icon" style="top: 50%; left: 50%;" data-audio-id="audioSistemIrigasi" data-title="Sistem Irigasi Panel Surya" data-detail="Sistem irigasi panel surya merupakan inovasi teknologi yang memanfaatkan energi terbarukan untuk mengairi tanaman. Sistem ini dirancang efisien untuk memastikan tanaman mendapatkan cukup air tanpa tergantung pada sumber energi fosil. Pengunjung dapat belajar tentang cara kerja sistem ini dan manfaatnya untuk keberlanjutan pertanian.">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <audio id="audioSistemIrigasi" src="{{ asset('assets/sound/panel.mp3') }}"></audio>
            </div>

            <!-- Highlight Area 4 -->
            <div class="highlight-area" style="top: 55%; left: 69%; width: 15%; height: 15%;">
                <div class="location-icon" style="top: 50%; left: 50%;" data-audio-id="audioKopi" data-title="Kopi" data-detail="Area kopi di Taman Agro Inovasi menampilkan berbagai jenis kopi yang ditanam dan diolah di lingkungan yang ramah lingkungan. Pengunjung dapat menikmati secangkir kopi segar sambil mempelajari proses pengolahan biji kopi dari pemetikan hingga penyajian. Area ini juga menjadi tempat yang ideal untuk relaksasi dan interaksi sosial.">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <audio id="audioKopi" src="{{ asset('assets/sound/areaKopi.mp3') }}"></audio>
            </div>

            <!-- Highlight Area 5 -->
            <div class="highlight-area" style="top: 55%; left: 61%; width: 17%; height: 11%;">
                <div class="location-icon" style="top: 40%; left: 5%;" data-audio-id="audioSayuran" data-title="Sayuran" data-detail="Bagian ini menampilkan beragam sayuran organik yang ditanam dengan teknik pertanian berkelanjutan. Pengunjung dapat mengenali berbagai jenis sayuran, belajar tentang manfaatnya untuk kesehatan, dan memahami pentingnya pertanian organik dalam menjaga ekosistem. Sayuran segar ini juga tersedia untuk dibeli di lokasi.">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <audio id="audioSayuran" src="{{ asset('assets/sound/sayurOrganik.mp3') }}"></audio>
            </div>

            <!-- Highlight Area 6 -->
            <div class="highlight-area" style="top: 53%; left: 50%; width: 11%; height: 14%;">
                <div class="location-icon" style="top: 30%; left: 20%;" data-audio-id="audioGazebo" data-title="Gazebo" data-detail="Gazebo pertemuan adalah tempat yang ideal untuk berdiskusi dan berinteraksi dengan pengunjung lain. Dikelilingi oleh keindahan alam, gazebo ini menyediakan tempat duduk yang nyaman untuk mengadakan pertemuan, seminar, atau acara sosial. Suasana tenang membuatnya sempurna untuk berkumpul dan berbagi ide.">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <audio id="audioGazebo" src="{{ asset('assets/sound/gazebo.mp3') }}"></audio>
            </div>

            <!-- Highlight Area 7 -->
            <div class="highlight-area" style="top: 15%; left: 15%; width: 38%; height: 41%;">
                <div class="location-icon" style="top: 50%; left: 50%;" data-audio-id="audioBiofarma" data-title="Biofarmaka, Sayuran" data-detail="Area biofarmaka menampilkan tanaman yang memiliki khasiat obat serta sayuran yang tumbuh berdampingan. Di sini, pengunjung dapat mempelajari manfaat kesehatan dari tanaman obat dan cara penggunaannya dalam pengobatan alami. Informasi tentang teknik budidaya yang ramah lingkungan juga tersedia untuk meningkatkan kesadaran akan pentingnya keanekaragaman hayati.">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <audio id="audioBiofarma" src="{{ asset('assets/sound/audio_biofarmaka.mp3') }}"></audio>
            </div>

            <!-- Highlight Area 8 -->
            <div class="highlight-area" style="top: 78%; left: 0%; width: 100%; height: 10%;">
                <div class="location-icon" style="top: 50%; left: 50%;" data-audio-id="audioHidroponik" data-title="Hidroponik" data-detail="Area hidroponik menawarkan metode bercocok tanam tanpa tanah, menggunakan larutan nutrisi untuk memberikan makanan kepada tanaman. Pengunjung dapat melihat berbagai sistem hidroponik yang diterapkan, serta mempelajari kelebihan dan cara perawatannya. Ini adalah contoh nyata dari teknologi pertanian modern yang berpotensi meningkatkan efisiensi produksi tanaman.">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <audio id="audioHidroponik" src="{{ asset('assets/sound/hidroponik.mp3') }}"></audio>
            </div>

            <!-- Highlight Area 9 -->
            <div class="highlight-area" style="top: 26%; left: 0%; width: 13%; height: 30%;">
                <div class="location-icon" style="top: 50%; left: 50%;" data-audio-id="audioRumahBenih" data-title="Rumah Benih" data-detail="Rumah benih adalah fasilitas yang menyimpan berbagai jenis benih unggul untuk pertanian. Di sini, pengunjung dapat belajar tentang pentingnya pemilihan benih berkualitas dan teknik penyimpanan yang tepat. Selain itu, rumah benih ini juga menjadi pusat edukasi tentang budidaya tanaman dan inovasi dalam pertanian.">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <audio id="audioRumahBenih" src="{{ asset('assets/sound/rumahBenih.mp3') }}"></audio>
            </div>
        </div>
    </div>
</section>

<!-- Popup -->
<div class="popup-overlay"></div>
<div class="popup">
    <h4 class="popup-title"></h4>
    <p class="popup-detail"></p>
    <button class="close-popup">Tutup</button>
</div>

<script>
    document.querySelectorAll('.location-icon').forEach(function(icon) {
        icon.addEventListener('click', function() {
            const audioId = icon.getAttribute('data-audio-id');
            const audioElement = document.getElementById(audioId);

            if (audioElement) {
                audioElement.play();

                const title = icon.getAttribute('data-title');
                const detail = icon.getAttribute('data-detail');
                showPopup(title, detail, audioElement);
            }
        });
    });

    function showPopup(title, detail, audioElement) {
        const popup = document.querySelector('.popup');
        const popupOverlay = document.querySelector('.popup-overlay');

        popup.querySelector('h4').textContent = title;
        popup.querySelector('.popup-detail').textContent = detail;

        popup.classList.add('show');
        popupOverlay.style.display = 'block';

        const closeButton = popup.querySelector('button');
        closeButton.addEventListener('click', function() {
            popup.classList.remove('show');
            popupOverlay.style.display = 'none';

            if (audioElement) {
                audioElement.pause();
                audioElement.currentTime = 0;
            }
        });
    }
</script>

<!-- Video Section -->
<section id="video-section" class="py-5">
    <div class="container text-center">
        <h2>Tutorial Penggunaan QR Code pada Taman Agro Inovasi</h2>
        <div class="video-container mt-4">
            <video controls style="max-width: 75%; height: auto;">
                <source src="{{ asset('assets/video/denahTaman.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <!-- Tombol ke halaman koleksi -->
        <div class="mt-4">
            <a href="{{ route('tanaman.index') }}" class="btn btn-primary">
                Lihat Koleksi Tanaman
            </a>
        </div>
    </div>
</section>




@endsection
