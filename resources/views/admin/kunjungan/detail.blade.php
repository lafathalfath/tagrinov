@extends('layouts.admin') 
@section('content') 
<script>
	const title = document.getElementsByTagName('title')[0];
	title.innerHTML += ' | Detail Permohonan Kunjungan';
</script>
<div class="container">
	<h2>Daftar Kunjungan</h2>
	<nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('kunjungan.getAll') }}">Permohonan Kunjungan</a>
			</li>
			<li class="breadcrumb-item" aria-current="page">Detaill Permohonan Kunjungan</li>
		</ol>
	</nav>
	<div class="d-flex flex-wrap gap-2 mb-3">
        {{-- <a href="{{ route('kunjungan.getAll') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a> --}}
        <a href="https://wa.me/{{ preg_replace('/\D/', '', $kunjungan->no_hp) }}" target="_blank" class="btn btn-success">
            <i class="fab fa-whatsapp"></i> Hubungi
        </a>

		@switch($kunjungan->status_setujui)
		@case('Disetujui')
			<a href="{{ route('kunjungan.undangan', $kunjungan->id) }}" class="btn btn-warning">
				<i class="fa-solid fa-file-pdf"></i> Unduh Undangan
			</a>
			<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelApprovalModal">
				<i class="fa-solid fa-times"></i> Batalkan Persetujuan
			</button>
			@break
	
		@case('pending')
			<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmSetujuiModal">
				<i class="fa-solid fa-check"></i> Setujui
			</button>
			<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmTolakModal">
				<i class="fa-solid fa-times"></i> Tolak
			</button>
			@break
	
		@case('Ditolak')
			<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cancelRejectionModal">
				<i class="fa-solid fa-undo"></i> Batalkan Penolakan
			</button>
			@break
	@endswitch
	
    </div>
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
					<th>Tanggal Kunjungan</th>
					<td>{{ $kunjungan->tanggal_kunjungan }}</td>
				</tr>
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
								
			</table>

			<!-- Modal Persetujuan -->
			<div class="modal fade" id="confirmSetujuiModal" tabindex="-1" aria-labelledby="confirmSetujuiModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-primary text-white">
							<h5 class="modal-title" id="confirmSetujuiModalLabel">Konfirmasi Persetujuan</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							Apakah Anda yakin ingin menyetujui kunjungan ini?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
							<form action="{{ route('kunjungan.approve', $kunjungan->id) }}" method="POST">
								@csrf
								@method('POST')
								<button type="submit" class="btn btn-success">Setujui</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Konfirmasi Penolakan -->
			<div class="modal fade" id="confirmTolakModal" tabindex="-1" aria-labelledby="confirmTolakModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-danger text-white">
							<h5 class="modal-title" id="confirmTolakModalLabel">Konfirmasi Penolakan</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							Apakah Anda yakin ingin menolak permohonan kunjungan ini?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
							<form action="{{ route('kunjungan.reject', $kunjungan->id) }}" method="POST">
								@csrf
								@method('PUT')
								<button type="submit" class="btn btn-danger">Tolak</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Batalkan Penolakan -->
			<div class="modal fade" id="cancelRejectionModal" tabindex="-1" aria-labelledby="cancelRejectionModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="cancelRejectionModalLabel">Batalkan Penolakan</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							Apakah Anda yakin ingin membatalkan penolakan kunjungan ini? Status akan kembali menjadi "Pending".
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
							<form action="{{ route('kunjungan.cancelRejection', $kunjungan->id) }}" method="POST">
								@csrf
								@method('PUT')
								<button type="submit" class="btn btn-warning">Batalkan Penolakan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
					
				<!-- Modal Pembatalan -->
				<div class="modal fade" id="cancelApprovalModal" tabindex="-1" aria-labelledby="cancelApprovalModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-danger text-white">
								<h5 class="modal-title" id="cancelApprovalModalLabel">Batalkan Persetujuan</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								Apakah Anda yakin ingin membatalkan persetujuan kunjungan ini?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
								<a href="{{ route('kunjungan.cancel', $kunjungan->id) }}" class="btn btn-danger">Batalkan</a>
							</div>
						</div>
					</div>
				</div>

				
</div> 
@endsection