<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Tagrinov</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email_or_phone" class="form-label">Email atau Nomor Ponsel</label>
            <input type="text" class="form-control" id="email_or_phone" name="email_or_phone" placeholder="Masukkan Email atau Nomor Ponsel" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me">
            <label class="form-check-label" for="remember_me">Ingat saya</label>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
