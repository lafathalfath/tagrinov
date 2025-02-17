@extends('layouts.admin')

@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Kelola Stok Benih';
</script>
<div class="container">
    <h2>Daftar Benih</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page">Kelola Stok Benih</li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-md-5">
            <form method="GET" action="{{ route('benih.getAll') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control col-md-4" placeholder="Cari stok benih.." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    <a href="{{ route('benih.getAll') }}" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
                </div>
            </form>
        </div>
        <div class="col-md d-flex justify-content-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBenihModal">
                <i class="fa fa-plus"></i> Tambah Benih
            </button>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Netto</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                    @if($benih->isEmpty())
            <tr>
                <td colspan="8" class="text-center text-danger fw-bold">
                    Data benih belum tersedia.
                </td>
            </tr>
        @else
            @foreach($benih as $item)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->netto }}gr</td>
                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>
                        @if($item->url_gambar && is_array(json_decode($item->url_gambar, true)))
                            @foreach(json_decode($item->url_gambar) as $gambar)
                                <img src="{{ asset('storage/' . $gambar) }}" width="50">
                            @endforeach
                        @else
                            -
                        @endif                    
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBenihModal{{ $item->id }}">Edit</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteBenihModal{{ $item->id }}">Hapus</button>
                    </td>
                </tr>

       {{-- Modal Edit --}}
       <div class="modal fade" id="editBenihModal{{ $item->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('benih.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Benih</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control">{{ $item->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" value="{{ $item->stok }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" value="{{ $item->harga }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="netto" class="form-label">Netto</label>
                            <input type="number" name="netto" class="form-control" value="{{ $item->netto }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" value="{{ $item->lokasi }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                        <div class="mb-2">
                            @if($item->url_gambar)
                                @foreach(json_decode($item->url_gambar) as $gambar)
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('storage/' . $gambar) }}" width="50" class="me-2">
                                        <input type="checkbox" name="hapus_gambar[]" value="{{ $gambar }}"> Hapus
                                    </div>
                                @endforeach
                            @else
                                <p>- Tidak ada gambar -</p>
                            @endif
                        </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambarbaru" class="form-label">Gambar Baru</label>
                            <input type="file" name="url_gambar[]" class="form-control mb-2" accept="image/*" multiple>
                            <small class="text-muted">Maks 3 gambar yang diunggah</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

                {{-- Modal Konfirmasi Hapus --}}
                <div class="modal fade" id="deleteBenihModal{{ $item->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus benih <strong>{{ $item->nama }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('benih.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
                {{-- Modal Tambah Benih --}}
                <div class="modal fade" id="addBenihModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('benih.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Benih</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama benih" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi benih" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="number" class="form-control" id="stok" name="stok" placeholder="Jumlah stok" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" class="form-control" id="stok" name="harga" placeholder="Harga benih (cont: 12000)" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="netto" class="form-label">Netto</label>
                                        <input type="number" class="form-control" id="netto" name="netto" placeholder="Berat Bersih (Gram)" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lokasi" class="form-label">Lokasi</label>
                                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi tersedia" value="Taman Agro Inovasi - Jl. Tentara Pelajar No.10, RT.01/RW.07, Ciwaringin, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16124" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar (Maks 3)</label>
                                        <input type="file" name="url_gambar[]" class="form-control" accept="image/*">
                                        <input type="file" name="url_gambar[]" class="form-control" accept="image/*">
                                        <input type="file" name="url_gambar[]" class="form-control" accept="image/*">
                                        <small class="text-muted">Wajib unggah minimal 1 gambar</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

        </tbody>
    </table>
    <!-- Pagination -->
    {{ $benih->links('pagination::bootstrap-5') }}
</div>
@endsection
