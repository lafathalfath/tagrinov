@extends('layouts.main')
@section('content')
<style>    
    .seed-item {
        border: 1px solid #ccc;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
        height: 100%;
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
    @media (min-width: 1200px) {
        .col-xl-custom {
            flex: 0 0 20%; /* 100% divided by 5 items per row */
            max-width: 20%;
        }
    }

</style>
<div class="container">
    <h3>Koleksi Tanaman</h3>
    <div class="row mb-3 mt-3 search-bar">
        <div class="col-12 col-md-6 mb-2">
            <div class="input-group">
                <input type="text" id="search-input" class="form-control" placeholder="Cari">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <select id="category-select" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach ($jenis_kategori as $kat)
                    <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row" id="seed-grid">
        @foreach ($tanaman as $tm)
            <div class="col-6 col-md-4 col-lg-3 col-xl-custom mb-4" data-category="{{ $tm->jenis->nama }}">
                <div class="seed-item">
                    <a href="{{ route('tanaman.detail', Crypt::encrypt($tm->id)) }}">
                        <img src="{{ asset('images/kangkung.jpeg') }}" class="card-img-top" alt="{{ $tm->nama }}">
                        <div class="card-body">
                            <p class="card-text">{{ $tm->nama }}</p>
                        </div>
                    </a>
                </div>
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
    const seedItems = document.querySelectorAll('.col-6, .col-md-4, .col-lg-3, .col-xl-custom');

    seedItems.forEach(item => {
        const itemName = item.querySelector('.card-text').textContent.toLowerCase();
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
