{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') – IoT Manager</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* ────────────────────────────────────────────────────────
           1️⃣ VARIABEL WARNA & UTENSIL TEMA MODERN
        ──────────────────────────────────────────────────────── */
        :root {
            /* Palette Inti */
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --danger: #ef4444;
            --success: #10b981;
            --info: #0ea5e9;
            --warning: #fbbf24;

            /* Sidebar Premium Styling */
            --bg-sidebar: #0b1329;          /* Deep space navy blue */
            --bg-sidebar-hover: rgba(255, 255, 255, 0.06);
            --bg-sidebar-active: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            
            /* Main Content Backgrounds */
            --bg-main-light: #f4f6f9;
            --bg-main-dark: #0f172a;
            --bg-card: #ffffff;
            --bg-card-dark: #1e293b;

            /* Tipografi */
            --text-primary: #1e293b;
            --text-light: #f8fafc;
            --text-muted: #64748b;
            --text-muted-light: #94a3b8;

            --sidebar-width: 270px;
        }

        body.dark-mode {
            --bg-main: var(--bg-main-dark);
            --text-primary: var(--text-light);
            --text-muted: var(--text-muted-light);
            --bg-card: var(--bg-card-dark);
        }

        /* ────────────────────────────────────────────────────────
           2️⃣ UMUM
        ──────────────────────────────────────────────────────── */
        body {
            background: var(--bg-main, var(--bg-main-light));
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--text-primary);
            transition: background .3s ease, color .3s ease;
            overflow-x: hidden;
        }
        a { text-decoration: none; }

        /* ────────────────────────────────────────────────────────
           3️⃣ DESAIN MODERN SIDEBAR (PREMIUM & CLEAN)
        ──────────────────────────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--bg-sidebar);
            display: flex;
            flex-direction: column;
            z-index: 1050;
            overflow-y: auto;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform .3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Brand Area */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: 2rem 1.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-light);
            letter-spacing: 0.05em;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        }
        .sidebar-brand i {
            font-size: 1.5rem;
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Navigasi */
        .sidebar-menu { 
            flex-grow: 1; 
            padding: 1.5rem 1rem; 
        }
        
        .menu-section-title {
            padding: .75rem 0.75rem .5rem;
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #475569;
            letter-spacing: .1em;
        }

        .nav-custom-link {
            display: flex;
            align-items: center;
            gap: .9rem;
            padding: .8rem 1.2rem;
            margin-bottom: .35rem;
            border-radius: .6rem;
            color: #94a3b8;
            font-weight: 500;
            font-size: .95rem;
            transition: all .2s ease-in-out;
        }
        .nav-custom-link i { 
            font-size: 1.2rem; 
            color: #64748b;
            transition: transform .2s, color .2s; 
        }
        
        /* Hover Effect Glassmorphic */
        .nav-custom-link:hover,
        .nav-custom-link:focus {
            background: var(--bg-sidebar-hover);
            color: var(--text-light);
        }
        .nav-custom-link:hover i { 
            color: var(--primary); 
            transform: scale(1.1);
        }

        /* Active State Glow */
        .nav-custom-link.active {
            background: var(--bg-sidebar-active);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        .nav-custom-link.active i { 
            color: #fff !important; 
        }

        /* ────────────────────────────────────────────────────────
           4️⃣ PANEL USER & FOOTER SIDEBAR
        ──────────────────────────────────────────────────────── */
        .sidebar-footer {
            padding: 1.25rem 1rem;
            background: rgba(0, 0, 0, 0.2);
            border-top: 1px solid rgba(255, 255, 255, 0.04);
        }
        .user-panel {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1rem;
            padding: .5rem;
            border-radius: .5rem;
            background: rgba(255, 255, 255, 0.02);
        }
        .user-avatar {
            width: 38px; 
            height: 38px; 
            border-radius: .5rem;
            background: linear-gradient(135deg, var(--primary), var(--info));
            color: #fff;
            font-weight: 700;
            font-size: .9rem;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        .user-info {
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .user-name { 
            font-size: .9rem; 
            font-weight: 600; 
            color: var(--text-light);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-role { 
            font-size: .75rem; 
            color: #10b981; 
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: .25rem;
        }

        .btn-logout-custom {
            width: 100%;
            display: flex; align-items: center; justify-content: center;
            gap: .5rem;
            padding: .6rem;
            font-weight: 600;
            font-size: .85rem;
            color: #fca5a5;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.15);
            border-radius: .5rem;
            transition: all .2s ease-in-out;
        }
        .btn-logout-custom:hover {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
        }

        /* ────────────────────────────────────────────────────────
           5️⃣ MAIN CONTENT AREA
        ──────────────────────────────────────────────────────── */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            transition: margin-left .3s ease;
        }
        
        /* Top Bar Modern */
        .top-bar {
            display: flex;
            justify-content: space-between; 
            align-items: center;
            background: var(--bg-card);
            padding: 1.25rem 1.5rem;
            border-radius: .75rem;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
            margin-bottom: 2rem;
            transition: background .3s, box-shadow .3s;
        }
        .top-bar h4 {
            margin: 0; font-weight: 700; color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); box-shadow: 4px 0 20px rgba(0,0,0,.3); }
            .main-content { margin-left: 0; padding: 1.25rem; }
        }
        @media (min-width: 992px) {
            .main-content { margin-left: var(--sidebar-width); padding: 2rem 2.5rem; }
        }

        /* Mobile Overlay */
        .overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1040;
        }
        .overlay.active { display: block; }
    </style>
</head>

<body class="@guest guest-mode @endguest">

@auth
    <nav class="sidebar" id="sidebar">
        <a class="sidebar-brand" href="{{ url('/home') }}">
            <i class="bi bi-cpu-fill"></i> IOT MANAGER
        </a>

        <div class="sidebar-menu">
            <div class="menu-section-title">Menu Utama</div>
            <a class="nav-custom-link {{ Request::is('home') ? 'active' : '' }}" href="{{ url('/home') }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>

            <div class="menu-section-title mt-3">Manajemen Data</div>
            <a class="nav-custom-link {{ Request::is('device*') ? 'active' : '' }}" href="{{ route('device.index') }}">
                <i class="bi bi-hdd-rack-fill"></i> Kelola Devices
            </a>
            <a class="nav-custom-link {{ Request::is('sensor*') ? 'active' : '' }}" href="{{ route('sensor.index') }}">
                <i class="bi bi-broadcast-pin"></i> Data Sensors
            </a>
        </div>

        <div class="sidebar-footer mt-auto">
            <div class="user-panel">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">
                        <i class="bi bi-circle-fill" style="font-size: .5rem;"></i> Active
                    </div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-custom">
                    <i class="bi bi-power"></i> Keluar Aplikasi
                </button>
            </form>
        </div>
    </nav>

    <div class="overlay" id="overlay"></div>
@endauth

<div class="main-content">

    <div class="top-bar">
        <div class="d-flex align-items-center">
            <button class="btn btn-light border-0 btn-sm d-lg-none me-2 p-2 px-3 shadow-sm" id="btn-toggle-sidebar-mobile">
                <i class="bi bi-list fs-5"></i>
            </button>
            <h4 class="text-dark fw-bold mb-0">@yield('title')</h4>
        </div>

        <div>
            @guest
                <div class="d-flex gap-2">
                    <a class="btn btn-outline-dark btn-sm px-3 fw-semibold" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </a>
                    <a class="btn btn-primary btn-sm px-3 fw-semibold" href="{{ route('register') }}">
                        <i class="bi bi-person-plus me-1"></i> Register
                    </a>
                </div>
            @else
                <button class="btn btn-light border-0 shadow-sm p-2 px-3" id="btn-dark-mode">
                    <i class="bi bi-moon-stars-fill text-secondary"></i>
                </button>
            @endguest
        </div>
    </div>

    {{-- System Notification Flash Message System --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm p-3 mb-4"
             style="border-radius: .5rem; background-color:#f0fdf4; color:#166534;">
            <i class="bi bi-check-circle-fill me-2 text-success"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm p-3 mb-4"
             style="border-radius: .5rem; background-color:#f0f9ff; color:#0369a1;">
            <i class="bi bi-info-circle-fill me-2 text-info"></i> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    /* ────────────────────────────────────────────────────────
       Sidebar Toggle Engine (Menggunakan Tombol Internal Content)
       ──────────────────────────────────────────────────────── */
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const toggleButtonMobile = document.getElementById('btn-toggle-sidebar-mobile');

    if (toggleButtonMobile) {
        toggleButtonMobile.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });
    }

    /* ────────────────────────────────────────────────────────
       Theme Memory Engine (Light / Dark Mode State Memory)
       ──────────────────────────────────────────────────────── */
    const darkToggle = document.getElementById('btn-dark-mode');
    if (darkToggle) {
        const savedTheme = localStorage.getItem('iot-theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
            darkToggle.innerHTML = '<i class="bi bi-sun-fill text-warning"></i>';
        }

        darkToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('iot-theme', isDark ? 'dark' : 'light');
            
            darkToggle.innerHTML = isDark 
                ? '<i class="bi bi-sun-fill text-warning"></i>' 
                : '<i class="bi bi-moon-stars-fill text-secondary"></i>';
        });
    }
</script>

@stack('scripts')
@yield('scripts')
</body>
</html>