@extends('layouts.main')
@section('content')
<style>
    .container-tanaman {
        padding: 20px 100px;
        text-align: center;
    }
    .search-bar {
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .search-bar input, .search-bar select {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 20px;
    }
    .search-bar input {
        margin-right: 10px;
    }
    h2 {
        background-color: #00573d;
        color: white;
        padding: 15px;
        text-align: center;
        margin-top: 10px;
    }
    .seed-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        justify-items: center;
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
<div class="container-tanaman">
    <h2>Koleksi Tanaman</h2>
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Cari">
        <select id="category-select">
            <option value="">Semua Kategori</option>
            @foreach ($jenis_kategori as $kat)
                <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="seed-grid" id="seed-grid">
        {{-- @foreach ($tanaman as $tm)
            <div class="seed-item" data-name="{{ $tm->nama }}" data-category="{{ $tm->kategori }}">
                <a href="{{ route('tanaman.detail', $tm->id) }}"><img src="{{ asset('images/seed1.png') }}" alt="{{ $tm->nama }}">
                <p>{{ $tm->nama }}</p></a>
            </div>
        @endforeach --}}
        @foreach ($tanaman as $tm)
            <div class="seed-item" data-name="{{ $tm->nama }}" data-category="{{ $tm->jenis->nama }}">
                <a href="{{ route('tanaman.detail', Crypt::encryptString($tm->id)) }}"><img src="{{ asset('images/kangkung.jpeg') }}" alt="{{ $tm->nama }}">
                <p>{{ $tm->nama }}</p></a>
            </div>
        @endforeach
    </div>
</div>
<script>
    document.getElementById('search-input').addEventListener('input', filterItems);
    document.getElementById('category-select').addEventListener('change', filterItems);

    function filterItems() {
        const searchQuery = document.getElementById('search-input').value.toLowerCase();
        const selectedCategory = document.getElementById('category-select').value.toLowerCase();
        const seedItems = document.querySelectorAll('.seed-item');

        seedItems.forEach(item => {
            const itemName = item.getAttribute('data-name').toLowerCase();
            const itemCategory = item.getAttribute('data-category').toLowerCase();
            const matchesSearch = itemName.includes(searchQuery);
            const matchesCategory = selectedCategory === "" || itemCategory.includes(selectedCategory);

            if (matchesSearch && matchesCategory) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>

@endsection
