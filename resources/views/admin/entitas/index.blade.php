@extends('layouts.admin')
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Entitas';
</script>
<div class="container">
    <h2>Daftar Koleksi</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page">Daftar Koleksi</li>
        </ol>
    </nav>
    <!-- Create Button -->
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fa fa-plus"></i> Tambahkan</button>

    <form method="GET" action="{{ route('entitas.getAll') }}">
        <div class="row mb-3">
            <!-- Pencarian Nama -->
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Cari.." value="{{ request('search') }}">
            </div>
    
            <!-- Filter Family -->
            <div class="col-md-3">
                <select class="form-control family-select" name="family_id">
                    <option value="">Semua Family</option>
                    @foreach($family as $familyItem)
                        <option value="{{ $familyItem->id }}" {{ request('family_id') == $familyItem->id ? 'selected' : '' }}>
                            {{ $familyItem->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <!-- Filter Jenis -->
            <div class="col-md-3">
                <select class="form-control jenis-select" name="jenis_id">
                    <option value="">Semua Jenis</option>
                    @foreach($jenis as $jenisItem)
                        <option value="{{ $jenisItem->id }}" {{ request('jenis_id') == $jenisItem->id ? 'selected' : '' }}>
                            {{ $jenisItem->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <!-- Filter Kategori -->
            <div class="col-md-3">
                <select class="form-control kategori-select" name="kategori_id">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $kategoriItem)
                        <option value="{{ $kategoriItem->id }}" {{ request('kategori_id') == $kategoriItem->id ? 'selected' : '' }}>
                            {{ $kategoriItem->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <!-- Tombol Filter dan Reset -->
            <div class="col-md-3 mt-3">
                <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i> Filter</button>
                <a href="{{ route('entitas.getAll') }}" class="btn btn-danger ms-2 btn-sm"><i class="fa fa-eraser"></i> Reset</a>
            </div>
        </div>
    </form>
    
    

    <!-- Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                {{-- <th>Nama Latin</th> --}}
                {{-- <th>Nama Daerah</th> --}}
                <th>Family</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Kode QR</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entitas as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                {{-- <td>{{ $item->nama_latin }}</td> --}}
                {{-- <td>{{ $item->nama_daerah }}</td> --}}
                <td>{{ $item->family ? $item->family->nama : '-' }}</td>
                <td>{{ $item->jenis->nama }}</td>
                <td>{{ $item->kategori->nama }}</td>
                <td>
                    {{-- <button class="btn btn-primary btn-sm" title="Lihat QR"><i class="fa-solid fa-qrcode"></i> Lihat QR</button> --}}
    
                    <!-- Tombol untuk membuka modal -->
                    <button type="button" class="btn btn-primary btn-sm" title="Lihat QR" data-toggle="modal" data-target="#qrModal{{ $item->id }}">
                        <i class="fa-solid fa-qrcode"></i> Lihat QR
                    </button>
    
                    <!-- Modal untuk menampilkan QR code -->
                    {{-- <div class="modal fade" id="qrModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="qrModalLabel{{ $item->id }}">QR Code untuk {{ $item->nama }}</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <!-- Tampilkan QR code dari URL SVG -->
                                    <img src="{{ route('entitas.qrcode', $item->id) }}" alt="QR Code untuk {{ $item->nama }}" />
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Modal untuk menampilkan QR code -->
                    <div class="modal fade" id="qrModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="background-color: #faf2cc;">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="qrModalLabel{{ $item->id }}"><i class="fa-solid fa-qrcode"></i> QR Code</h5>
                                    <button type="button" class="btn-close bg-white" data-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body d-flex align-items-center justify-content-center" style="gap: 40px;">
                                    <!-- Kolom kiri untuk nama tanaman dan nama latin -->
                                    <div>
                                        <h5 style="margin: 0; font-weight: bold;">{{ $item->nama }}</h5>
                                        <p style="font-style: italic; color: #555;">{{ $item->nama_latin }}</p>
                                    </div>

                                    <!-- Kolom kanan untuk QR Code -->
                                    <div>
                                        <img src="{{ route('entitas.qrcode', $item->id) }}" alt="QR Code untuk {{ $item->nama }}"/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                                    <button type="button" class="btn btn-sm btn-primary" onclick="printQRCode('qrModal{{ $item->id }}', '{{ $item->nama }}')"><i class="fa-solid fa-print"></i> View & Print</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editEntitasModal{{ $item->id }}" title="Edit"><i class="fa-solid fa-pen-to-square" style="color: #FFF;"></i></button>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editEntitasModal{{ $item->id }}" tabindex="-1" aria-labelledby="editEntitasModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg"> <!-- Menambahkan modal-lg untuk membuat modal lebih lebar -->
                            <div class="modal-content">
                                <form action="{{ route('entitas.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header bg-warning text-dark">
                                        <h5 class="modal-title" id="editEntitasModalLabel{{ $item->id }}">Edit Entitas</h5>
                                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Kolom kiri -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $item->nama }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_latin" class="form-label">Nama Latin</label>
                                                    <input type="text" class="form-control" id="nama_latin" name="nama_latin" value="{{ $item->nama_latin }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_daerah" class="form-label">Nama Daerah</label>
                                                    <input type="text" class="form-control" id="nama_daerah" name="nama_daerah" value="{{ $item->nama_daerah }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="family_id" class="form-label">Family</label>
                                                    <select class="form-control family-select" name="family_id" id="family_id">
                                                        @foreach($family as $familyItem)
                                                            <option value="{{ $familyItem->id }}" {{ $familyItem->id == $item->family_id ? 'selected' : '' }}>
                                                                {{ $familyItem->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Kolom kanan -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="kategori_id" class="form-label">Kategori</label>
                                                    <select class="form-control kategori-select" name="kategori_id" id="kategori_id">
                                                        @foreach($kategori as $kategoriItem)
                                                            <option value="{{ $kategoriItem->id }}" {{ $kategoriItem->id == $item->kategori_id ? 'selected' : '' }}>
                                                                {{ $kategoriItem->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenis_id" class="form-label">Jenis</label>
                                                    <select class="form-control jenis-select" name="jenis_id" id="jenis_id">
                                                        @foreach($jenis as $jenisItem)
                                                            <option value="{{ $jenisItem->id }}" {{ $jenisItem->id == $item->jenis_id ? 'selected' : '' }}>
                                                                {{ $jenisItem->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Display current image (if available) -->
                                                @if ($item->url_gambar)
                                                    <div class="mb-3">
                                                        <label for="current_image" class="form-label">Gambar 
                                                            <!-- Tombol kecil untuk toggle input gambar -->
                                                            <small class="text-primary" id="ubahGambarBtn{{ $item->id }}" style="cursor: pointer;">[Ubah gambar]</small>
                                                        </label><br>
                                                        <img src="{{ $item->url_gambar }}" alt="{{ $item->nama }}" width="100">
                                                    </div>

                                                    <!-- File input for new image, awalnya disembunyikan -->
                                                    <div class="mb-3" id="uploadGambarContainer{{ $item->id }}" style="display: none;">
                                                        <label for="url_gambar" class="form-label">Unggah gambar <small class="text-danger">(PNG, JPEG, JPG - Max 2MB)</small></label>
                                                        <input type="file" class="form-control" name="url_gambar">
                                                    </div>
                                                @else
                                                    <!-- Jika gambar tidak ada, tampilkan langsung input gambar -->
                                                    <div class="mb-3">
                                                        <label for="url_gambar" class="form-label">Unggah gambar <small class="text-danger">(PNG, JPEG, JPG - Max 2MB)</small></label>
                                                        <input type="file" class="form-control" name="url_gambar">
                                                    </div>
                                                @endif

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function () {
                                                        const ubahGambarBtn = document.getElementById('ubahGambarBtn{{ $item->id }}');
                                                        const uploadGambarContainer = document.getElementById('uploadGambarContainer{{ $item->id }}');

                                                        // Jika tombol Ubah gambar ada, tambahkan event listener
                                                        if (ubahGambarBtn) {
                                                            // Toggle show/hide input gambar saat tombol [Ubah gambar] diklik
                                                            ubahGambarBtn.addEventListener('click', function () {
                                                                if (uploadGambarContainer.style.display === 'none') {
                                                                    uploadGambarContainer.style.display = 'block'; // Menampilkan input unggah gambar
                                                                    ubahGambarBtn.textContent = '[Batal]'; // Mengubah teks tombol menjadi Batal
                                                                } else {
                                                                    uploadGambarContainer.style.display = 'none'; // Menyembunyikan input unggah gambar
                                                                    ubahGambarBtn.textContent = '[Ubah gambar]'; // Mengubah teks tombol kembali ke Ubah gambar
                                                                }
                                                            });
                                                        }
                                                    });
                                                </script>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Button -->
                    <a href="{{ route('entitas.detail.getById', $item->id) }}" class="btn btn-success btn-sm" title="Detail">Detail</a>

                    <!-- Delete Button with Modal -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $item->id }}" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                    
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal-{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus entitas "{{ $item->nama }}"?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('entitas.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $entitas->links('pagination::bootstrap-5') }}

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Mengubah ukuran modal agar lebih lebar -->
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="createModalLabel">Tambah Koleksi</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('entitas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_latin" class="form-label">Nama Latin</label>
                                    <input type="text" name="nama_latin" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_daerah" class="form-label">Nama Daerah</label>
                                    <input type="text" name="nama_daerah" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori</label>
                                    <select name="kategori_id" class="form-control" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_id" class="form-label">Jenis</label>
                                    <select name="jenis_id" class="form-control" required>
                                        <option value="" disabled selected>Pilih Jenis</option>
                                        @foreach ($jenis as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="family_id" class="form-label">Family</label>
                                    <select name="family_id" class="form-control family-select" required>
                                        <option value="" disabled selected>Pilih Family</option>
                                        @foreach ($family as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="url_gambar" class="form-label">Unggah Gambar <small class="text-danger">(PNG, JPEG, JPG - Max 2MB)</small></label>
                                    <input type="file" class="form-control" id="url_gambar" name="url_gambar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambahkan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Import libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.3.1/html-docx.min.js"></script>

<script>
function printQRCode(modalId, nama) {
    // Ambil konten modal
    var modalContent = document.getElementById(modalId).querySelector('.modal-body').innerHTML;

    // Membuat jendela baru untuk mencetak
    var printWindow = window.open('', '_blank', 'width=800,height=600');
    printWindow.document.write(`
        <html>
            <head>
                <title>${nama} QR Code</title>
                <style>
                    @page {
                        size: landscape;
                        margin: 20mm;
                    }
                    body {
                        font-family: Arial, sans-serif;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 100vh;
                        background-color: #faf2cc;
                        margin: 0;
                    }
                    .content {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 100px;
                        text-align: center;
                    }
                    h5 {
                        margin: 0;
                        font-weight: bold;
                        font-size: 40px;
                    }
                    p {
                        margin: 10 0;
                        font-style: italic;
                        color: #555;
                        font-size: 30px;
                    }
                    img {
                        width: 300px;
                        height: 300px;
                    }
                </style>
            </head>
            <body>
                <div class="content">
                    ${modalContent}
                </div>
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}


</script>
@endsection
