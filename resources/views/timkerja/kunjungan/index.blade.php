@extends('layouts.timkerja')

@section('content')
<script>
    document.title += ' | Kelola Permohonan Kunjungan';
</script>
<div class="container">
    <h2>Kelola Permohonan Kunjungan</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('timkerja.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Permohonan Kunjungan</li>
        </ol>
    </nav>

    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('timkerja.kunjungan.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari.." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    <a href="{{ route('timkerja.kunjungan.index') }}" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
                </div>
            </form>
        </div>
        <div class="col-md d-flex justify-content-end">
            <a href="{{ route('kunjungan.exportxlsx') }}" class="btn btn-success me-2">
                <i class="fas fa-file-excel"></i>
            </a>
            <a href="{{ route('kunjungan.exportpdf') }}" class="btn btn-danger">
                <i class="fa fa-file-pdf"></i>
            </a>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Kunjungan</th>
                <th>Nomor HP</th>
                <th>Asal Instansi</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($kunjungan->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">
                        {{ $search ? 'Pencarian tidak ditemukan.' : 'Data tidak ditemukan.' }}
                    </td>
                </tr>
            @else
                @foreach($kunjungan as $index => $item)
                    <tr>
                        <td>{{ ($kunjungan->currentPage() - 1) * $kunjungan->perPage() + $index + 1 }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->locale('id')->translatedFormat('l, d F Y') }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->asal_instansi }}</td>
                        <td>{{ $item->jenis_pengunjung->nama }}</td>
                        <td>
                            @if($item->status_setujui === 'Disetujui')
                                <span class="badge bg-success text-capitalize">Disetujui</span>
                            @elseif($item->status_setujui === 'Ditolak')
                                <span class="badge bg-danger text-capitalize">Ditolak</span>
                            @else
                                <span class="badge bg-warning text-capitalize">Belum Disetujui</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('kunjungan.detail', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            {{-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                Hapus
                            </button> --}}
                        </td>
                    </tr>

                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus kunjungan dari <strong>{{ $item->nama_lengkap }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('kunjungan.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </tbody>
    </table>
    <!-- Pagination -->
    {{ $kunjungan->links('pagination::bootstrap-5') }}
</div>
@endsection
