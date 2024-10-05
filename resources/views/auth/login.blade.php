<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Tagrinov</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('assets/image/gambar_header1.png'); /* Ganti dengan URL foto latar Anda */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transform: translateX(-100%); /* Awal animasi dari luar layar di kiri */
            animation: slideIn 1s forwards; /* Animasi slide-in selama 1 detik */
        }

        @keyframes slideIn {
            to {
                transform: translateX(0); /* Akhir animasi berada di tempat aslinya */
            }
        }
        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-header h3 {
            margin-bottom: 0;
        }
        .form-control:focus {
            box-shadow: none;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <h3>Admin Tagrinov</h3>
    </div>
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email_or_phone" class="form-label">Email atau Nomor Ponsel</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Masukkan Email atau Nomor Ponsel" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me">
            <label class="form-check-label" for="remember_me">Ingat saya</label>
        </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
