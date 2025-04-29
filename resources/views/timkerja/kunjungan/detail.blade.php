@extends('layouts.timkerja') 
@section('content') 
<script>
	const title = document.getElementsByTagName('title')[0];
	title.innerHTML += ' | Detail Permohonan Kunjungan';
</script>
<div class="container">
	<h2>Detail Permohonan Kunjungan</h2>
	<nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('timkerja.dashboard') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('timkerja.kunjungan.index') }}">Permohonan Kunjungan</a>
			</li>
			<li class="breadcrumb-item" aria-current="page">Detail Permohonan Kunjungan</li>
		</ol>
	</nav>

	@if($kunjungan->status_setujui === 'Disetujui' && $kunjungan->approved_at)
		<div class="alert alert-success mt-3 d-flex align-items-start gap-2">
			<i class="fa-solid fa-check-circle fs-3 text-success align-self-center"></i>
			<div>
				<strong>Disetujui oleh {{ $kunjungan->approvedBy->name }}</strong><br>
				<small class="text-muted">
					{{ \Carbon\Carbon::parse($kunjungan->approved_at)->locale('id')->setTimezone('Asia/Jakarta')->translatedFormat('j F Y H:i:s') }}
				</small>
			</div>
		</div>
	@elseif($kunjungan->status_setujui === 'Ditolak' && $kunjungan->rejectapprove_at)
		<div class="alert alert-danger mt-3 d-flex align-items-start gap-2">
			<i class="fa-solid fa-circle-xmark fs-3 text-danger align-self-center"></i>
			<div>
				<strong>Ditolak oleh {{ $kunjungan->rejectApproveBy->name }}</strong><br>
				<small class="text-muted">
					{{ \Carbon\Carbon::parse($kunjungan->rejectapprove_at)->locale('id')->setTimezone('Asia/Jakarta')->translatedFormat('j F Y H:i:s') }}
				</small>
			</div>
		</div>
	@endif

	<div class="d-flex flex-wrap gap-2 mb-3">
		<a href="https://wa.me/{{ preg_replace('/\D/', '', $kunjungan->no_hp) }}" target="_blank" class="btn btn-success">
			<i class="fab fa-whatsapp"></i> Hubungi
		</a>
	
        @if($kunjungan->status_setujui === 'Disetujui')
            <a href="{{ route('kunjungan.undangan', $kunjungan->id) }}" class="btn btn-warning">
                <i class="fa-solid fa-file-pdf"></i> Unduh Undangan
            </a>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelSetujuiModal">
                <i class="fa-solid fa-times"></i> Batalkan Persetujuan
            </button>
        @elseif($kunjungan->status_setujui === 'pending')
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmSetujuiModal">
                <i class="fa-solid fa-check"></i> Setujui
            </button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmRejectModal">
                <i class="fa-solid fa-times"></i> Tolak
            </button>
        @elseif($kunjungan->status_setujui === 'Ditolak')
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelRejectionModal">
                <i class="fa-solid fa-undo"></i> Batalkan Penolakan
            </button>
        @endif
	</div>
	
	<!-- Modal Konfirmasi Setujui -->
	<div class="modal fade" id="confirmSetujuiModal" tabindex="-1" aria-labelledby="confirmSetujuiModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title" id="confirmVerificationModalLabel">Konfirmasi Setujui</h5>
					<button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Apakah Anda yakin ingin menyetujui permohonan kunjungan ini?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					<form action="{{ route('kunjungan.approve', $kunjungan->id) }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-primary">Setujui</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal Konfirmasi Penolakan -->
	<div class="modal fade" id="confirmRejectModal" tabindex="-1" aria-labelledby="confirmRejectModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<h5 class="modal-title" id="confirmRejectModalLabel">Konfirmasi Penolakan</h5>
					<button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Apakah Anda yakin ingin menolak permohonan kunjungan ini?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					<form action="{{ route('kunjungan.reject', $kunjungan->id) }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-danger">Tolak</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal Konfirmasi Pembatalan Persetujuan -->
	<div class="modal fade" id="cancelSetujuiModal" tabindex="-1" aria-labelledby="cancelSetujuiModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<h5 class="modal-title" id="cancelSetujuiModalLabel">Batalkan Persetujuan</h5>
					<button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Apakah Anda yakin ingin membatalkan persetujuan kunjungan ini?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('kunjungan.cancelApproval', $kunjungan->id) }}" method="POST">
						@csrf
						@method('PUT')
						<button type="submit" class="btn btn-danger">Batalkan Persetujuan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal Konfirmasi Pembatalan Penolakan -->
	<div class="modal fade" id="cancelRejectionModal" tabindex="-1" aria-labelledby="cancelRejectionModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<h5 class="modal-title" id="cancelRejectionModalLabel">Batalkan Penolakan</h5>
					<button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Apakah Anda yakin ingin membatalkan penolakan permohonan kunjungan ini?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					<form action="{{ route('kunjungan.cancelRejectionApproval', $kunjungan->id) }}" method="POST">
						@csrf
						@method('PUT')
						<button type="submit" class="btn btn-danger">Batalkan Penolakan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<style>
		.table th {
			width: 30%;
		}
	</style>	
			<table class="table table-bordered">
				<thead class="table-primary">
					<tr>
						<th colspan="2" class="text-center">Detail Permohonan Kunjungan</th>
					</tr>
				</thead>
				<tbody>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $kunjungan->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Nomor HP</th>
                        <td>{{ $kunjungan->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kunjungan</th>
                        <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->locale('id')->translatedFormat('l, d F Y') }}</td>
                    </tr>
				<tr>
					<th>Usia</th>
					<td>{{ $kunjungan->usia->nama }} Tahun</td>
				</tr>
				<tr>
					<th>Jenis Kelamin</th>
					<td>{{ $kunjungan->jenis_kelamin->nama }}</td>
				</tr>
				<tr>
					<th>Asal Instansi</th>
					<td>{{ $kunjungan->asal_instansi }}</td>
				</tr>
				<tr>
					<th>Pekerjaan</th>
					<td>{{ $kunjungan->pekerjaan->nama }}</td>
				</tr>
				<tr>
					<th>Kategori Informasi</th>
					<td>{{ $kunjungan->kategori_informasi->nama ?? '-' }}</td>
				</tr> @if($kunjungan->pilihan_pertanian) <tr>
					<th>Pilihan Pertanian</th>
					<td>{{ $kunjungan->pilihan_pertanian->nama }}</td>
				</tr> @endif <tr>
					<th>Pendidikan</th>
					<td>{{ $kunjungan->pendidikan->nama }}</td>
				</tr>
				<tr>
					<th>Jenis Pengunjung</th>
					<td>{{ $kunjungan->jenis_pengunjung->nama }}</td>
				</tr> @if($kunjungan->jumlah_orang) <tr>
					<th>Jumlah Orang</th>
					<td>{{ $kunjungan->jumlah_orang }}</td>
				</tr> @endif 
				<tr>
					<th>Tujuan Kunjungan</th>
					<td>{{ $kunjungan->tujuan_kunjungan }}</td>
				</tr>
				<tr>
					<th>Foto KTP</th>
					<td>
						<img src="{{ asset('storage/' . $kunjungan->url_foto_ktp) }}" alt="Foto KTP" class="img-thumbnail" width="200px" data-bs-toggle="modal" data-bs-target="#ktpModal">
					</td>
				</tr>
				<tr>
					<th>Foto Selfie</th>
					<td>
						<img src="{{ asset('storage/' . $kunjungan->url_foto_selfie) }}" alt="Foto Selfie" class="img-thumbnail" width="200px" data-bs-toggle="modal" data-bs-target="#selfieModal">
					</td>
				</tr>
				<!-- Modal untuk Foto KTP -->
				<div class="modal fade" id="ktpModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="ktpModalLabel">Foto KTP</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body text-center">
								<img src="{{ asset('storage/' . $kunjungan->url_foto_ktp) }}" alt="Foto KTP" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
				<!-- Modal untuk Foto Selfie -->
				<div class="modal fade" id="selfieModal" tabindex="-1" aria-labelledby="selfieModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="selfieModalLabel">Foto Selfie</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body text-center">
								<img src="{{ asset('storage/' . $kunjungan->url_foto_selfie) }}" alt="Foto Selfie" class="img-fluid">
							</div>
						</div>
					</div>
				</div>

				@if($kunjungan->status_verifikasi === 'Terverifikasi')
				<tr>
					<th>Status Verifikasi</th>
					<td>
						<div class="d-flex align-items-center gap-2">
							<span class="badge bg-success text-capitalize px-3 py-2">
								Terverifikasi
							</span>
							<div class="text small">
								oleh <strong>{{ $kunjungan->verifiedBy->name }}</strong><br>
								</i>{{ \Carbon\Carbon::parse($kunjungan->verified_at)->locale('id')->setTimezone('Asia/Jakarta')->translatedFormat('j F Y H:i') }}
							</div>
						</div>
					</td>
				</tr>
				@endif
			</table>

				
</div> 
@endsection