<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CV KABAYAN - General Supplier & Trading</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            :root {
                /* Palet Hijau Dinamis */
                --primary-green: #2D6A4F; /* Hijau Deep (Profesional) */
                --accent-green: #52B788;  /* Hijau Terang (Dinamis) */
                --light-green: #D8F3DC;   /* Hijau Muda (Background) */
                --cream: #F8FAF8;
                --dark-text: #1B4332;
            }
            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: var(--cream);
                color: var(--dark-text);
                margin: 0;
                overflow-x: hidden;
            }
            .navbar-custom {
                padding: 1.5rem 2rem;
            }
            .hero-section {
                min-height: 85vh;
                display: flex;
                align-items: center;
                padding: 4rem 0;
                /* Pattern halus agar lebih dinamis */
                background-image: radial-gradient(circle at 2px 2px, #d8f3dc 1px, transparent 0);
                background-size: 40px 40px;
            }
            .text-green-primary { color: var(--primary-green); }
            .text-green-accent { color: var(--accent-green); }
            
            .btn-kabayan {
                background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
                color: white;
                border-radius: 50px; /* Lebih rounded agar dinamis */
                padding: 0.8rem 2.5rem;
                transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                border: none;
                font-weight: 600;
                box-shadow: 0 4px 15px rgba(45, 106, 79, 0.2);
            }
            .btn-kabayan:hover {
                color: white;
                transform: translateY(-3px) scale(1.05);
                box-shadow: 0 8px 20px rgba(45, 106, 79, 0.3);
            }
            .btn-outline-kabayan {
                border: 2px solid var(--primary-green);
                color: var(--primary-green);
                border-radius: 50px;
                padding: 0.8rem 2.5rem;
                text-decoration: none;
                font-weight: 600;
                transition: 0.3s;
            }
            .btn-outline-kabayan:hover {
                background-color: var(--primary-green);
                color: white;
            }
            .card-service {
                border: none;
                background: white;
                padding: 3rem 2rem;
                border-radius: 20px;
                height: 100%;
                transition: 0.4s;
                position: relative;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            }
            .card-service:hover {
                transform: translateY(-10px);
                background: var(--primary-green);
                color: white !important;
            }
            .card-service:hover .text-muted, 
            .card-service:hover h4 {
                color: white !important;
            }
            .card-service:hover .icon-box {
                background: rgba(255,255,255,0.2);
                transform: rotate(10deg);
            }
            .icon-box {
                width: 70px;
                height: 70px;
                background: var(--light-green);
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 15px;
                margin: 0 auto 1.5rem;
                font-size: 2rem;
                transition: 0.3s;
            }
            .hero-circle {
                width: 500px; 
                height: 500px; 
                margin-left: auto; 
                border: 30px solid var(--light-green);
                background: white;
                position: relative;
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-custom justify-content-between container">
            <div class="navbar-brand fw-bold fs-3 tracking-tighter">
                <span class="text-green-accent">CV</span><span class="text-green-primary"> KABAYAN</span>
            </div>
            <div>
                @if (Route::has('login'))
                    <div class="d-flex gap-3 align-items-center">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-kabayan text-decoration-none">Dashboard Admin</a>
                        @else
                            <a href="{{ route('login') }}" class="text-dark fw-bold text-decoration-none text-sm">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-outline-kabayan py-2 px-4 text-sm">Join Us</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <main class="container hero-section">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h5 class="text-green-accent fw-bold text-uppercase mb-3 tracking-widest">Efficiency & Trust</h5>
                    <h1 class="display-3 fw-bold mb-4" style="line-height: 1.1;">Solusi <span class="text-green-primary">Terpadu</span> Untuk Bisnis Anda.</h1>
                    <p class="lead text-secondary mb-5 w-75">
                        CV Kabayan menyederhanakan rantai pasok Anda. Kami hadir sebagai mitra strategis (General Supplier) dengan standar kualitas tinggi dan pengiriman tepat waktu.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#services" class="btn-kabayan text-decoration-none text-center">Jelajahi Layanan</a>
                        <a href="{{ route('login') }}" class="btn-outline-kabayan text-center">Kemitraan</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-circle rounded-circle d-flex align-items-center justify-content-center shadow-lg">
                         <div class="text-center">
                            <span class="display-1">🌿</span>
                            <h2 class="mt-3 fw-bold text-green-primary">Eco-System</h2>
                            <p class="text-muted">Growing Together</p>
                         </div>
                    </div>
                </div>
            </div>
        </main>

        <section id="services" class="py-5" style="background-color: #fff;">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold display-5">Layanan Unggulan</h2>
                    <div class="mx-auto bg-green-accent" style="width: 80px; height: 5px; background: var(--accent-green); border-radius: 10px;"></div>
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-md-4">
                        <div class="card-service text-center">
                            <div class="icon-box">📦</div>
                            <h4 class="fw-bold">General Supplier</h4>
                            <p class="text-muted">Pengadaan barang retail maupun industri dengan skala fleksibel.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-service text-center">
                            <div class="icon-box">📈</div>
                            <h4 class="fw-bold">Trading Solution</h4>
                            <p class="text-muted">Sistem perdagangan yang transparan, aman, dan menguntungkan mitra.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-service text-center">
                            <div class="icon-box">💡</div>
                            <h4 class="fw-bold">Business Consulting</h4>
                            <p class="text-muted">Analisis mendalam untuk efisiensi biaya operasional perusahaan Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="py-5 text-center bg-light">
            <div class="container">
                <div class="mb-4">
                    <span class="fw-bold text-green-primary">CV KABAYAN</span>
                </div>
                <p class="text-muted small">
                    &copy; {{ date('Y') }} CV KABAYAN - Digital Consulting. <br>
                    <span class="opacity-50">Powered by Dias v{{ app()->version() }}</span>
                </p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>