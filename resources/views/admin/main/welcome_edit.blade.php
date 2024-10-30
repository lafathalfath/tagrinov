@extends('layouts.admin') 
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Edit Slide';
</script>
<div class="container">
    <h2>Edit Slide</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page">Edit Slide</li>
        </ol>
    </nav>
        <form action="{{ route('admin.welcome.update', $welcomeText->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title1" class="form-label">Judul 1</label>
                <input type="text" class="form-control" id="title1" name="title1" value="{{ old('title1', $welcomeText->title1) }}" required>
                @error('title1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="title2" class="form-label">Judul 2 (Hijau)</label>
                <input type="text" class="form-control" id="title2" name="title2" value="{{ old('title2', $welcomeText->title2) }}" required>
                @error('title2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $welcomeText->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
</div>
@endsection

