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
    <h3>Koleksi Tanaman</h3>
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
                <a href="{{ route('tanaman.detail', Crypt::encrypt($tm->id)) }}">
                    <img src="{{ asset('images/kangkung.jpeg') }}" alt="{{ $tm->nama }}">
                    <p>{{ $tm->nama }}</p>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- "First" link -->
                @if ($tanaman->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $tanaman->url(1) }}" aria-label="First">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif

                <!-- Previous Page Link -->
                @if ($tanaman->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $tanaman->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                @endif

                <!-- Pagination Links -->
                @foreach ($tanaman->getUrlRange(max(1, $tanaman->currentPage() - 2), min($tanaman->lastPage(), $tanaman->currentPage() + 2)) as $page => $url)
                    <li class="page-item {{ $page == $tanaman->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <!-- Next Page Link -->
                @if ($tanaman->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $tanaman->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                @endif

                <!-- "Last" link -->
                @if ($tanaman->currentPage() < $tanaman->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $tanaman->url($tanaman->lastPage()) }}" aria-label="Last">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
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
