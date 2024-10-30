@extends('layouts.admin') 
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Detail';
</script>
<div class="container">
    <h2>Detail Koleksi</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('entitas.getAll') }}">Daftar Koleksi</a></li>
          <li class="breadcrumb-item" aria-current="page">Detail</li>
        </ol>
    </nav>
    <div class="alert alert-info">
        <strong>Catatan<br></strong>
        Semua isian bersifat opsional, kosongkan bila tidak diperlukan.<br>
        Anda dapat memperbesar/memperkecil kotak isian dengan cara menarik ujung pojok kanan bawah kotak isian.
    </div>
    <form action="{{ route('entitas.detail.update', $entitasDetail->entitas_id) }}" method="POST">
        @csrf {{-- Token CSRF untuk keamanan --}}

        {{-- Jika update, tambahkan method PUT --}}
        @if(isset($entitasDetail->id))
            @method('PUT')
        @endif

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="8">{{ old('deskripsi', $entitasDetail->deskripsi ?? '') }}</textarea>
        </div>

        {{-- Varietas --}}
        <div class="mb-3">
            <label for="varietas" class="form-label">Varietas</label>
            <textarea class="form-control" id="varietas" name="varietas" rows="4">{{ old('varietas', $entitasDetail->varietas ?? '') }}</textarea>
        </div>

        {{-- Potensi Hasil --}}
        <div class="mb-3">
            <label for="potensi_hasil" class="form-label">Potensi Hasil</label>
            <textarea class="form-control" id="potensi_hasil" name="potensi_hasil" rows="4">{{ old('potensi_hasil', $entitasDetail->potensi_hasil ?? '') }}</textarea>
        </div>

        {{-- Keunggulan --}}
        <div class="mb-3">
            <label for="keunggulan" class="form-label">Keunggulan</label>
            <textarea class="form-control" id="keunggulan" name="keunggulan" rows="4">{{ old('keunggulan', $entitasDetail->keunggulan ?? '') }}</textarea>
        </div>

        {{-- Manfaat --}}
        <div class="mb-3">
            <label for="manfaat" class="form-label">Manfaat</label>
            <textarea class="form-control" id="manfaat" name="manfaat" rows="4">{{ old('manfaat', $entitasDetail->manfaat ?? '') }}</textarea>
        </div>

        {{-- Agroekosistem --}}
        <div class="mb-3">
            <label for="agroekosistem" class="form-label">Agroekosistem</label>
            <textarea class="form-control" id="agroekosistem" name="agroekosistem" rows="4">{{ old('agroekosistem', $entitasDetail->agroekosistem ?? '') }}</textarea>
        </div>

        {{-- Kandungan --}}
        <div class="mb-3">
            <label for="kandungan" class="form-label">Kandungan</label>
            <textarea class="form-control" id="kandungan" name="kandungan" rows="4">{{ old('kandungan', $entitasDetail->kandungan ?? '') }}</textarea>
        </div>

        {{-- Syarat Tumbuh --}}
        <div class="mb-3">
            <label for="syarat_tumbuh" class="form-label">Syarat Tumbuh</label>
            <textarea class="form-control" id="syarat_tumbuh" name="syarat_tumbuh" rows="4">{{ old('syarat_tumbuh', $entitasDetail->syarat_tumbuh ?? '') }}</textarea>
        </div>

        {{-- Judul Buku dan URL Buku --}}
        <div class="mb-3">
            <label class="form-label">Lampiran File/Buku</label>
            <div class="input-group">
                <span class="input-group-text">Judul</span>
                <input type="text" class="form-control" name="judul_buku" 
                    placeholder="Judul Buku" 
                    value="{{ old('judul_buku', $entitasDetail->judul_buku ?? '') }}">

                <span class="input-group-text">URL</span>

                <input type="url" class="form-control" name="url_buku" 
                    placeholder="https://contoh.com" 
                    value="{{ old('url_buku', $entitasDetail->url_buku ?? '') }}">
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('entitas.getAll') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
