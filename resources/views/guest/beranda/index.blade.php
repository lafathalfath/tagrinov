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

        .hero-title p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
            max-width: 90%;
            transition: transform 0.3s ease, opacity 0.3s ease;
            opacity: 0;
        }

        .popup.show {
            display: block;
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        .popup h4 {
            margin: 0;
            color: #00452C;
            font-size: 1.5rem;
            text-align: center;
        }

        .popup p {
            font-size: 1rem;
            color: #333;
            margin: 10px 0;
            text-align: center;
        }

        .popup button {
            display: inline-block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            align-items: center;  
            transition: background-color 0.3s ease;
        }

        .popup button:hover {
            background-color: #00452C;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

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

        .highlight-area.active {
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.7); 
        }

        .location-icon {
            position: absolute;
            width: 85px;
            height: 85px;
            cursor: pointer;
            color: #FFFFFF; 
            transition: transform 0.3s ease;
        }

        .location-icon:hover {
            transform: scale(1.2) rotate(15deg);
        }
    </style>

    <!-- Hero -->
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

    <!-- Denah -->
    <section id="denah" class="py-5" data-aos="fade-up">
        <div class="container text-center">
            <h2>Denah Taman</h2>
            <div class="position-relative" id="panzoom-container">
                <div id="panzoom" style="overflow: hidden;">
                    <img src="{{ asset('assets/image/denahTaman.jpg') }}" class="img-fluid mt-4" alt="Denah Taman">
                </div>

                <div class="highlight-area" style="top: 15%; left: 56%; width: 345px; height: 200px;">
                    <div class="location-icon" data-title="Gap Tanaman Sayuran" data-detail="Gap tanaman sayuran adalah area yang dirancang khusus untuk menanam berbagai jenis sayuran segar. Di sini, pengunjung dapat melihat langsung proses pertumbuhan sayuran dari awal hingga siap panen. Gap ini dilengkapi dengan informasi tentang teknik pertanian modern yang digunakan untuk meningkatkan hasil panen dan menjaga kualitas tanaman.">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>

                <!-- Highlight Area 2 -->
                <div class="highlight-area" style="top: 10%; left: 88%; width: 133px; height: 280px;">
                   <div class="location-icon" data-title="Cafe Tagrinov" data-detail="Cafe Tagrinov menawarkan pengalaman bersantai dengan nuansa alam yang segar. Menyajikan berbagai pilihan makanan dan minuman, cafe ini mengutamakan bahan-bahan segar yang dihasilkan langsung dari taman. Pengunjung dapat menikmati hidangan sambil menikmati pemandangan indah taman, menciptakan suasana yang tenang dan menyenangkan.">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>

                <!-- Highlight Area 3 -->
                <div class="highlight-area" style="top: 58%; left: 85%; width: 170px; height: 120px;">
                    <div class="location-icon" style="top: 50%; left: 50%;" data-title="Sistem Irigasi Panel Surya" data-detail="Sistem irigasi panel surya merupakan inovasi teknologi yang memanfaatkan energi terbarukan untuk mengairi tanaman. Sistem ini dirancang efisien untuk memastikan tanaman mendapatkan cukup air tanpa tergantung pada sumber energi fosil. Pengunjung dapat belajar tentang cara kerja sistem ini dan manfaatnya untuk keberlanjutan pertanian.">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>

                <!-- Highlight Area 4 -->
                <div class="highlight-area" style="top: 55%; left: 69%; width: 170px; height: 140px;">
                    <div class="location-icon" style="top: 50%; left: 50%;" data-title="Kopi" data-detail="<Area kopi di Taman Agro Inovasi menampilkan berbagai jenis kopi yang ditanam dan diolah di lingkungan yang ramah lingkungan. Pengunjung dapat menikmati secangkir kopi segar sambil mempelajari proses pengolahan biji kopi dari pemetikan hingga penyajian. Area ini juga menjadi tempat yang ideal untuk relaksasi dan interaksi sosial.">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>

                <!-- Highlight Area 5 -->
                <div class="highlight-area" style="top: 55%; left: 61%; width: 85px; height: 100px;">
                    <div class="location-icon" style="top: 40%; left: 5%;" data-title="Sayuran" data-detail="Bagian ini menampilkan beragam sayuran organik yang ditanam dengan teknik pertanian berkelanjutan. Pengunjung dapat mengenali berbagai jenis sayuran, belajar tentang manfaatnya untuk kesehatan, dan memahami pentingnya pertanian organik dalam menjaga ekosistem. Sayuran segar ini juga tersedia untuk dibeli di lokasi.">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>

                <!-- Highlight Area 6 -->
                <div class="highlight-area" style="top: 53%; left: 50%; width: 130px; height: 130px;">
                    <div class="location-icon" style="top: 30%; left: 20%;" data-title="Gazebo" data-detail="Gazebo pertemuan adalah tempat yang ideal untuk berdiskusi dan berinteraksi dengan pengunjung lain. Dikelilingi oleh keindahan alam, gazebo ini menyediakan tempat duduk yang nyaman untuk mengadakan pertemuan, seminar, atau acara sosial. Suasana tenang membuatnya sempurna untuk berkumpul dan berbagi ide.">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>

                <!-- Highlight Area 7 -->
                <div class="highlight-area" style="top: 15%; left: 15%; width: 435px; height: 375px;">
                    <div class="location-icon" style="top: 50%; left: 50%;" data-title="Biofarmaka, Sayuran" data-detail="Area biofarmaka menampilkan tanaman yang memiliki khasiat obat serta sayuran yang tumbuh berdampingan. Di sini, pengunjung dapat mempelajari manfaat kesehatan dari tanaman obat dan cara penggunaannya dalam pengobatan alami. Informasi tentang teknik budidaya yang ramah lingkungan juga tersedia untuk meningkatkan kesadaran akan pentingnya keanekaragaman hayati.">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>

                <!-- Highlight Area 8 -->
                <div class="highlight-area" style="top: 78%; left: 0%; width: 1120px; height: 90px;">
                    <div class="location-icon" style="top: 50%; left: 50%;" data-title="Rumah Benih" data-detail="Rumah benih adalah fasilitas yang menyimpan berbagai jenis benih unggul untuk pertanian. Di sini, pengunjung dapat belajar tentang pentingnya pemilihan benih berkualitas dan teknik penyimpanan yang tepat. Selain itu, rumah benih ini juga menjadi pusat edukasi tentang budidaya tanaman dan inovasi dalam pertanian.">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>

                <!-- Highlight Area 9 -->
                <div class="highlight-area" style="top: 26%; left: 0%; width: 150px; height: 275px;">
                    <div class="location-icon" style="top: 50%; left: 50%;" data-title="Hidroponik" data-detail="Area hidroponik menawarkan metode bercocok tanam tanpa tanah, menggunakan larutan nutrisi untuk memberikan makanan kepada tanaman. Pengunjung dapat melihat berbagai sistem hidroponik yang diterapkan, serta mempelajari kelebihan dan cara perawatannya. Ini adalah contoh nyata dari teknologi pertanian modern yang berpotensi meningkatkan efisiensi produksi tanaman.">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimoni" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center">Testimoni Pengunjung</h2>
            <div id="testimoniCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="testimonial-box p-4 shadow-sm bg-white rounded d-flex align-items-center">
                                <div class="testimonial-img me-4">
                                    <img src="{{ asset('assets/image/hero3.webp') }}" class="rounded-circle" alt="Foto Testi" width="80" height="80">
                                </div>
                                <div>
                                    <p class="testimonial-text">"Tempatnya sangat indah dan asri! Sangat cocok untuk bersantai dan berfoto-foto bersama keluarga."</p>
                                    <div class="rating">
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-muted">&#9733;</span>
                                    </div>
                                    <h5 class="mt-3">- Budi, Jakarta</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="testimonial-box p-4 shadow-sm bg-white rounded d-flex align-items-center">
                                <div class="testimonial-img me-4">
                                    <img src="{{ asset('assets/image/hero3.webp') }}" class="rounded-circle" alt="User Image" width="80" height="80">
                                </div>
                                <div>
                                    <p class="testimonial-text">"Suasana di sini sangat menyegarkan, saya sangat menikmati waktu saya di sini."</p>
                                    <div class="rating">
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-muted">&#9733;</span>
                                        <span class="text-muted">&#9733;</span>
                                    </div>
                                    <h5 class="mt-3">- Siti, Bandung</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="testimonial-box p-4 shadow-sm bg-white rounded d-flex align-items-center">
                                <div class="testimonial-img me-4">
                                    <img src="{{ asset('assets/image/hero3.webp') }}" class="rounded-circle" alt="User Image" width="80" height="80">
                                </div>
                                <div>
                                    <p class="testimonial-text">"Pemandangannya sangat memukau, saya pasti akan datang lagi!"</p>
                                    <div class="rating">
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-warning">&#9733;</span>
                                        <span class="text-warning">&#9733;</span>
                                    </div>
                                    <h5 class="mt-3">- Andi, Surabaya</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimoniCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimoniCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('testimoni.index') }}" class="btn btn-success">Lihat Semua Testimoni</a>
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
        document.querySelectorAll('.location-icon').forEach(icon => {
            icon.addEventListener('click', function () {
                const title = this.getAttribute('data-title');
                const detail = this.getAttribute('data-detail');

                document.querySelector('.popup-title').innerText = title;
                document.querySelector('.popup-detail').innerText = detail;

                document.querySelector('.popup-overlay').style.display = 'block';
                document.querySelector('.popup').classList.add('show');
            });
        });

        document.querySelector('.close-popup').addEventListener('click', function () {
            document.querySelector('.popup').classList.remove('show');
            document.querySelector('.popup-overlay').style.display = 'none';
        });

        document.querySelector('.popup-overlay').addEventListener('click', function () {
            document.querySelector('.popup').classList.remove('show');
            document.querySelector('.popup-overlay').style.display = 'none';
        });
    </script>

@endsection
