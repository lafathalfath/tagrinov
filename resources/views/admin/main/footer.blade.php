@extends('layouts.admin')
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Edit Footer';
</script>

<div class="container">
    <h2>Edit Footer</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page">Edit Footer</li>
        </ol>
    </nav>
    <form action="{{ route('footer.update', 1) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Link Google Maps</label>
            <div class="small text-danger">
                * <a href="https://maps.google.com/" target="_blank">Google Maps</a> > Tentukan titik lokasi > Share > Embed a map > Copy HTML <br>
                * Contoh: <code>&lt;iframe src="XX"&gt;&lt;/iframe&gt;</code>
            </div>
            <input type="text" name="map_link" class="form-control" value="{{ $footer->map_link }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $footer->phone }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Fax</label>
            <input type="text" name="fax" class="form-control" value="{{ $footer->fax }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $footer->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="address" class="form-control">{{ $footer->address }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Link Website</label>
            <input type="url" name="website_link" class="form-control" value="{{ $footer->website_link }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Facebook</label>
            <input type="url" name="facebook_link" class="form-control" value="{{ $footer->facebook_link }}">
        </div>

        <div class="mb-3">
            <label class="form-label">YouTube</label>
            <input type="url" name="youtube_link" class="form-control" value="{{ $footer->youtube_link }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Instagram</label>
            <input type="url" name="instagram_link" class="form-control" value="{{ $footer->instagram_link }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Twitter</label>
            <input type="url" name="twitter_link" class="form-control" value="{{ $footer->twitter_link }}">
        </div>

        <div class="mb-3">
            <label class="form-label">TikTok</label>
            <input type="url" name="tiktok_link" class="form-control" value="{{ $footer->tiktok_link }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
