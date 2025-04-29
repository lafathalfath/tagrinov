@extends('layouts.admin')
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Kelola Akun';
</script>
<div class="container">
    <h2>Kelola Akun</h2>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Kelola Akun</li>
        </ol>
    </nav>

    <div class="row mb-4">
        <div class="col-md-5">
            <form method="GET" action="{{ route('kelola-akun.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control col-md-4" placeholder="Cari akun.." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    <a href="{{ route('kelola-akun.index') }}" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
                </div>
            </form>
        </div>
        <div class="col-md d-flex justify-content-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createAkunModal">
                <i class="fa fa-plus"></i> Tambah Akun
            </button>
        </div>
    </div>

    <!-- Tabel Daftar Akun -->
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor Hp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->no_hp }}</td>
                    <td>
    {{-- Jika yang login adalah admin (ID = 1) --}}
    @if (auth()->user()->id === 1)
        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAkunModal{{ $user->id }}">
            Edit
        </button>

        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal{{ $user->id }}">
            Ubah Password
        </button>

        {{-- Admin tidak bisa menghapus dirinya sendiri --}}
        <button type="button" class="btn btn-danger btn-sm"
            @if ($user->id === 1) disabled @endif
            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
            Hapus
        </button>

    {{-- Jika yang login adalah user biasa --}}
    @else
        {{-- User biasa hanya bisa edit, mengubah password, hapus dirinya sendiri --}}
        @if (auth()->user()->id === $user->id)
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAkunModal{{ $user->id }}">
                Edit
            </button>
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal{{ $user->id }}">
                Ubah Password
            </button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                Hapus
            </button>
        @else
            {{-- Tombol dibuat disabled jika bukan akunnya sendiri --}}
            <button type="button" class="btn btn-warning btn-sm" disabled>
                Edit
            </button>

            <button type="button" class="btn btn-warning btn-sm" disabled>
                Ubah Password
            </button>

            <button type="button" class="btn btn-danger btn-sm" disabled>
                Hapus
            </button>
        @endif
    @endif
</td>

                </tr>

                <!-- Modal Edit Akun -->
                <div class="modal fade" id="editAkunModal{{ $user->id }}" tabindex="-1" aria-labelledby="editAkunModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('kelola-akun.updateProfile', $user->id) }}" method="POST">
                                @csrf
                                {{-- @method('PUT') --}}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title" id="editAkunModalLabel">Edit Profil Akun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">Nomor HP</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" required>
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

                <!-- Modal Change Password -->
                <div class="modal fade" id="changePasswordModal{{ $user->id }}" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('kelola-akun.updatePassword') }}" method="POST">
                                @csrf
                                {{-- @method('PUT') <!-- Karena rute di web.php pakai PUT --> --}}

                                <!-- Kirim ID User -->
                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title" id="changePasswordLabel">Ubah Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label">Password Lama</label>
                                        <input type="password" class="form-control" id="old_password" name="old_password"  placeholder="Masukkan password lama" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukkan password baru" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" id="confirm_password" name="new_password_confirmation" placeholder="Konfirmasi password baru" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('kelola-akun.destroy', $user->id) }}" method="POST">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Konfirmasi Hapus Akun</h5>
                                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Anda yakin ingin menghapus akun <b>{{ $user->name }}</b>?</p>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Masukkan Password Anda</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </tbody>
    </table>
</div>

    <!-- Modal Tambah Akun -->
    <div class="modal fade" id="createAkunModal" tabindex="-1" aria-labelledby="createAkunModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('kelola-akun.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="{{ Auth::user()->role }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createAkunModalLabel">Tambah Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="role" name="name" placeholder="Nama akun" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP" required >
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="Konfirmasi password" required autocomplete="new-password">
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
