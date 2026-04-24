<x-guest-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        :root {
            --primary-green: #2D6A4F;
            --accent-green: #52B788;
            --dark-green: #1B4332;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: radial-gradient(circle at top right, #e8f5e9, #f0f4f1);
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        /* Container utama */
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem; /* Padding samping sedikit diperbesar */
        }

        .login-card {
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 28px; /* Lebih rounded agar modern */
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(27, 67, 50, 0.1);
            background: white;
            width: 100%;
            /* LEBAR DITINGKATKAN DI SINI */
            max-width: 550px; 
            transition: 0.3s ease-in-out;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
            padding: 3.5rem 2rem; /* Header lebih lega */
            color: white;
            text-align: center;
            position: relative;
        }

        .login-header::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 30px;
            background: white;
            clip-path: ellipse(50% 100% at 50% 100%);
        }

        .login-body {
            padding: 3rem 4rem; /* Padding dalam diperlebar agar konten tidak sesak */
        }

        /* Responsif untuk tablet/HP agar padding tidak terlalu lebar */
        @media (max-width: 576px) {
            .login-body { padding: 2rem 2rem; }
            .login-card { border-radius: 20px; }
        }

        .form-label {
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--dark-green);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.6rem;
        }

        .input-group {
            background-color: #f8faf9;
            border: 2px solid #f1f5f3; /* Border sedikit lebih tegas */
            border-radius: 14px;
            transition: 0.3s;
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: var(--primary-green);
            padding-left: 1.2rem;
            font-size: 1.1rem;
        }

        .custom-input {
            background: transparent !important;
            border: none !important;
            padding: 0.85rem 1rem 0.85rem 0.5rem;
            font-size: 1rem;
            box-shadow: none !important;
        }

        .input-group:focus-within {
            border-color: var(--accent-green);
            background-color: white;
            box-shadow: 0 0 0 5px rgba(82, 183, 136, 0.1);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
            border: none;
            padding: 1rem;
            border-radius: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: 0.4s;
            color: white;
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(45, 106, 79, 0.3);
            filter: brightness(1.1);
            color: white;
        }

        .forgot-link {
            color: var(--primary-green);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .forgot-link:hover { color: var(--accent-green); }

        .form-check-input:checked {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }
    </style>

    <div class="auth-wrapper">
        <div class="login-card">
            <div class="login-header">
                <i class="bi bi-houses-fill fs-1 mb-2"></i>
                <h3 class="fw-bold mb-1 tracking-tight">CV KABAYAN GROUP</h3>
                <p class="small opacity-75 mb-0">Management System Login</p>
            </div>

            <div class="login-body">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label">Akses Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-paper"></i></span>
                            <input id="email" type="email" name="email" class="form-control custom-input" 
                                   value="{{ old('email') }}" required autofocus placeholder="nama@kabayan.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label mb-0">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">Lupa?</a>
                            @endif
                        </div>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input id="password" type="password" name="password" class="form-control custom-input" 
                                   required placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="d-flex align-items-center mb-4 mt-2">
                        <div class="form-check">
                            <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                            <label for="remember_me" class="form-check-label small text-muted fw-semibold">Tetap Masuk</label>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-login">
                            Masuk Ke Sistem <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>

                    <div class="mt-5 text-center">
                        <p class="small text-muted mb-2">Belum punya akun tim?</p>
                        <a href="{{ route('register') }}" class="text-decoration-none small text-success fw-bold">Daftar Akun Baru</a>
                        <div class="mt-3 border-top pt-3">
                             <a href="{{ url('/') }}" class="text-muted text-decoration-none small"><i class="bi bi-chevron-left me-1"></i> Kembali ke Beranda</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>