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
        gap: 10px;
    }

    .btn-group-custom .btn {
        flex: 1; /* Membuat tombol mengambil ruang yang tersedia */
        min-width: 150px;
        padding: 10px;
    }

    /* Styling untuk Pilihan Pertanian */
    #pilihanPertanianContainer {
        display: none;
        margin-top: 1rem;
    }

    #pilihanPertanianContainer .form-check {
        margin-bottom: 0.5rem;
    }
</style>

<div class="container">
    <h3>Rencanakan Kunjunganmu</h3>
    <form id="visitForm" enctype="multipart/form-data">
        <!-- Nama Lengkap -->
        <div class="mb-3">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" required>
        </div>

        <!-- No HP -->
        <div class="mb-3">
            <label for="noHp" class="form-label">No HP</label>
            <input type="tel" class="form-control" id="noHp" name="noHp" required>
        </div>

        <!-- Usia -->
        <fieldset class="mb-3">
            <legend class="col-form-label" style="font-weight: bold;">Usia (tahun)</legend>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="usia1" name="usia" value="<20" required>
                <label class="form-check-label" for="usia1">&lt;20</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="usia2" name="usia" value="20-29">
                <label class="form-check-label" for="usia2">20-29</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="usia3" name="usia" value="30-39">
                <label class="form-check-label" for="usia3">30-39</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="usia4" name="usia" value="40-49">
                <label class="form-check-label" for="usia4">40-49</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="usia5" name="usia" value=">50">
                <label class="form-check-label" for="usia5">&gt;50</label>
            </div>
        </fieldset>

        <!-- Jenis Kelamin -->
        <fieldset class="mb-3">
            <legend class="col-form-label" style="font-weight: bold;">Jenis Kelamin</legend>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="lakiLaki" name="jenisKelamin" value="Laki-laki" required>
                <label class="form-check-label" for="lakiLaki">Laki-laki</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="perempuan" name="jenisKelamin" value="Perempuan">
                <label class="form-check-label" for="perempuan">Perempuan</label>
            </div>
        </fieldset>

        <!-- Asal Instansi -->
        <div class="mb-3">
            <label for="asalInstansi" class="form-label">Asal Instansi</label>
            <input type="text" class="form-control" id="asalInstansi" name="asalInstansi" placeholder="Masukkan asal instansi" required>
        </div>

        <!-- Pekerjaan -->
        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <select class="form-select" id="pekerjaan" name="pekerjaan" required>
                <option value="PNS">PNS</option>
                <option value="TNI">TNI</option>
                <option value="POLRI">POLRI</option>
                <option value="Swasta">Swasta</option>
                <option value="Wirausaha">Wirausaha</option>
                <option value="Guru">Guru</option>
                <option value="Siswa">Siswa</option>
                <option value="Mahasiswa">Mahasiswa</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <!-- Kategori Informasi Publik -->
        <div class="mb-3">
            <label for="kategoriInformasi" class="form-label">Kategori Informasi Publik</label>
            <select class="form-select" id="kategoriInformasi" name="kategoriInformasi" required>
                <option value="">-- Pilih Kategori Informasi Publik --</option>
                <option value="Pertanian">Pertanian</option>
                <option value="Anggaran dan Keuangan">Anggaran dan Keuangan</option>
                <option value="Kepegawaian">Kepegawaian</option>
                <option value="Hukum dan Perundang-undangan">Hukum dan Perundang-undangan</option>
                <option value="Pengadaan Barang dan Jasa">Pengadaan Barang dan Jasa</option>
                <option value="Lain-lain">Lain-lain</option>
            </select>
        </div>

        <!-- Pilihan Tambahan untuk Pertanian -->
        <div class="mb-3" id="pilihanPertanianContainer">
            <label class="form-label">Pilihan Pertanian</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="konsul" name="pilihanPertanian" value="Konsul">
                <label class="form-check-label" for="konsul">Konsul</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="agroeduw" name="pilihanPertanian" value="Agroeduw">
                <label class="form-check-label" for="agroeduw">Agroeduw</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="pelatihan" name="pilihanPertanian" value="Pelatihan/Bimtek">
                <label class="form-check-label" for="pelatihan">Pelatihan/Bimtek</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="magang" name="pilihanPertanian" value="Magang">
                <label class="form-check-label" for="magang">Magang</label>
            </div>
        </div>

        <!-- Pendidikan Terakhir -->
        <div class="mb-3">
            <label for="pendidikanTerakhir" class="form-label">Pendidikan Terakhir</label>
            <select class="form-select" id="pendidikanTerakhir" name="pendidikanTerakhir" required>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>
        </div>

        <!-- Jenis Pengunjung (tombol perorangan dan perkelompok) -->
        <div class="mb-3">
            <label class="form-label">Jenis Pengunjung</label>
            <div class="btn-group-custom mb-3" role="group" aria-label="Jenis Pengunjung">
                <input type="radio" class="btn-check" id="perorangan" name="jenisPengunjung" value="Perorangan" required>
                <label class="btn btn-outline-success" for="perorangan">Perorangan</label>

                <input type="radio" class="btn-check" id="perkelompok" name="jenisPengunjung" value="Perkelompok">
                <label class="btn btn-outline-success" for="perkelompok">Perkelompok</label>
            </div>
            <!-- Input untuk jumlah orang, muncul hanya jika Perkelompok dipilih -->
            <div class="mb-3" id="jumlahOrangContainer">
                <label for="jumlahOrang" class="form-label">Jumlah Orang</label>
                <input type="number" class="form-control" id="jumlahOrang" name="jumlahOrang" min="2" placeholder="Masukkan jumlah orang">
            </div>
        </div>

        <!-- Tanggal Kunjungan -->
        <div class="mb-3">
            <label for="tanggalKunjungan" class="form-label">Tanggal Kunjungan</label>
            <input type="date" class="form-control" id="tanggalKunjungan" name="tanggalKunjungan" required>
        </div>

        <!-- Tujuan Kunjungan -->
        <div class="mb-3">
            <label for="tujuanKunjungan" class="form-label">Tujuan Kunjungan</label>
            <textarea class="form-control" id="tujuanKunjungan" name="tujuanKunjungan" rows="3" required></textarea>
        </div>

        <!-- Unggah Foto KTP -->
        <div class="file-input-container">
            <label for="fotoKTP" class="form-label">Unggah Foto KTP</label>
            <input type="file" class="form-control" id="fotoKTP" name="fotoKTP" accept="image/*" required>
        </div>

        <!-- Unggah Foto Selfie -->
        <div class="file-input-container">
            <label for="fotoSelfie" class="form-label">Unggah Foto Selfie</label>
            <input type="file" class="form-control" id="fotoSelfie" name="fotoSelfie" accept="image/*" required>
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
        var jenisPengunjungRadios = document.querySelectorAll('input[name="jenisPengunjung"]');
        var jumlahOrangContainer = document.getElementById('jumlahOrangContainer');

        jenisPengunjungRadios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (this.value === 'Perkelompok') {
                    jumlahOrangContainer.style.display = 'block';
                    document.getElementById('jumlahOrang').setAttribute('required', 'required');
                } else {
                    jumlahOrangContainer.style.display = 'none';
                    document.getElementById('jumlahOrang').removeAttribute('required');
                    document.getElementById('jumlahOrang').value = ''; // Reset nilai input
                }
            });
        });

        // Menangani tampilan pilihan tambahan untuk kategori informasi publik Pertanian
        var kategoriInformasiSelect = document.getElementById('kategoriInformasi');
        var pilihanPertanianContainer = document.getElementById('pilihanPertanianContainer');

        kategoriInformasiSelect.addEventListener('change', function () {
            if (this.value === 'Pertanian') {
                pilihanPertanianContainer.style.display = 'block';
                // Menambahkan atribut required pada pilihanPertanian radios
                var pilihanRadios = document.querySelectorAll('input[name="pilihanPertanian"]');
                pilihanRadios.forEach(function (radio) {
                    radio.setAttribute('required', 'required');
                });
            } else {
                pilihanPertanianContainer.style.display = 'none';
                // Menghapus atribut required pada pilihanPertanian radios
                var pilihanRadios = document.querySelectorAll('input[name="pilihanPertanian"]');
                pilihanRadios.forEach(function (radio) {
                    radio.removeAttribute('required');
                    radio.checked = false; // Reset pilihan radio
                });
            }
        });
    });
</script>
@endsection
