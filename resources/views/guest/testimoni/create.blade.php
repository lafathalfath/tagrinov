@extends('layouts.main')

@section('content')
<style>
    .container-testimoni {
        padding: 20px 100px;
    }
    h2 {
        background-color: #00a65a;
        color: white;
        padding: 20px;
        text-align: center;
        margin-top: 0;
        border-radius: 8px 8px 0 0;
    }
    .form-section {
        padding: 20px 0px;
    }
    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }
    .form-group label {
        margin-bottom: 5px;
        font-weight: 600;
    }
    .form-group input, .form-group textarea, .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }
    .form-group .rating {
        display: flex;
        gap: 10px;
        font-size: 30px;
        flex-direction: row-reverse;
        width: 30%;
    }
    .form-group .rating input {
        display: none;
    }
    .form-group .rating label {
        cursor: pointer;
        color: #ccc;
    }
    .form-group .rating input:checked ~ label {
        color: gold;
    }
    .form-group .rating input:hover ~ label {
        color: gold;
    }
    .form-group .rating input:checked ~ label:hover {
        color: gold;
    }
    .btn-feedback {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        background-color: #28a745;
        color: white;
        width: 100%;
    }
    .form-group.half {
        width: 48%;
    }
    .form-group.full {
        width: 100%;
    }
    .form-row {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .feedback {
        margin: 20px 0px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        display: flex;
        align-items: center;
    }
    .feedback .info {
        margin-left: 8px;
    }
    .feedback .feedback-name {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }
    .feedback .info .date {
        font-size: 14px;
        color: gray;
    }
    .feedback .info .rating {
        color: gold;
        margin: 5px 0;
    }
    .feedback .info p {
        margin: 0;
    }
    .foto-kunjungan {
        margin: 10px 0px;
        width: auto;
        height: 200px;
        border-radius: 10px;
    }
</style>
</head>
<body>
    <div class="container-testimoni">
        <h2>Ulasan Kunjungan</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="form-section">
            <form action="{{ url('/testimoni') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group half">
                        <label for="nama">Nama Lengkap/Instansi</label>
                        <input type="text" id="nama" name="nama" placeholder="Nama atau Instansi" required>
                    </div>
                    <div class="form-group half">
                        <label for="rating">Rating</label>
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" required><label for="star5">&#9733;</label>
                            <input type="radio" id="star4" name="rating" value="4"><label for="star4">&#9733;</label>
                            <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
                            <input type="radio" id="star2" name="rating" value="2"><label for="star2">&#9733;</label>
                            <input type="radio" id="star1" name="rating" value="1"><label for="star1">&#9733;</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group half">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email Pengunjung" required>
                    </div>
                    <div class="form-group half">
                        <label for="tanggal">Tanggal Kunjungan</label>
                        <input type="date" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full">
                        <label for="foto">Foto (Opsional)</label>
                        <input type="file" id="foto" name="foto" accept="image/*">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full">
                        <label for="pesan">Kesan dan Pesan</label>
                        <textarea id="pesan" name="pesan" rows="4" placeholder="Isikan kesan dan pesan anda"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn-feedback">Kirim</button>
            </form>
        </div>
        @foreach($feedbacks as $feedback)
            <div class="feedback">
                <div class="info">
                    <div class="feedback-name">{{ $feedback->nama }}</div>
                    <div class="rating">
                        @for ($i = 0; $i < $feedback->rating; $i++)
                            &#9733;
                        @endfor
                        @for ($i = $feedback->rating; $i < 5; $i++)
                            &#9734;
                        @endfor
                    </div>
                    <div class="date">{{ \Carbon\Carbon::parse($feedback->tanggal)->format('F j, Y') }}</div>
                    <p>{{ $feedback->pesan }}</p>
                    @if($feedback->foto)
                        <img class="foto-kunjungan" src="{{ asset('storage/' . $feedback->foto) }}" alt="Foto">
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
{{-- </body>
    </html> --}}
