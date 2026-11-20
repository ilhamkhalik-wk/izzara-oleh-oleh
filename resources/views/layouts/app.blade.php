<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Pusat Oleh-Oleh Khas Daerah Nusantara') - IZZARA Oleh-Oleh</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Theme Styling -->
    <style>
        :root {
            --brand-primary: #5A2C18;
            --brand-secondary: #7A3E20;
            --brand-dark: #32160A;
            --brand-gold: #D4AF37;
            --brand-gold-light: #F7E5A9;
            --brand-cream: #FAF4EB;
            --brand-cream-card: #FFFFFF;
            --brand-text: #2D231E;
            --brand-muted: #6B5B52;
            --brand-border: #E8DDD2;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--brand-cream);
            color: var(--brand-text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1, h2, h3, .font-serif {
            font-family: 'Playfair Display', Georgia, serif;
        }

        /* Topbar */
        .topbar {
            background-color: var(--brand-dark);
            color: #E6D2B5;
            font-size: 0.82rem;
            padding: 7px 0;
            border-bottom: 1px solid rgba(212, 175, 55, 0.25);
        }

        /* Navbar */
        .navbar-brand img {
            height: 48px;
            width: auto;
            object-fit: contain;
            border-radius: 6px;
        }

        .navbar-custom {
            background-color: #FFFFFF;
            box-shadow: 0 4px 20px rgba(90, 44, 24, 0.08);
            padding: 0.75rem 0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .navbar-custom .nav-link {
            font-weight: 600;
            color: var(--brand-text);
            padding: 0.5rem 0.9rem;
            transition: all 0.25s ease;
            position: relative;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--brand-primary);
        }

        .navbar-custom .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0.9rem;
            right: 0.9rem;
            height: 3px;
            background-color: var(--brand-gold);
            border-radius: 2px;
        }

        /* Buttons */
        .btn-brand-primary {
            background-color: var(--brand-primary);
            color: #FFFFFF;
            border: 1px solid var(--brand-primary);
            font-weight: 600;
            padding: 0.6rem 1.4rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-brand-primary:hover {
            background-color: var(--brand-secondary);
            color: #FFFFFF;
            border-color: var(--brand-secondary);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(90, 44, 24, 0.25);
        }

        .btn-brand-gold {
            background: linear-gradient(135deg, #E5BA49, #C89922);
            color: #38190B;
            border: none;
            font-weight: 700;
            padding: 0.6rem 1.4rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-brand-gold:hover {
            background: linear-gradient(135deg, #F0C962, #DDAE2F);
            color: #210D04;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(200, 153, 34, 0.35);
        }

        .btn-brand-outline {
            border: 2px solid var(--brand-primary);
            color: var(--brand-primary);
            background-color: transparent;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-brand-outline:hover {
            background-color: var(--brand-primary);
            color: #FFFFFF;
        }

        /* Cards */
        .product-card {
            background-color: #FFFFFF;
            border: 1px solid var(--brand-border);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(90, 44, 24, 0.12);
            border-color: var(--brand-gold);
        }

        .product-card .img-wrapper {
            position: relative;
            background-color: #F8F5F0;
            height: 220px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-card .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .img-wrapper img {
            transform: scale(1.05);
        }

        .badge-category {
            background-color: rgba(90, 44, 24, 0.1);
            color: var(--brand-primary);
            font-weight: 600;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            display: inline-block;
        }

        .badge-featured {
            background: linear-gradient(135deg, #D4AF37, #B8860B);
            color: #FFFFFF;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.3rem 0.65rem;
            border-radius: 6px;
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .price-tag {
            color: var(--brand-primary);
            font-weight: 800;
            font-size: 1.25rem;
        }

        /* Footer */
        footer {
            background-color: var(--brand-dark);
            color: #E2D1C1;
            margin-top: auto;
            border-top: 4px solid var(--brand-gold);
        }

        footer a {
            color: #D3BEAB;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        footer a:hover {
            color: var(--brand-gold);
        }

        /* Section Title Decorator */
        .section-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .section-header .sub-title {
            color: var(--brand-gold);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            display: block;
            margin-bottom: 0.4rem;
        }

        .section-header .main-title {
            color: var(--brand-primary);
            font-size: 2.3rem;
            font-weight: 800;
        }

        .section-header::after {
            content: '♦ ♦ ♦';
            display: block;
            color: var(--brand-gold);
            font-size: 0.8rem;
            letter-spacing: 6px;
            margin-top: 0.5rem;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Topbar -->
    <div class="topbar d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <span class="me-3"><i class="bi bi-building me-1 text-warning"></i> PT Istana Oleh-Oleh Indonesia</span>
                    <span><i class="bi bi-clock me-1 text-warning"></i> Buka: 08.00 - 21.00 WIB</span>
                </div>
                <div class="col-md-7 text-end d-flex align-items-center justify-content-end gap-3">
                    <a href="https://wa.me/6281234567890" target="_blank" class="text-decoration-none text-warning fw-semibold">
                        <i class="bi bi-whatsapp me-1"></i> WA: 0812-3456-7890
                    </a>
                    <span class="text-light text-opacity-25">|</span>
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-light text-opacity-80">
                                <i class="bi bi-shield-lock-fill text-warning me-1"></i> Panel Admin
                            </a>
                        @else
                            <a href="{{ route('customer.dashboard') }}" class="text-decoration-none text-light text-opacity-80">
                                <i class="bi bi-person-circle text-warning me-1"></i> Akun Saya: {{ Auth::user()->name }}
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-decoration-none text-light text-opacity-80">
                            <i class="bi bi-box-arrow-in-right text-warning me-1"></i> Login Pelanggan
                        </a>
                        <a href="{{ route('register') }}" class="text-decoration-none text-light text-opacity-80">
                            <i class="bi bi-person-plus text-warning me-1"></i> Daftar
                        </a>
                        <span class="text-light text-opacity-25">|</span>
                        <a href="{{ route('admin.login') }}" class="text-decoration-none text-warning small">
                            <i class="bi bi-shield-lock me-1"></i> Portal Admin
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo IZZARA Oleh-Oleh" class="me-2 shadow-sm">
                <div>
                    <span class="d-block fw-bolder fs-4 lh-1" style="color: var(--brand-primary); font-family: 'Playfair Display', serif;">IZZARA</span>
                    <span class="d-block text-muted" style="font-size: 0.68rem; letter-spacing: 1px; font-weight: 700; color: #8C6239 !important;">OLEH-OLEH NUSANTARA</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <i class="bi bi-grid me-1"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <i class="bi bi-tags me-1"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="bi bi-info-circle me-1"></i> Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            <i class="bi bi-envelope me-1"></i> Kontak
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('orders.create') }}" class="btn btn-brand-gold btn-sm d-flex align-items-center">
                        <i class="bi bi-bag-check-fill me-1"></i> Pesan Sekarang
                    </a>

                    @auth
                        @if(Auth::user()->isAdmin())
                            <div class="dropdown">
                                <button class="btn btn-brand-primary btn-sm dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-shield-lock-fill text-warning me-1"></i> Panel Admin
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                    <li><h6 class="dropdown-header">Administrator</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2 text-primary"></i> Dashboard Admin</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.products.index') }}"><i class="bi bi-box-seam me-2 text-primary"></i> Kelola Produk</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}"><i class="bi bi-cart-check me-2 text-primary"></i> Kelola Pesanan</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-left me-2"></i> Logout Admin</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle text-warning me-1"></i> {{ Str::limit(Auth::user()->name, 12) }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                    <li><h6 class="dropdown-header">Akun Pelanggan</h6></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}"><i class="bi bi-speedometer2 me-2 text-warning"></i> Dashboard Saya</a></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.orders') }}"><i class="bi bi-bag-check me-2 text-warning"></i> Riwayat Pesanan</a></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.profile') }}"><i class="bi bi-person-gear me-2 text-warning"></i> Pengaturan Profil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-left me-2"></i> Keluar (Logout)</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @else
                        <div class="d-flex align-items-center gap-1">
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm" title="Masuk Akun Pelanggan">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-brand-primary btn-sm d-none d-sm-inline-flex" title="Daftar Akun Baru">
                                <i class="bi bi-person-plus me-1"></i> Daftar
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages Container -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill fs-5 me-2 text-success"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 me-2 text-danger"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm d-flex align-items-center" role="alert">
                <i class="bi bi-info-circle-fill fs-5 me-2 text-info"></i>
                <div>{{ session('info') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="fw-bold mb-1"><i class="bi bi-exclamation-octagon-fill me-2"></i> Mohon periksa kembali input formulir Anda:</div>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="pt-5 pb-3">
        <div class="container">
            <div class="row g-4 pb-4 border-bottom border-secondary border-opacity-25">
                <!-- Col 1: About & PT -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo IZZARA" style="height: 48px; border-radius: 6px;" class="me-2 bg-light p-1">
                        <div>
                            <h4 class="mb-0 text-white font-serif">IZZARA Oleh-Oleh</h4>
                            <small class="text-warning">PT Istana Oleh-Oleh Indonesia</small>
                        </div>
                    </div>
                    <p class="small text-light text-opacity-75 mb-3">
                        UMKM penyedia aneka oleh-oleh khas daerah terlengkap dengan cita rasa autentik Nusantara. Berkomitmen mendukung produk lokal dan menghadirkan kenangan terindah untuk keluarga Anda.
                    </p>
                    <div class="p-2 rounded bg-black bg-opacity-25 border border-secondary border-opacity-25 small">
                        <i class="bi bi-quote text-warning me-1"></i>
                        <span class="fst-italic text-warning">"Bawa Pulang Kenangan Terbaik."</span>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-white fw-bold mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.9rem;">
                        <i class="bi bi-compass text-warning me-1"></i> Menu Navigasi
                    </h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Beranda</a></li>
                        <li><a href="{{ route('products.index') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Katalog Produk</a></li>
                        <li><a href="{{ route('categories.index') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Daftar Kategori</a></li>
                        <li><a href="{{ route('orders.create') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Pesan Online</a></li>
                        <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Tentang IZZARA</a></li>
                        <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Col 3: Categories -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.9rem;">
                        <i class="bi bi-grid-3x3-gap text-warning me-1"></i> Kategori Unggulan
                    </h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('products.index', ['category' => 'makanan-ringan']) }}"><i class="bi bi-cookie me-1 text-warning"></i> Makanan Ringan</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'kue-tradisional']) }}"><i class="bi bi-cake2 me-1 text-warning"></i> Kue Tradisional</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'makanan-dan-minuman']) }}"><i class="bi bi-cup-hot me-1 text-warning"></i> Makanan & Minuman</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'souvenir-daerah']) }}"><i class="bi bi-bag-heart me-1 text-warning"></i> Souvenir Daerah</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Office -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.9rem;">
                        <i class="bi bi-geo-alt text-warning me-1"></i> Hubungi Kami
                    </h6>
                    <p class="small text-light text-opacity-75 mb-2">
                        <i class="bi bi-building me-2 text-warning"></i> <strong>PT Istana Oleh-Oleh Indonesia</strong><br>
                        Jl. Nusantara Raya No. 88, Sentra Kuliner Tradisional
                    </p>
                    <p class="small text-light text-opacity-75 mb-2">
                        <i class="bi bi-whatsapp me-2 text-warning"></i> WhatsApp: +62 812-3456-7890
                    </p>
                    <p class="small text-light text-opacity-75 mb-2">
                        <i class="bi bi-envelope me-2 text-warning"></i> Email: info@izzara.com
                    </p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="btn btn-sm btn-outline-warning rounded-circle" style="width: 32px; height: 32px; padding: 0; line-height: 30px; text-align: center;"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-warning rounded-circle" style="width: 32px; height: 32px; padding: 0; line-height: 30px; text-align: center;"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-warning rounded-circle" style="width: 32px; height: 32px; padding: 0; line-height: 30px; text-align: center;"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
            </div>

            <div class="row pt-3 align-items-center">
                <div class="col-md-6 text-center text-md-start small text-light text-opacity-50">
                    &copy; {{ date('Y') }} <strong>IZZARA Oleh-Oleh</strong> — Dikelola oleh <strong>PT Istana Oleh-Oleh Indonesia</strong>. Seluruh Hak Dilindungi.
                </div>
                <div class="col-md-6 text-center text-md-end small text-light text-opacity-50 mt-2 mt-md-0">
                    Project UTS Pemrograman Web 2 (Laravel & Bootstrap 5)
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
