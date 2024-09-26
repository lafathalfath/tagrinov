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
    {{-- <!-- Search Form -->
    <form method="GET" action="{{ route('entitas.getAll') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control col-md-4" placeholder="Cari entitas" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
            <a href="{{ route('entitas.getAll') }}" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
        </div>
    </form> --}}

    <!-- Create Button -->
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fa fa-plus"></i> Tambah Entitas</button>
    {{-- <form method="GET" action="{{ route('entitas.getAll') }}">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="family_id" class="form-label">Family</label>
                <select class="form-control family-select" name="family_id" id="family_id">
                    <option value="">Semua Family</option>
                    @foreach($family as $familyItem)
                        <option value="{{ $familyItem->id }}" {{ request('family_id') == $familyItem->id ? 'selected' : '' }}>
                            {{ $familyItem->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="jenis_id" class="form-label">Jenis</label>
                <select class="form-control jenis-select" name="jenis_id" id="jenis_id">
                    <option value="">Semua Jenis</option>
                    @foreach($jenis as $jenisItem)
                        <option value="{{ $jenisItem->id }}" {{ request('jenis_id') == $jenisItem->id ? 'selected' : '' }}>
                            {{ $jenisItem->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select class="form-control kategori-select" name="kategori_id" id="kategori_id">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $kategoriItem)
                        <option value="{{ $kategoriItem->id }}" {{ request('kategori_id') == $kategoriItem->id ? 'selected' : '' }}>
                            {{ $kategoriItem->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Filter</button>
                <a href="{{ route('entitas.getAll') }}" class="btn btn-danger ms-2"><i class="fa fa-eraser"></i> Reset</a>
            </div>
        </div>
    </form> --}}
    <form method="GET" action="{{ route('entitas.getAll') }}">
        <div class="row mb-3">
            <!-- Pencarian Nama -->
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Cari entitas" value="{{ request('search') }}">
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
                    <!-- Edit Button -->
                    {{-- <a href="{{ route('entitas.getById', $item->id) }}" class="btn btn-warning">Edit</a> --}}
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editEntitasModal{{ $item->id }}">Edit</button>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editEntitasModal{{ $item->id }}" tabindex="-1" aria-labelledby="editEntitasModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('entitas.update', $item->id) }}" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editEntitasModalLabel{{ $item->id }}">Edit Entitas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
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
                                        <!-- Display current image (if available) -->
                                        @if ($item->url_gambar)
                                            <div class="mb-3">
                                                <label for="current_image" class="form-label">Gambar</label><br>
                                                <img src="{{ $item->url_gambar }}" alt="{{ $item->nama }}" width="100">
                                            </div>
                                        @endif

                                        <!-- File input for new image -->
                                        <div class="mb-3">
                                            <label for="url_gambar" class="form-label">Unggah gambar <small class="text-danger">(PNG, JPEG, JPG - Max 2MB)</small></label>
                                            <input type="file" class="form-control" name="url_gambar">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Button with Modal -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $item->id }}">Hapus</button>
                    
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal-{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                    <a href="{{ route('entitas.detail.show', $item->id) }}" class="btn btn-success btn-sm">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $entitas->links('pagination::bootstrap-5') }}

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Entitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('entitas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
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
                        <div class="mb-3">
                            <label for="family_id" class="form-label">Family</label>
                            <select name="family_id" class="form-control family-select" required>
                                <option value="" disabled selected>Pilih Family</option>
                                @foreach ($family as $item)
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
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="url_gambar" class="form-label">Unggah Gambar <small class="text-danger">(PNG, JPEG, JPG - Max 2MB)</small></label>
                            <input type="file" class="form-control" id="url_gambar" name="url_gambar">
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
@endsection
