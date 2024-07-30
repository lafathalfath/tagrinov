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
            <div class="detail-text">
                <h2>Detail Tanaman Kangkung</h2>
                <p><strong>Nama Ilmiah:</strong> Ipomoea aquatica</p>
                <p><strong>Deskripsi:</strong> Kangkung adalah tanaman yang sering ditanam di daerah tropis dan subtropis. Daunnya hijau dan berbentuk panjang, dan biasanya dikonsumsi sebagai sayuran. Kangkung dapat tumbuh baik di lahan basah maupun kering.</p>
                <p><strong>Manfaat:</strong></p>
                <ul>
                    <li>Mengandung banyak vitamin dan mineral</li>
                    <li>Bagus untuk kesehatan mata</li>
                    <li>Membantu menjaga kesehatan pencernaan</li>
                </ul>
                <p><strong>Cara Menanam:</strong> Kangkung bisa ditanam dengan cara menyemai benih langsung di tanah yang subur dan cukup air. Perawatan yang baik akan menghasilkan tanaman kangkung yang subur dan siap panen dalam beberapa minggu.</p>
            </div>
        </div>
    </div>
@endsection
