<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('assets/icons/logo.png') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        
        <style>
            body {
                font-family: Poppins, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
            }

            .sidebar {
                width: 180px;
                background-color: #6a613f;
                color: white;
                height: 100vh;
                position: fixed;
                display: flex;
                flex-direction: column;
                align-items: center;
                transition: width 0.3s ease;
            }

            .sidebar-header {
                text-align: center;
                padding: 20px;
            }

            .logo {
                width: 80px;
                height: 80px;
            }

            .sidebar h1 {
                font-size: 18px;
                margin: 10px 0 0;
            }

            .sidebar-menu {
                list-style: none;
                padding: 0;
                margin: 0;
                width: 100%;
            }

            .sidebar-menu li {
                width: 100%;
            }

            .sidebar-menu li a {
                display: block;
                padding: 15px 20px;
                color: white;
            }

            .sidebar-menu li a:hover,
            .active,
            .logout:hover {
                background-color: #4c462e;
                text-decoration: none !important;
                color: #fff !important;
            }

            .dropdown-item {
                color: black !important;
            }
            .dropdown-item.active, .dropdown-item:active {
                color: #fff !important;
                text-decoration: none;
                background-color: #4c462e !important;
            }

            .logout {
                margin-top: auto;
                padding: 15px 20px;
                width: 100%;
                text-align: center;
                color: white;
                text-decoration: none !important;
            }

            .content {
                margin-left: 180px;
                padding: 20px;
                flex-grow: 1;
            }
            a{
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <a href="#">
                    <img src="/assets/icons/logo.png" alt="Logo" class="logo">
                </a>
                <h1>Tagrinov</h1>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->url() == route('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Kelola Tanaman
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li>
                          <a class="dropdown-item {{ request()->url() == route('family.getAll') ? 'active' : '' }}" href="{{ route('family.getAll') }}">
                              Kelola Family
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item {{ request()->url() == route('jenis.getAll') ? 'active' : '' }}" href="{{ route('jenis.getAll') }}">
                              Kelola Jenis
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item {{ request()->url() == route('kategori.getAll') ? 'active' : '' }}" href="{{ route('kategori.getAll') }}">
                              Kelola Kategori
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item {{ request()->url() == route('entitas.getAll') ? 'active' : '' }}" href="{{ route('entitas.getAll') }}">
                              Kelola Entitas
                          </a>
                      </li>
                  </ul>
              </li>
              <li><a href="{{ route('admin.welcome.edit') }}" class="">Welcome edit text</a></li>
              <li>
                <a href="{{ route('admin.testimoni.index') }}" class="{{ request()->is('admin/testimoni') ? 'active' : '' }}">
                    Testimoni 
                    @if($pendingCount > 0)
                        <span class="badge bg-warning">{{ $pendingCount }}</span>
                    @endif
                </a>
              </li>

                {{-- <li><a href="{{ route('admin.verifikasiPj') }}" class="{{ request()->url() == route('admin.verifikasiPj') ? 'active' : '' }}">Verifikasi <br>Penanggungjawab</a></li> --}}

            </ul>
            <br>
            <a href="#" class="logout" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
        </div>

        <!-- Content -->
        <div class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Logout Confirmation Modal -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to log out?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="#" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>


    </body>
</html>