@extends('layouts.admin')
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Kelola Jenis';
</script>
<div class="container">
    <h2>Kelola Jenis</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page">Kelola Jenis</li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-md-5">
            <form method="GET" action="{{ route('jenis.getAll') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control col-md-4" placeholder="Cari jenis" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    <a href="{{ route('jenis.getAll') }}" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
                </div>
            </form>
        </div>
        <div class="col-md d-flex justify-content-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createJenisModal">
                <i class="fa fa-plus"></i> Tambah Jenis
            </button>
        </div>
    </div>

    <!-- Jenis Table -->
    <table class="table table-bordered">
        <thead  class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenis as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editJenisModal{{ $item->id }}">
                            Edit
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteJenisModal{{ $item->id }}">
                            Hapus
                        </button>
                    </td>
                </tr>

                <!-- Edit Jenis Modal -->
                <div class="modal fade" id="editJenisModal{{ $item->id }}" tabindex="-1" aria-labelledby="editJenisModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('jenis.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editJenisModalLabel">Edit Jenis</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Jenis</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $item->nama }}" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Jenis Modal -->
                <div class="modal fade" id="deleteJenisModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteJenisModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteJenisModalLabel">Hapus Jenis</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus jenis "{{ $item->nama }}"?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('jenis.destroy', $item->id) }}" method="POST">
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
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $jenis->links('pagination::bootstrap-5') }}
</div>

<!-- Create Jenis Modal -->
<div class="modal fade" id="createJenisModal" tabindex="-1" aria-labelledby="createJenisModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('jenis.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createJenisModalLabel">Tambah Jenis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Jenis</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama jenis" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
