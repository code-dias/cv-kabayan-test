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

        .verify-card {
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(27, 67, 50, 0.12);
            background: white;
            width: 100%;
            max-width: 600px; /* Lebar Konsisten */
            transition: 0.3s ease-in-out;
        }

        .verify-header {
            background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
            padding: 4rem 2rem;
            color: white;
            text-align: center;
            position: relative;
        }

        .verify-header::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 35px;
            background: white;
            clip-path: ellipse(50% 100% at 50% 100%);
        }

        .verify-body {
            padding: 3.5rem 5rem; /* Padding Konsisten */
        }

        @media (max-width: 576px) {
            .verify-body { padding: 2.5rem 2rem; }
            .verify-card { border-radius: 20px; margin: 0 10px; }
        }

        .btn-resend {
            background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
            border: none;
            padding: 1rem;
            border-radius: 14px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.4s;
            color: white;
            font-size: 0.9rem;
        }

        .btn-resend:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(45, 106, 79, 0.2);
            color: white;
        }

        .btn-logout {
            color: #dc3545;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            background: none;
            border: none;
            transition: 0.3s;
        }

        .btn-logout:hover {
            color: #a71d2a;
            text-decoration: underline;
        }
    </style>

    <div class="auth-wrapper">
        <div class="verify-card">
            <div class="verify-header">
                <i class="bi bi-patch-check-fill fs-1 mb-2"></i>
                <h2 class="fw-bold mb-1 tracking-tight text-uppercase">Verifikasi Email</h2>
                <p class="small opacity-75 mb-0 text-uppercase tracking-widest">Satu Langkah Lagi</p>
            </div>

            <div class="verify-body">
                <div class="mb-4 text-center text-muted small">
                    {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan ulang.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success border-0 shadow-sm mb-4 small text-center fw-bold">
                        <i class="bi bi-send-check me-2"></i>
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                    </div>
                @endif

                <div class="mt-5 d-flex flex-column gap-3 align-items-center">
                    <form method="POST" action="{{ route('verification.send') }}" class="w-100">
                        @csrf
                        <div class="d-grid">
                            <button type="submit" class="btn btn-resend shadow-sm">
                                Kirim Ulang Email Verifikasi <i class="bi bi-envelope-arrow-up ms-2"></i>
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-logout mt-2">
                            <i class="bi bi-box-arrow-left me-1"></i> {{ __('Keluar / Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>