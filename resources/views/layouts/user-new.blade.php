<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#e6a227">
    <title>@yield('title', 'Pesan') — RUTO COFFEE</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --ruto-brand: #e6a227;
            --ruto-brand-dark: #c4881a;
            --ruto-brand-light: #f5d998;
            --ruto-white: #ffffff;
            --ruto-warm: #fffbf5;
            --ruto-cream: #fff9f0;
            --ruto-text: #2e2e2e;
            --ruto-text-muted: #6b6560;
            --ruto-dark-bg: #222831;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            color: var(--ruto-text);
            background-color: transparent;
            overflow-x: hidden;
            position: relative;
        }
        
        /* Batik Pattern Layer 1 - Dot Pattern */
        body::before {
            display: none;
        }
        
        [data-theme='dark'] body::before {
            opacity: 0.10;
            background-color: #0f0e0c;
        }
        
        /* Batik Pattern Layer 2 - Coffee Cup & Ornament SVG */
        body::after {
            display: none;
        }
        
        [data-theme='dark'] body::after {
            opacity: 0.08;
            filter: brightness(1.5) contrast(1.1);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cormorant Garamond', serif;
        }
        
        /* Hero Area */
        .hero_area {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: transparent;
        }
        
        .bg-box {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: transparent;
        }
        
        .bg-box::before {
            content: '';
            position: absolute;
            inset: 0;
            background: transparent;
        }
        
        .bg-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Header Section */
        .header_section {
            padding: 15px 0;
            background: linear-gradient(135deg, var(--ruto-brand) 0%, var(--ruto-brand-dark) 100%);
        }
        
        .navbar-brand {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            font-size: 32px;
            color: var(--ruto-white) !important;
        }
        
        .navbar-brand span {
            color: var(--ruto-brand-light);
        }
        
        .custom_nav-container .navbar-nav .nav-item .nav-link {
            padding: 8px 20px;
            color: var(--ruto-white);
            text-align: center;
            text-transform: uppercase;
            border-radius: 25px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .custom_nav-container .navbar-nav .nav-item:hover .nav-link,
        .custom_nav-container .navbar-nav .nav-item.active .nav-link {
            color: var(--ruto-brand-light);
            background: rgba(255, 255, 255, 0.15);
        }
        
        .user_option {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user_option a {
            color: var(--ruto-white);
            font-size: 18px;
            transition: color 0.3s;
        }
        
        .user_option a:hover {
            color: var(--ruto-brand-light);
        }
        
        .order_online {
            display: inline-block;
            padding: 8px 30px;
            background-color: var(--ruto-white);
            color: var(--ruto-brand-dark);
            border-radius: 45px;
            transition: all 0.3s;
            border: none;
            font-weight: 600;
            text-decoration: none;
        }
        
        .order_online:hover {
            background-color: var(--ruto-brand-light);
            color: var(--ruto-brand-dark);
        }
        
        /* Slider Section */
        .slider_section {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 60px 0;
        }
        
        .slider_section .detail-box {
            color: var(--ruto-white);
        }
        
        .slider_section .detail-box h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .slider_section .detail-box p {
            font-size: 16px;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .slider_section .detail-box a {
            display: inline-block;
            padding: 12px 45px;
            background-color: var(--ruto-white);
            color: var(--ruto-brand-dark);
            border-radius: 45px;
            transition: all 0.3s;
            border: none;
            font-weight: 600;
            text-decoration: none;
        }
        
        .slider_section .detail-box a:hover {
            background-color: var(--ruto-brand-light);
            transform: translateY(-2px);
        }
        
        /* Main Content */
        .main_content {
            padding: 60px 0;
            background-color: transparent;
        }
        
        /* Section Headings */
        .heading_container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 40px;
        }
        
        .heading_container h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--ruto-text);
            margin-bottom: 10px;
        }
        
        .heading_container h2 span {
            color: var(--ruto-brand);
        }
        
        .heading_container p {
            color: var(--ruto-text-muted);
            margin: 0;
        }
        
        /* Cards */
        .ruto-card {
            background: var(--ruto-white);
            border: 1px solid rgba(230, 162, 39, 0.15);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(230, 162, 39, 0.08);
            transition: all 0.3s;
        }
        
        .ruto-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(230, 162, 39, 0.15);
        }
        
        /* Buttons */
        .btn-ruto {
            display: inline-block;
            padding: 12px 35px;
            background: linear-gradient(135deg, var(--ruto-brand) 0%, var(--ruto-brand-dark) 100%);
            color: var(--ruto-white);
            border: none;
            border-radius: 45px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .btn-ruto:hover {
            background: linear-gradient(135deg, var(--ruto-brand-dark) 0%, var(--ruto-brand) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(196, 136, 26, 0.35);
            color: var(--ruto-white);
        }
        
        /* Footer */
        .footer_section {
            background-color: var(--ruto-dark-bg);
            color: var(--ruto-white);
            padding: 60px 0 30px;
            text-align: center;
        }
        
        .footer_section h4 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--ruto-brand);
        }
        
        .footer_section p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 10px;
        }
        
        /* Alerts */
        .alert-ruto {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid var(--ruto-brand);
        }
        
        .alert-ruto-success {
            background-color: rgba(230, 162, 39, 0.1);
            border-color: var(--ruto-brand);
            color: var(--ruto-brand-dark);
        }
        
        .alert-ruto-error {
            background-color: #fee2e2;
            border-color: #dc2626;
            color: #b91c1c;
        }
        
        /* Theme Toggle */
        .theme-toggle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--ruto-white);
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: var(--ruto-brand-light);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .slider_section .detail-box h1 {
                font-size: 2.5rem;
            }
            
            .navbar-brand {
                font-size: 24px;
            }
        }
        
        /* Dark Mode */
        [data-theme='dark'] body {
            background-color: transparent;
            color: #f5ebe0;
        }
        
        [data-theme='dark'] .main_content {
            background-color: transparent;
        }
        
        [data-theme='dark'] .ruto-card {
            background: #1f1c17;
            border-color: rgba(230, 162, 39, 0.2);
        }
        
        [data-theme='dark'] .heading_container h2 {
            color: #f5ebe0;
        }
        
        [data-theme='dark'] .heading_container p {
            color: #a89f92;
        }
    </style>
</head>
<body>
    <div class="hero_area">
        <div class="bg-box"></div>
        
        <!-- Header Section -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="{{ route('pesan.index') }}">
                        RUTO <span>CAFFEE</span>
                    </a>
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon" style="filter: brightness(0) invert(1);"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="user_option">
                            <button type="button" id="theme-toggle" class="theme-toggle">
                                <i class="fas fa-sun" id="theme-icon"></i>
                            </button>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        
        <!-- Slider Section -->
        <section class="slider_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-lg-6">
                        <div class="detail-box">
                            <h1>Selamat Datang di<br>RUTO COFFEE</h1>
                            <p>Nikmati kopi dan hidangan lezat kami dengan suasana yang nyaman dan pelayanan terbaik. Pesan online sekarang dan rasakan pengalaman berbeda!</p>
                            <a href="{{ route('pesan.menu') }}" class="btn-ruto">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- Main Content -->
    <main class="main_content">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-ruto alert-ruto-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-ruto alert-ruto-error">{{ session('error') }}</div>
            @endif
            
            @yield('content')
        </div>
    </main>
    
    <!-- Footer Section -->
    <footer class="footer_section">
        <div class="container">
            <h4>RUTO COFFEE</h4>
            <p>Coffee & Store OS</p>
            <p style="margin-top: 20px;">&copy; {{ date('Y') }} RUTO COFFEE. All rights reserved.</p>
        </div>
    </footer>
    
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Theme Toggle
        (function() {
            try {
                var t = localStorage.getItem('ruto-admin-theme');
                var dark = t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches);
                document.documentElement.setAttribute('data-theme', dark ? 'dark' : 'light');
                updateThemeIcon(dark);
            } catch (e) {}
            
            document.getElementById('theme-toggle').addEventListener('click', function() {
                var current = document.documentElement.getAttribute('data-theme');
                var newTheme = current === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('ruto-admin-theme', newTheme);
                updateThemeIcon(newTheme === 'dark');
            });
            
            function updateThemeIcon(dark) {
                var icon = document.getElementById('theme-icon');
                if (dark) {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                } else {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                }
            }
        })();
    </script>
    
    @stack('scripts')
</body>
</html>
