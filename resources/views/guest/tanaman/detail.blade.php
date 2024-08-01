@extends('layouts.main')
@section('content')
<style>
    .container-tanaman {
        padding: 20px 100px;
    }
    .image-detail {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 20px;
    }
    .image-detail img {
        width: 50%;
        height: auto;
        border-radius: 8px;
    }
    .detail-text {
        max-width: 50%;
    }
    .detail-text h2 {
        margin-top: 0;
    }
</style>
    <div class="container-tanaman">
        <h1>Kangkung</h1>
        <div class="image-detail">
            <img src="{{ asset('images/tumis.jpg') }}" alt="Kangkung">
            @if ($tanaman->url_gambar)
                <img src="{{ $tanaman->url_gambar }}" alt="{{ $tanaman->url_gambar }}">
            @endif
            <div class="detail-text">
                <h2>Detail Tanaman {{ $tanaman->nama }}</h2>
                <p><strong>Nama Ilmiah:</strong> {{ $tanaman->nama_latin }}</p>
                <p><strong>Nama Daerah:</strong> {{ $tanaman->nama_daerah }}</p>
                @if ($tanaman->entitas_detail->varietas)
                    <p><strong>Varietas:</strong> {{ $tanaman->entitas_detail->varietas }}</p>
                @endif
                <p><strong>Deskripsi:</strong> {{ $tanaman->entitas_detail->deskripsi }}</p>
                @if ($tanaman->entitas_detail->manfaat)
                    <p><strong>Manfaat:</strong>{{ $tanaman->entitas_detail->manfaat }}</p>
                @endif
                @if ($tanaman->entitas_detail->kandungan)
                    <p><strong>Manfaat:</strong>{{ $tanaman->entitas_detail->kandungan }}</p>
                @endif
                @if ($tanaman->entitas_detail->keunggulan)
                    <p><strong>Potensi Hasil:</strong> {{ $tanaman->entitas_detail->keunggulan }}</p>
                @endif
                @if ($tanaman->entitas_detail->potensi_hasil)
                    <p><strong>Potensi Hasil:</strong> {{ $tanaman->entitas_detail->potensi_hasil }}</p>
                @endif
                @if ($tanaman->entitas_detail->agroekosistem)
                    <p><strong>Potensi Hasil:</strong> {{ $tanaman->entitas_detail->agroekosistem }}</p>
                @endif
                @if ($tanaman->entitas_detail->syarat_tumbuh)
                    <p><strong>Potensi Hasil:</strong> {{ $tanaman->entitas_detail->syarat_tumbuh }}</p>
                @endif
                
                {{-- <ul>
                    <li>Mengandung banyak vitamin dan mineral</li>
                    <li>Bagus untuk kesehatan mata</li>
                    <li>Membantu menjaga kesehatan pencernaan</li>
                </ul> --}}
                {{-- <p><strong>Cara Menanam:</strong> Kangkung bisa ditanam dengan cara menyemai benih langsung di tanah yang subur dan cukup air. Perawatan yang baik akan menghasilkan tanaman kangkung yang subur dan siap panen dalam beberapa minggu.</p> --}}
            </div>
        </div>
    </div>
@endsection
