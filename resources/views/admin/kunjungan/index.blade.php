@extends('layouts.admin')

@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Permohonan Kunjungan';
</script>
<div class="container">
    <h2>Daftar Kunjungan</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page">Permohonan Kunjungan</li>
        </ol>
    </nav>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
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
                    <td colspan="8" class="text-center">Belum ada kunjungan yang tersedia.</td>
                </tr>
            @else
            @foreach($kunjungan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->tanggal_kunjungan }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->asal_instansi }}</td>
                    <td>{{ $item->jenis_pengunjung->nama }}</td>
                    <td>
                        @if($item->status_setujui)
                            <span class="badge bg-success fs-6 fw-normal text-capitalize">Disetujui</span>
                        @else
                            <span class="badge bg-warning fs-6 fw-normal text-capitalize">Pending</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('kunjungan.getById', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                            Hapus
                        </button>
                    </td>
                </tr>

                <!-- Delete Modal for each kunjungan -->
                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus data kunjungan dari <strong>"{{ $item->nama_lengkap }}"</strong>?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('kunjungan.destroy', $item->id) }}" method="POST">
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
    @endif
</div>
@endsection
