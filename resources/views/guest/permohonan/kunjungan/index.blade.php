@extends('layouts.main')
@section('content')
<style>
    body {
        background-color: #f8f9fa;
    }
    form {
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 3rem; 
    }

    label {
        font-weight: bold;
    }

    textarea {
        resize: none;
    }

    .file-input-container {
        margin-top: 1rem;
    }

    .file-input-container:last-of-type {
        margin-bottom: 2rem; 
    }

    .submit-btn-container {
        text-align: center;
        margin-top: 2rem;
    }

    /* Styling tambahan untuk input jumlah orang */
    #jumlahOrangContainer {
        display: none;
        margin-top: 1rem;
    }

    /* Optional: Styling untuk tombol aktif */
    .btn-outline-success.active {
        background-color: #198754;
        color: white;
    }

    /* Membuat tombol lebih lebar */
    .btn-group-custom {
        display: flex;
        flex-wrap: wrap; /* Memastikan elemen membungkus jika tidak cukup lebar */
        gap: 0.5rem;
    }

    .btn-group-custom .btn {
        flex: 1; /* Membuat tombol mengambil ruang yang tersedia */
        min-width: 150px;
        padding: 8px;
    }

    /* Styling untuk Pilihan Pertanian */
    #pilihanPertanianContainer {
        display: none;
        margin-top: 1rem;
    }

    #pilihanPertanianContainer .form-check {
        margin-bottom: 0.5rem;
    }
    @media (max-width: 768px) {
        .btn-group-custom label {
            flex: 1 1 100%; /* Membuat tombol memenuhi lebar layar di mobile */
            text-align: center;
        }
    }
</style>

<div class="container">
    <h3>Rencanakan Kunjunganmu</h3>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('kunjungan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Nama Lengkap -->
        <div class="mb-3">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" required>
        </div>

        <!-- No HP -->
        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP atau WhatsApp</label>
            <input type="tel" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="Nomor HP atau WhatsApp Aktif" required>
        </div>

        <!-- Usia -->
        <fieldset class="mb-3">
            <legend class="col-form-label" style="font-weight: bold;">Usia (tahun)</legend>
            @foreach($usia as $item)
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="usia{{ $item->id }}" name="usia_id" 
                        value="{{ $item->id }}" {{ old('usia_id') == $item->id ? 'checked' : '' }} required>
                    <label class="form-check-label" for="usia{{ $item->id }}">{{ $item->nama }}</label>
                </div>
            @endforeach
        </fieldset>

        <!-- Jenis Kelamin -->
        <fieldset class="mb-3">
            <legend class="col-form-label" style="font-weight: bold;">Jenis Kelamin</legend>
            @foreach($jenis_kelamin as $item)
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="jenis_kelamin{{ $item->id }}" name="jenis_kelamin_id" 
                        value="{{ $item->id }}" {{ old('jenis_kelamin_id') == $item->id ? 'checked' : '' }} required>
                    <label class="form-check-label" for="jenis_kelamin{{ $item->id }}">{{ $item->nama }}</label>
                </div>
            @endforeach
        </fieldset>

        <!-- Asal Instansi -->
        <div class="mb-3">
            <label for="asal_instansi" class="form-label">Asal Instansi</label>
            <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" value="{{ old('asal_instansi') }}" placeholder="Masukkan asal instansi" required>
        </div>

        <!-- Pekerjaan -->
        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <select class="form-select" id="pekerjaan" name="pekerjaan_id" required>
                <option value="" disabled {{ old('pekerjaan_id') ? '' : 'selected' }}>Pilih Pekerjaan</option>
                @foreach($pekerjaan as $item)
                    <option value="{{ $item->id }}" {{ old('pekerjaan_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Kategori Informasi Publik -->
        <div class="mb-3">
            <label for="kategori_informasi" class="form-label">Kategori Informasi Publik</label>
            <select class="form-select" id="kategori_informasi" name="kategori_informasi_id" required>
                <option value="" disabled {{ old('kategori_informasi_id') ? '' : 'selected' }}>Pilih Kategori Informasi Publik</option>
                @foreach($kategori_informasi as $item)
                    <option value="{{ $item->id }}" {{ old('kategori_informasi_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilihan Tambahan untuk Pertanian -->
        <div class="mb-3" id="pilihanPertanianContainer" style="display:none;">
            <label class="form-label">Pilihan Pertanian</label>
            @foreach($pilihan_pertanian as $item)
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="pilihan_pertanian{{ $item->id }}" name="pilihan_pertanian_id" 
                        value="{{ $item->id }}" {{ old('pilihan_pertanian_id') == $item->id ? 'checked' : '' }}>
                    <label class="form-check-label" for="pilihan_pertanian{{ $item->id }}">{{ $item->nama }}</label>
                </div>
            @endforeach
        </div>

        <!-- Pendidikan Terakhir -->
        <div class="mb-3">
            <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
            <select class="form-select" id="pendidikan" name="pendidikan_id" required>
                <option value="" disabled {{ old('pendidikan_id') ? '' : 'selected' }}>Pilih Pendidikan Terakhir</option>
                @foreach($pendidikan as $item)
                    <option value="{{ $item->id }}" {{ old('pendidikan_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Jenis Pengunjung -->
        <div class="mb-3">
            <label class="form-label">Jenis Pengunjung</label>
            <div class="btn-group-custom mb-3 col-12" role="group" aria-label="Jenis Pengunjung">
                @foreach($jenis_pengunjung as $item)
                    <input type="radio" class="btn-check" id="jenis_pengunjung{{ $item->id }}" name="jenis_pengunjung_id" 
                        value="{{ $item->id }}" {{ old('jenis_pengunjung_id') == $item->id ? 'checked' : '' }} required>
                    <label class="btn btn-outline-success" for="jenis_pengunjung{{ $item->id }}">{{ $item->nama }}</label>
                @endforeach
            </div>

            <!-- Input untuk jumlah orang, muncul hanya jika Perkelompok dipilih -->
            <div id="jumlah_orang" class="mb-3" style="display:none;">
                <label for="jumlah" class="form-label">Jumlah Orang</label>
                <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" min="1" 
                    placeholder="Masukkan Jumlah Orang" value="{{ old('jumlah_orang') }}">
            </div>
        </div>



        <!-- Tanggal Kunjungan -->
        <div class="mb-3">
            <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
            <input type="date" class="form-control @error('tanggal_kunjungan') is-invalid @enderror" id="tanggal_kunjungan" value="{{ old('tanggal_kunjungan') }}" name="tanggal_kunjungan" required>
            @error('tanggal_kunjungan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tujuan Kunjungan -->
        <div class="mb-3">
            <label for="tujuan_kunjungan" class="form-label">Tujuan Kunjungan</label>
            <textarea class="form-control" id="tujuan_kunjungan" name="tujuan_kunjungan" rows="3" placeholder="Tulis Tujuan Kunjungan" required>{{ old('tujuan_kunjungan') }}</textarea>
        </div>

        <!-- Unggah Foto KTP -->
        <div class="file-input-container">
            <label for="fotoKTP" class="form-label">Unggah Foto KTP </label> 
            <div class="small text-danger">* File diizinkan: JPG, JPEG, PNG</div>
            <div class="small text-danger">* Ukuran maksimal: 2MB</div>
            <input type="file" class="form-control @error('url_foto_ktp') is-invalid @enderror" id="fotoKTP" name="url_foto_ktp" accept="image/*" required>
            @error('url_foto_ktp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Unggah Foto Selfie -->
        <div class="file-input-container">
            <label for="fotoSelfie" class="form-label">Unggah Foto Selfie</label>
            <div class="small text-danger">* File diizinkan: JPG, JPEG, PNG</div>
            <div class="small text-danger">* Ukuran maksimal: 2MB</div>
            <input type="file" class="form-control @error('url_foto_selfie') is-invalid @enderror" id="fotoSelfie" name="url_foto_selfie" accept="image/*" required>
            @error('url_foto_selfie')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="submit-btn-container">
            <button type="submit" class="btn btn-success">Kirim Permohonan</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Menangani tampilan input jumlah orang berdasarkan jenis pengunjung
        var jenisPengunjungRadios = document.querySelectorAll('input[name="jenis_pengunjung_id"]');
        var jumlahOrangContainer = document.getElementById('jumlah_orang');

        jenisPengunjungRadios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (this.value === 'Perkelompok') {
                    jumlahOrangContainer.style.display = 'block';
                    jumlahOrangContainer.querySelector('input').setAttribute('required', 'required');
                } else {
                    jumlahOrangContainer.style.display = 'none';
                    jumlahOrangContainer.querySelector('input').removeAttribute('required');
                    jumlahOrangContainer.querySelector('input').value = ''; // Reset nilai input
                }
            });
        });

        // Menangani tampilan pilihan tambahan untuk kategori informasi publik Pertanian
        var kategoriInformasiSelect = document.getElementById('kategori_informasi');
        var pilihanPertanianContainer = document.getElementById('pilihanPertanianContainer');
        pilihanPertanianContainer.style.display = 'none'; // Sembunyikan secara default

        kategoriInformasiSelect.addEventListener('change', function () {
            if (this.value == '1') { // Gantilah '1' dengan ID kategori Pertanian yang sesuai
                pilihanPertanianContainer.style.display = 'block';
                var pilihanRadios = document.querySelectorAll('input[name="pilihan_pertanian"]');
                pilihanRadios.forEach(function (radio) {
                    radio.setAttribute('required', 'required');
                });
            } else {
                pilihanPertanianContainer.style.display = 'none';
                var pilihanRadios = document.querySelectorAll('input[name="pilihan_pertanian"]');
                pilihanRadios.forEach(function (radio) {
                    radio.removeAttribute('required');
                    radio.checked = false; // Reset pilihan radio
                });
            }
        });

        // Memastikan tampilan yang benar pada load awal
        jenisPengunjungRadios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (this.value === '2') { // Gantilah '2' dengan ID yang sesuai untuk Perkelompok
                    jumlahOrangContainer.style.display = 'block';
                    jumlahOrangContainer.querySelector('input').setAttribute('required', 'required');
                } else {
                    jumlahOrangContainer.style.display = 'none';
                    jumlahOrangContainer.querySelector('input').removeAttribute('required');
                    jumlahOrangContainer.querySelector('input').value = ''; // Reset nilai input
                }
            });
        });

        // Memastikan tampilan yang benar pada load awal
        jenisPengunjungRadios.forEach(function (radio) {
            if (radio.checked && radio.value === '2') { // Gantilah '2' dengan ID yang sesuai untuk Perkelompok
                jumlahOrangContainer.style.display = 'block';
            } else {
                jumlahOrangContainer.style.display = 'none';
            }
        });
    });
    

    // Fungsi Tanggal
    const dateInput = document.getElementById('tanggal_kunjungan');

    // Mendapatkan tanggal hari ini
    const today = new Date();
    const todayISO = today.toISOString().split('T')[0];

    // Mengatur tanggal minimum sebagai besok
    today.setDate(today.getDate() + 1);
    const minDate = today.toISOString().split('T')[0];
    dateInput.setAttribute('min', minDate);

    // Fungsi untuk memeriksa apakah hari Sabtu atau Minggu
    function isWeekend(date) {
        const day = new Date(date).getDay();
        return (day === 6 || day === 0); // 6 = Sabtu, 0 = Minggu
    }

    // Event listener untuk memblokir Sabtu, Minggu, dan hari ini
    dateInput.addEventListener('input', function() {
        const selectedDate = this.value;

        // Jika hari Sabtu atau Minggu, reset value dan tampilkan alert
        if (isWeekend(selectedDate)) {
            alert('Kunjungan tidak dapat dilakukan pada hari Sabtu atau Minggu.');
            this.value = '';
        }
    });
</script>


@endsection
