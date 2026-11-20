<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - IZZARA Oleh-Oleh</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #2C160B 0%, #4D2613 50%, #200D04 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background-color: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.35);
            max-width: 440px;
            width: 100%;
            overflow: hidden;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }
        .btn-brand-primary {
            background-color: #5A2C18;
            color: #FFFFFF;
            font-weight: 600;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.25s ease;
        }
        .btn-brand-primary:hover {
            background-color: #7A3E20;
            color: #FFFFFF;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="p-4 p-md-5 text-center" style="background: linear-gradient(135deg, #3A1B0D, #532712); color: #FFF; border-bottom: 3px solid #D4AF37;">
        <img src="{{ asset('images/logo.png') }}" alt="Logo IZZARA" style="height: 65px; border-radius: 8px;" class="mb-2 bg-white p-1 shadow-sm">
        <h3 class="font-serif fw-bold mb-0 text-white" style="font-family: 'Playfair Display', serif;">IZZARA Admin</h3>
        <small class="text-warning">PT Istana Oleh-Oleh Indonesia</small>
    </div>

    <div class="p-4 p-md-5">
        @if(session('info'))
            <div class="alert alert-info py-2 small mb-3">
                <i class="bi bi-info-circle me-1"></i> {{ session('info') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                <i class="bi bi-exclamation-triangle me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold small">Alamat Email Admin</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="admin@izzara.com" value="{{ old('email', 'admin@izzara.com') }}" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold small">Kata Sandi (Password)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" value="admin123" required>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                    <label class="form-check-label small text-muted" for="remember">
                        Ingat Saya
                    </label>
                </div>
                <span class="badge bg-warning bg-opacity-25 text-dark small">Default: admin123</span>
            </div>

            <button type="submit" class="btn btn-brand-primary w-100 shadow-sm mb-3">
                <i class="bi bi-box-arrow-in-right me-2"></i> Masuk ke Dashboard
            </button>
        </form>

        <div class="text-center pt-3 border-top">
            <a href="{{ route('home') }}" class="text-decoration-none small text-muted">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Website Publik
            </a>
        </div>
    </div>
</div>

</body>
</html>
