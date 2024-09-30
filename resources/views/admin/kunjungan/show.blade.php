@extends('layouts.admin') @section('content') <script>
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
			<li class="breadcrumb-item" aria-current="page">Detail Permohonan Kunjungan</li>
		</ol>
	</nav>
			<table class="table table-bordered">
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
					<td>{{ $kunjungan->usia->nama }}</td>
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
					<th>Pilihan Pertanian</th>
					<td>{{ $kunjungan->jumlah_orang }}</td>
				</tr> @endif <tr>
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
			<div class="mt-4">
				<a href="{{ route('kunjungan.getAll') }}" class="btn btn-secondary">Kembali</a>
			</div>
</div> 
@endsection