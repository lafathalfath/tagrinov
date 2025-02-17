@extends('layouts.main')
@section('content')
<style>
    .search-bar {
        margin: 20px 0px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .search-bar input, .search-bar select {
        padding: 5px;
        font-size: 17px;
        border: 1px solid #ccc;
        border-radius: 20px;
    }
    .search-bar input {
        margin-right: 10px;
    }
    h3 {
        background-color: #00573d;
        color: white;
        padding: 15px;
        text-align: center;
        margin-top: 100px;
    }
    .seed-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        justify-items: center;
        margin-bottom: 20px;
    }
    .seed-item {
        border: 1px solid #ccc;
        padding: 10px;
        width: 100%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        box-sizing: border-box;
        text-align: center;
    }
    .seed-item:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .seed-item img {
        width: 100%;
        height: auto;
        aspect-ratio: 1/1;
        border-radius: 8px;
        object-fit: cover;
    }
    .seed-item p {
        margin: 10px 0 0;
        font-weight: 500;
        color: #333;
    }
    .seed-item a {
        text-decoration: none;
        color: inherit;
    }
</style>

<div class="container">
    <h3>Stok Benih</h3>

    <!-- FORM PENCARIAN -->
    <div class="col-md-6 mt-3 mb-3">
        <form action="{{ route('stokbenih.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari benih..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                <a href="{{ route('stokbenih.index') }}" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
            </div>
        </form>
    </div>

    <!-- DAFTAR BENIH -->
    <div class="seed-grid">
        @forelse ($benih as $item)
            <div class="seed-item">
                <a href="{{ route('stokbenih.detail', Crypt::encryptString($item->id)) }}">
                    @php
                        $gambar = $item->url_gambar ? json_decode($item->url_gambar, true) : null;
                        $gambarPertama = $gambar && count($gambar) > 0 ? asset('storage/' . $gambar[0]) : asset('images/default-seed.png');
                    @endphp
                    <img src="{{ $gambarPertama }}" alt="{{ $item->nama }}">
                    <p>{{ $item->nama }}</p>
                    <div class="fw-semibold text-danger fs-5">Rp{{ number_format($item->harga, 0, ',', '.') }}</div>
                </a>
            </div>
            @empty
                <div class="col-12 d-flex justify-content-center mt-4">
                    <div class="card text-center border-danger">
                        <div class="card-body">
                            <h5 class="text-danger">Benih Saat Ini Belum Tersedia</h5>
                            <p class="text-muted">Kami sedang menambahkan stok benih baru. Silakan cek kembali nanti.</p>
                        </div>
                    </div>
                </div>
            @endforelse
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $benih->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
