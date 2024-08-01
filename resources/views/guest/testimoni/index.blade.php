@extends('layouts.main')

@section('content')
<style>
        body {
            background-color: #f8f9fa;
        }
        .banner {
            background-color: #00452C;
            color: #fff;
            padding: 2rem;
            border-radius: 0px;
            text-align: center;
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        form {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 3rem; 
        }
        .col-md-6 {
            margin-bottom: 1rem !important;
        }

        label {
            font-weight: bold;
        }

        textarea {
            resize: none;
        }

        .btn-green {
            background-color: #00452C;
            color: #fff;
            border: 1px solid #00452C;
        }

        .btn-green:hover {
            background-color: #00342a;
            border-color: #00342a;
        }

        .form-check-inline {
            margin-right: 1rem;
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

        .file-input-container:last-of-type {
            margin-bottom: 2rem; 
        }

        .submit-btn-container {
            text-align: center;
            margin-top: 2rem;
        }

    h3 {
        background-color: #00573d;
        color: white;
        padding: 15px;
        text-align: center;
        margin-top: 100px;
    }
    .rating {
        display: flex;
        gap: 10px;
        font-size: 30px;
        flex-direction: row-reverse;
        justify-content: left;
    }
    .rating input {
        display: none;
    }
    .rating label {
        cursor: pointer;
        color: #ccc;
    }
    .rating input:checked ~ label {
        color: gold;
    }
    .rating input:hover ~ label {
        color: gold;
    }
    .rating input:checked ~ label:hover {
        color: gold;
    }
    .feedback {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        display: flex;
        align-items: center;
    }
    .feedback .feedback-name {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }
    .feedback .info .date {
        font-size: 14px;
        color: gray;
    }
    .feedback .info .rating {
        color: gold;
    }
    .feedback .info p {
        margin: 0;
    }
    .foto-kunjungan {
        margin-top: 10px;
        width: auto;
        height: 200px;
        border-radius: 10px;
    }
</style>
</head>
<body>
    <div class="container">
        <h3>Berikan Ulasanmu</h3>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <form action="{{ url('/testimoni') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form group col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap/Instansi</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama atau Instansi" required>
                    </div>

                    <div class="form-group col-md-6">
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
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Pengunjung" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal" class="form-label">Tanggal Kunjungan</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy" required>
                    </div>
                </div>
                <div class="file-input-container mb-3">
                    <label for="foto" class="form-label">Foto (Opsional)</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="pesan" class="form-label">Kesan dan Pesan</label>
                    <textarea id="pesan" class="form-control" name="pesan" rows="4" placeholder="Isikan kesan dan pesan anda"></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-feedback">Kirim</button>
            </form>
        <h3>Ulasan</h3>
        <form>
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
</form>
    </div>
@endsection
