@extends('layouts.master');
@section('content')
<div class="container mt-5">
    <br>
   <center> <h2>Testimoni</h2></center>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap Pelapor</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Pelapor</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="visit_date" class="form-label">Tanggal Kunjungan</label>
            <input type="date" class="form-control" id="visit_date" name="visit_date" required>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating Pengunjung</label>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5" class="fas fa-star"></label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4" class="fas fa-star"></label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3" class="fas fa-star"></label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2" class="fas fa-star"></label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1" class="fas fa-star"></label>
            </div>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Kesan Pesan</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
