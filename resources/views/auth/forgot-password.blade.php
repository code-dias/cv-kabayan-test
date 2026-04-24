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
            padding: 2rem 1rem;
        }

        .forgot-card {
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(27, 67, 50, 0.12);
            background: white;
            width: 100%;
            max-width: 600px; /* Lebar Identik */
            transition: 0.3s ease-in-out;
        }

        .forgot-header {
            background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
            padding: 4rem 2rem;
            color: white;
            text-align: center;
            position: relative;
        }

        .forgot-header::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 35px;
            background: white;
            clip-path: ellipse(50% 100% at 50% 100%);
        }

        .forgot-body {
            padding: 3.5rem 5rem; /* Padding Identik */
        }

        @media (max-width: 576px) {
            .forgot-body { padding: 2.5rem 2rem; }
            .forgot-card { border-radius: 20px; margin: 0 10px; }
        }

        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--dark-green);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.7rem;
        }

        .input-group {
            background-color: #f8faf9;
            border: 2px solid #f1f5f3;
            border-radius: 16px;
            transition: 0.3s;
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: var(--primary-green);
            padding-left: 1.5rem;
            font-size: 1.2rem;
        }

        .custom-input {
            background: transparent !important;
            border: none !important;
            padding: 1rem 1.2rem 1rem 0.6rem;
            font-size: 1rem;
            box-shadow: none !important;
        }

        .input-group:focus-within {
            border-color: var(--accent-green);
            background-color: white;
            box-shadow: 0 0 0 5px rgba(82, 183, 136, 0.12);
        }

        .btn-send {
            background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
            border: none;
            padding: 1.1rem;
            border-radius: 16px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.4s;
            color: white;
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        .btn-send:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(45, 106, 79, 0.3);
            filter: brightness(1.1);
            color: white;
        }
    </style>

    <div class="auth-wrapper">
        <div class="forgot-card">
            <div class="forgot-header">
                <i class="bi bi-question-circle-fill fs-1 mb-2"></i>
                <h2 class="fw-bold mb-1 tracking-tight">LUPA KATA SANDI?</h2>
                <p class="small opacity-75 mb-0 text-uppercase tracking-widest">Pemulihan Akses Sistem</p>
            </div>

            <div class="forgot-body">
                <div class="mb-5 text-center text-muted small px-lg-3">
                    {{ __('Jangan khawatir. Masukkan alamat email operasional Anda di bawah ini, dan kami akan mengirimkan tautan pemulihan sandi ke kotak masuk Anda.') }}
                </div>

                <x-auth-session-status class="mb-4 text-success fw-bold text-center" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label">Email Terdaftar</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-check"></i></span>
                            <input id="email" type="email" name="email" class="form-control custom-input" 
                                   value="{{ old('email') }}" required autofocus placeholder="nama@kabayan.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-send shadow-sm">
                            Kirim Tautan Pemulihan <i class="bi bi-send-fill ms-2"></i>
                        </button>
                    </div>

                    <div class="mt-5 text-center border-top pt-3">
                         <a href="{{ route('login') }}" class="text-muted text-decoration-none small fw-bold">
                             <i class="bi bi-chevron-left me-1"></i> Kembali ke Halaman Login
                         </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>