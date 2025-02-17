@extends('layouts.main')
@section('content')

<div class="container">
    <h3>Detail Benih</h3>
    <div class="card">
        <img src="{{ asset('images/seed1.png') }}" alt="{{ $benih->nama }}" class="card-img-top">
        <div class="card-body">
            <h4>{{ $benih->nama }}</h4>
            <p><strong>Deskripsi:</strong> {{ $benih->deskripsi }}</p>
            <p><strong>Stok:</strong> {{ $benih->stok }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($benih->harga, 0, ',', '.') }}</p>
        </div>
    </div>
</div>

@endsection
