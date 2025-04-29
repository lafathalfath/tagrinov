@extends('layouts.admin') 
@section('content') 
<script>
	const title = document.getElementsByTagName('title')[0];
	title.innerHTML += ' | Keranjang Sampah';
</script>
<div class="container">
	<h2>Keranjang Sampah Permohonan Kunjungan</h2>
	<nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('kunjungan.getAll') }}">Permohonan Kunjungan</a>
			</li>
			<li class="breadcrumb-item" aria-current="page">Keranjang Sampah</li>
		</ol>
	</nav>

    @if($kunjunganTerhapus->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Instansi</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Jenis</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kunjunganTerhapus as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->asal_instansi }}</td>
                        <td>{{ $item->jenis_pengunjung->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->locale('id')->translatedFormat('l, d F Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->deleted_at)->locale('id')->setTimezone('Asia/Jakarta')->translatedFormat('j F Y H:i') }}</td>
                        <td class="d-flex gap-1">
                            {{-- Tombol Pulihkan (trigger modal) --}}
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#pulihkanModal{{ $item->id }}">
                                <i class="fa fa-undo"></i>
                            </button>

                            {{-- Modal Pulihkan --}}
                            <div class="modal fade" id="pulihkanModal{{ $item->id }}" tabindex="-1" aria-labelledby="pulihkanModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-success">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title" id="pulihkanModalLabel{{ $item->id }}">Konfirmasi Pemulihan</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin memulihkan data ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form method="POST" action="{{ route('kunjungan.restore', $item->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Pulihkan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Hapus Permanen (trigger modal) --}}
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusPermanenModal{{ $item->id }}">
                                <i class="fa fa-trash"></i>
                            </button>

                            {{-- Modal Hapus Permanen --}}
                            <div class="modal fade" id="hapusPermanenModal{{ $item->id }}" tabindex="-1" aria-labelledby="hapusPermanenLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="hapusPermanenLabel{{ $item->id }}">Konfirmasi Hapus Permanen</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            Data kunjungan dari <strong>{{ $item->nama_lengkap }}</strong> akan dihapus secara permanen. Tindakan ini tidak bisa dibatalkan.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form method="POST" action="{{ route('kunjungan.forceDelete', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus Permanen</button>
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
        </div>
    @else
        <div class="alert alert-info">
            Tidak ada permohonan kunjungan yang dihapus.
        </div>
    @endif
</div>
@endsection
