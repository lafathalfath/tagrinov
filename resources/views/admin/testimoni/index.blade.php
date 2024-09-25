@extends('layouts.admin')

@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Testimoni';
</script>
<div class="container">
    <h2>Daftar Testimoni</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page">Daftar Testimoni</li>
        </ol>
    </nav>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Rating</th>
                <th>Pesan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $feedback->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($feedback->tanggal)->format('d M Y') }}</td>
                    <td>
                        @for ($i = 0; $i < $feedback->rating; $i++)
                            <i class="fas fa-star text-warning"></i>
                        @endfor
                        @for ($i = $feedback->rating; $i < 5; $i++)
                            <i class="fas fa-star text-muted"></i>
                        @endfor
                    </td>
                    <td>{{ $feedback->pesan }}</td>
                    <td>
                        <div class="badge
                        @if($feedback->status == 'pending')
                            bg-warning
                        @elseif($feedback->status == 'Disetujui')
                            bg-success
                        @elseif($feedback->status == 'Ditolak')
                            bg-danger
                        @endif
                        fs-6 fw-normal text-capitalize">
                        {{ $feedback->status }}
                        
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $feedback->id }}">Detail</button>
                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton{{ $feedback->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $feedback->id }}">
                                    <li><a class="dropdown-item" href="{{ route('admin.testimoni.approve', $feedback->id) }}">Setujui</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.testimoni.reject', $feedback->id) }}">Tolak</a></li>
                                </ul>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $feedback->id }}">Hapus</button>      
                    </td>
                </tr>

                <!-- Modal untuk detail -->
                <div class="modal fade" id="detailModal{{ $feedback->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">Detail Testimoni</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nama: </strong>{{ $feedback->nama }}</p>
                                <p><strong>Email: </strong>{{ $feedback->email }}</p>
                                <p><strong>Pesan: </strong>{{ $feedback->pesan }}</p>
                                <p><strong>Rating:</strong>
                                    @for ($i = 0; $i < $feedback->rating; $i++)
                                        <i class="fas fa-star text-warning"></i>
                                    @endfor
                                    @for ($i = $feedback->rating; $i < 5; $i++)
                                        <i class="fas fa-star text-muted"></i>
                                    @endfor
                                </p>
                                @if($feedback->foto)
                                    <img src="{{ asset('storage/' . $feedback->foto) }}" alt="Foto Testimoni" class="img-fluid">
                                @else
                                    <p>Foto tidak tersedia.</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal{{ $feedback->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus testimoni dari "{{ $feedback->nama }}"?
                            </div>
                            <div class="modal-footer">
                                <form id="deleteForm" method="POST" action="{{ route('admin.testimoni.destroy', $feedback->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endforeach
        </tbody>
    </table>
</div>
@endsection
