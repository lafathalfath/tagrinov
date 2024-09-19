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
        .date-picker-container {
            display: none;
            margin-top: 1rem;
        }

        .date-picker-container label {
            margin-right: 1rem;
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .btn-group .btn {
            border-radius: 0.375rem; 
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
    </style>

    <div class="container">
        <h3>Rencanakan Kunjunganmu</h3>
        <form id="visitForm" enctype="multipart/form-data">
            <!-- Form fields remain unchanged -->

            <div class="mb-3">
                <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" required>
            </div>

            <div class="mb-3">
                <label for="noHp" class="form-label">No HP</label>
                <input type="tel" class="form-control" id="noHp" name="noHp" required>
            </div>

            <fieldset class="mb-3">
                <legend class="col-form-label">Usia (tahun)</legend>
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

            <fieldset class="mb-3">
                <legend class="col-form-label">Jenis Kelamin</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="lakiLaki" name="jenisKelamin" value="Laki-laki" required>
                    <label class="form-check-label" for="lakiLaki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="perempuan" name="jenisKelamin" value="Perempuan">
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </fieldset>

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

            <div class="mb-3">
                <label for="kategoriInformasi" class="form-label">Kategori Informasi Publik</label>
                <select class="form-select" id="kategoriInformasi" name="kategoriInformasi" required>
                    <option value="Pertanian">Pertanian</option>
                    <option value="Anggaran dan Keuangan">Anggaran dan Keuangan</option>
                    <option value="Kepegawaian">Kepegawaian</option>
                    <option value="Hukum dan Perundang-undangan">Hukum dan Perundang-undangan</option>
                    <option value="Pengadaan Barang dan Jasa">Pengadaan Barang dan Jasa</option>
                    <option value="Lain-lain">Lain-lain</option>
                </select>
            </div>

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

            <div class="mb-3">
                <label class="form-label">Jenis Pengunjung</label>
                <div class="btn-group mb-3" role="group" aria-label="Jenis Pengunjung">
                    <input type="radio" class="btn-check" id="pelajar" name="jenisPengunjung" value="Pelajar" required>
                    <label class="btn btn-outline-success" for="pelajar">Pelajar</label>

                    <input type="radio" class="btn-check" id="umum" name="jenisPengunjung" value="Umum">
                    <label class="btn btn-outline-success" for="umum">Umum</label>

                    <input type="radio" class="btn-check" id="peneliti" name="jenisPengunjung" value="Peneliti">
                    <label class="btn btn-outline-success" for="peneliti">Peneliti</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Hari Kunjungan</label>
                <div class="btn-group mb-3" role="group" aria-label="Hari Kunjungan">
                    <input type="radio" class="btn-check" id="hariIni" name="hariKunjungan" value="Hari ini" required>
                    <label class="btn btn-outline-success" for="hariIni">Hari ini</label>

                    <input type="radio" class="btn-check" id="besok" name="hariKunjungan" value="Besok">
                    <label class="btn btn-outline-success" for="besok">Besok</label>

                    <input type="radio" class="btn-check" id="lainnya" name="hariKunjungan" value="Lainnya">
                    <label class="btn btn-outline-success" for="lainnya">Lainnya</label>
                </div>
                <div class="date-picker-container" id="datePickerContainer">
                    <label for="tanggalKunjungan" class="form-label">Tanggal Kunjungan:</label>
                    <input type="date" class="form-control" id="tanggalKunjungan" name="tanggalKunjungan">
                </div>
            </div>

            <div class="mb-3">
                <label for="tujuanKunjungan" class="form-label">Tujuan Kunjungan</label>
                <textarea class="form-control" id="tujuanKunjungan" name="tujuanKunjungan" rows="3" required></textarea>
            </div>

            <div class="file-input-container">
                <label for="fotoKTP" class="form-label">Unggah Foto KTP</label>
                <input type="file" class="form-control" id="fotoKTP" name="fotoKTP" accept="image/*" required>
            </div>

            <div class="file-input-container">
                <label for="fotoSelfie" class="form-label">Unggah Foto Selfie</label>
                <input type="file" class="form-control" id="fotoSelfie" name="fotoSelfie" accept="image/*" required>
            </div>

            <div class="submit-btn-container">
                <button type="submit" class="btn btn-success">Kirim Permohonan</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var hariKunjunganRadios = document.querySelectorAll('input[name="hariKunjungan"]');
            var datePickerContainer = document.getElementById('datePickerContainer');

            hariKunjunganRadios.forEach(function (radio) {
                radio.addEventListener('change', function () {
                    if (this.value === 'Lainnya') {
                        datePickerContainer.style.display = 'block';
                    } else {
                        datePickerContainer.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
