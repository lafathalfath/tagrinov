@extends('layouts.admin')
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Kelola Family';
</script>
<div class="container">
    <h2>Kelola Family</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page">Kelola Family</li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-md-5">
            <form method="GET" action="{{ route('family.getAll') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control col-md-4" placeholder="Cari family" value="{{ request()->get('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    <a href="{{ route('family.getAll') }}" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
                </div>
            </form>
        </div>
        <div class="col-md d-flex justify-content-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createFamilyModal">
                <i class="fa fa-plus"></i> Tambah Family
            </button>
        </div>
    </div>

    <!-- Family Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($family as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editFamilyModal{{ $item->id }}">
                            Edit
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteFamilyModal{{ $item->id }}">
                            Hapus
                        </button>
                    </td>
                </tr>

                <!-- Edit Family Modal -->
                <div class="modal fade" id="editFamilyModal{{ $item->id }}" tabindex="-1" aria-labelledby="editFamilyModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('family.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editFamilyModalLabel">Edit Family</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Family</label>
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

                <!-- Delete Family Modal -->
                <div class="modal fade" id="deleteFamilyModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteFamilyModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteFamilyModalLabel">Hapus Family</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus family "{{ $item->nama }}"?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('family.destroy', $item->id) }}" method="POST">
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
    {{ $family->links('pagination::bootstrap-5') }}
</div>

<!-- Create Family Modal -->
<div class="modal fade" id="createFamilyModal" tabindex="-1" aria-labelledby="createFamilyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('family.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createFamilyModalLabel">Tambah Family</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Family</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama family" required>
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
