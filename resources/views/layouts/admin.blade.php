<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - IZZARA Oleh-Oleh</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --admin-sidebar-bg: #2B160C;
            --admin-sidebar-hover: #412213;
            --admin-sidebar-active: #5A2C18;
            --brand-primary: #5A2C18;
            --brand-gold: #D4AF37;
            --brand-cream: #F8F5F0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--brand-cream);
            color: #2D231E;
            min-height: 100vh;
        }

        #wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        #sidebar {
            width: 260px;
            background-color: var(--admin-sidebar-bg);
            color: #E6D2B5;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar-brand img {
            height: 42px;
            border-radius: 6px;
            background: #fff;
            padding: 2px;
        }

        .sidebar-heading {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--brand-gold);
            padding: 1.2rem 1.25rem 0.5rem;
            font-weight: 700;
        }

        .nav-link-admin {
            color: #D3BEAB;
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            font-size: 0.92rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .nav-link-admin:hover {
            color: #FFFFFF;
            background-color: var(--admin-sidebar-hover);
        }

        .nav-link-admin.active {
            color: #FFFFFF;
            background-color: var(--admin-sidebar-active);
            border-left-color: var(--brand-gold);
            font-weight: 600;
        }

        .nav-link-admin i {
            font-size: 1.15rem;
            margin-right: 0.75rem;
            color: var(--brand-gold);
        }

        /* Content */
        #page-content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .admin-topbar {
            background-color: #FFFFFF;
            border-bottom: 1px solid #E8DDD2;
            padding: 0.85rem 1.75rem;
        }

        .card-custom {
            border: 1px solid #E8DDD2;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            background: #FFFFFF;
        }

        .card-header-custom {
            background-color: #FFFFFF;
            border-bottom: 1px solid #EFE6DC;
            font-weight: 700;
            color: var(--brand-primary);
            padding: 1rem 1.25rem;
        }

        .btn-brand-primary {
            background-color: var(--brand-primary);
            color: #FFFFFF;
            border: 1px solid var(--brand-primary);
            font-weight: 600;
        }

        .btn-brand-primary:hover {
            background-color: #7A3E20;
            color: #FFFFFF;
        }

        @media (max-width: 991.98px) {
            #sidebar {
                position: fixed;
                left: -260px;
                top: 0;
                bottom: 0;
                z-index: 1050;
            }
            #sidebar.show {
                left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2">
            <div>
                <span class="d-block fw-bold text-white fs-5" style="font-family: 'Playfair Display', serif;">IZZARA ADMIN</span>
                <span class="d-block text-warning" style="font-size: 0.68rem; letter-spacing: 0.5px;">PT Istana Oleh-Oleh</span>
            </div>
        </a>

        <div class="sidebar-heading">Menu Utama</div>
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <div class="sidebar-heading">Manajemen Toko</div>
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link-admin {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Kelola Produk
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link-admin {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Kelola Kategori
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link-admin {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-cart-check"></i> Kelola Pesanan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.messages.index') }}" class="nav-link-admin {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-left-text"></i> Pesan Kontak
                </a>
            </li>

            <div class="sidebar-heading">Navigasi Luar</div>
            <li class="nav-item">
                <a href="{{ route('home') }}" target="_blank" class="nav-link-admin">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Website Publik
                </a>
            </li>
        </ul>

        <!-- Bottom User Info & Logout -->
        <div class="p-3 border-top border-secondary border-opacity-25 mt-auto">
            <div class="d-flex align-items-center mb-2">
                <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 36px; height: 36px;">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="overflow-hidden">
                    <span class="d-block text-white small fw-bold text-truncate">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    <span class="d-block text-warning" style="font-size: 0.72rem;">Super Admin</span>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger w-100 text-start d-flex align-items-center justify-content-center">
                    <i class="bi bi-box-arrow-left me-2"></i> Keluar (Logout)
                </button>
            </form>
        </div>
    </div>

    <!-- Page Content Wrapper -->
    <div id="page-content-wrapper">
        <!-- Topbar -->
        <div class="admin-topbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary d-lg-none me-2" id="sidebarToggle">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div class="d-none d-sm-block">
                    <span class="fw-semibold text-secondary small">Panel Administrator</span> &bull; 
                    <span class="text-dark fw-bold small">IZZARA Oleh-Oleh</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-light text-dark border p-2 small d-none d-md-inline-block">
                    <i class="bi bi-calendar3 me-1 text-primary"></i> {{ date('d F Y') }}
                </span>
                <a href="{{ route('orders.create') }}" target="_blank" class="btn btn-sm btn-outline-primary d-none d-sm-inline-flex align-items-center">
                    <i class="bi bi-plus-circle me-1"></i> Form Order Publik
                </a>
            </div>
        </div>

        <!-- Main Body Content -->
        <div class="p-4 flex-grow-1">
            <!-- Flash Message Alerts -->
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
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-octagon-fill me-2"></i> Terdapat kesalahan validasi formulir:</div>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>

        <footer class="bg-white border-top py-3 text-center small text-muted">
            &copy; {{ date('Y') }} PT Istana Oleh-Oleh Indonesia — Panel Pengelolaan UMKM IZZARA
        </footer>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
    });
</script>
@yield('scripts')
</body>
</html>
