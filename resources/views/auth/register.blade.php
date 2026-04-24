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

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
        }

        .register-card {
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(27, 67, 50, 0.1);
            background: white;
            width: 100%;
            max-width: 550px; /* Lebar disamakan dengan Login */
            transition: 0.3s ease-in-out;
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
            padding: 3.5rem 2rem;
            color: white;
            text-align: center;
            position: relative;
        }

        .register-header::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 30px;
            background: white;
            clip-path: ellipse(50% 100% at 50% 100%);
        }

        .register-body {
            padding: 3rem 4rem; /* Padding disamakan agar lega */
        }

        @media (max-width: 576px) {
            .register-body { padding: 2rem 2rem; }
            .register-card { border-radius: 20px; }
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
            border: 2px solid #f1f5f3;
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

        .btn-register {
            background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
            border: none;
            padding: 1rem;
            border-radius: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: 0.4s;
            color: white;
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(45, 106, 79, 0.3);
            filter: brightness(1.1);
            color: white;
        }

        .login-link {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 700;
        }

        .login-link:hover { color: var(--accent-green); }

        .form-check-input:checked {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }
    </style>

    <div class="auth-wrapper">
        <div class="register-card">
            <div class="register-header">
                <i class="bi bi-person-plus-fill fs-1 mb-2"></i>
                <h3 class="fw-bold mb-1 tracking-tight">PENDAFTARAN AKUN</h3>
                <p class="small opacity-75 mb-0">Manajemen CV Kabayan Group</p>
            </div>

            <div class="register-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input id="name" type="text" name="name" class="form-control custom-input @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Email Kantor</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-paper"></i></span>
                            <input id="email" type="email" name="email" class="form-control custom-input @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required placeholder="email@kabayan.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-key"></i></span>
                                <input id="password" type="password" name="password" class="form-control custom-input @error('password') is-invalid @enderror" 
                                       required placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-check-circle"></i></span>
                                <input id="password_confirmation" type="password" name="password_confirmation" 
                                       class="form-control custom-input" required placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-register">
                            Daftar Akun Baru <i class="bi bi-person-plus-fill ms-2"></i>
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="small text-muted mb-2">Sudah memiliki akses?</p>
                        <a href="{{ route('login') }}" class="login-link small">Silakan Log in</a>
                        <div class="mt-3 border-top pt-3">
                             <a href="{{ url('/') }}" class="text-muted text-decoration-none small"><i class="bi bi-chevron-left me-1"></i> Beranda Utama</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>