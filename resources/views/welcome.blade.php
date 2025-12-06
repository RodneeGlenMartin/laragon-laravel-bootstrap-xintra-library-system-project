<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-theme-mode="light">
<script>
    // Check for saved theme preference or system preference
    (function() {
        const savedTheme = localStorage.getItem('guest-theme-mode');
        if (savedTheme) {
            document.documentElement.setAttribute('data-theme-mode', savedTheme);
        } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-theme-mode', 'dark');
        }
    })();
</script>

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Library Management System - A comprehensive solution for managing your library's books, students, and transactions efficiently.">
    <title>{{ config('app.name', 'Library System') }} - Manage Your Library Efficiently</title>

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234f46e5' stroke-width='2'><path d='M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20'/></svg>" type="image/svg+xml">

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <style>
        :root {
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        /* Navigation */
        .landing-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .landing-nav.scrolled {
            background: white;
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.1);
        }
        
        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            background: var(--gradient-primary);
            position: relative;
            overflow: hidden;
            padding-top: 80px;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            color: white;
            margin-bottom: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
        }
        
        .hero-description {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            max-width: 600px;
        }
        
        /* Features */
        .feature-card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        .feature-icon svg {
            width: 28px;
            height: 28px;
        }
        
        /* CTA Section */
        .cta-section {
            background: var(--gradient-primary);
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        /* Footer */
        .footer {
            background: #1a1a2e;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Theme Toggle Button */
        .theme-toggle-welcome {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: transparent;
            border: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .theme-toggle-welcome:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        
        .theme-toggle-welcome i {
            font-size: 1.1rem;
            color: #6c757d;
            transition: color 0.3s ease;
        }
        
        .theme-toggle-welcome .ri-moon-line {
            display: block;
        }
        
        .theme-toggle-welcome .ri-sun-line {
            display: none;
        }
        
        /* Dark Mode Styles */
        [data-theme-mode="dark"] body {
            background-color: #1a1d21 !important;
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .landing-nav {
            background: rgba(26, 29, 33, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        [data-theme-mode="dark"] .landing-nav.scrolled {
            background: #1a1d21;
        }
        
        [data-theme-mode="dark"] .landing-nav .text-dark {
            color: #e9ecef !important;
        }
        
        [data-theme-mode="dark"] .theme-toggle-welcome {
            border-color: rgba(255, 255, 255, 0.2);
        }
        
        [data-theme-mode="dark"] .theme-toggle-welcome:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        [data-theme-mode="dark"] .theme-toggle-welcome i {
            color: #fbbf24;
        }
        
        [data-theme-mode="dark"] .theme-toggle-welcome .ri-moon-line {
            display: none;
        }
        
        [data-theme-mode="dark"] .theme-toggle-welcome .ri-sun-line {
            display: block;
        }
        
        [data-theme-mode="dark"] #features {
            background-color: #1a1d21;
        }
        
        [data-theme-mode="dark"] .feature-card {
            background: #212529;
            border-color: #2d3238;
        }
        
        [data-theme-mode="dark"] .feature-card h5 {
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .feature-card .text-muted {
            color: #9ca3af !important;
        }
        
        [data-theme-mode="dark"] #features h2 {
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] #features h6 {
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .btn-light {
            background: #212529;
            border-color: #3d4248;
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .btn-light:hover {
            background: #2d3238;
            border-color: #4d5258;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="landing-nav py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                    <span class="fs-5 fw-bold text-dark">Library System</span>
                </a>
                <div class="d-none d-md-flex align-items-center gap-4">
                    <a href="#features" class="text-dark text-decoration-none">Features</a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <!-- Theme Toggle -->
                    <button type="button" class="theme-toggle-welcome" id="welcomeThemeToggle" title="Toggle dark mode">
                        <i class="ri-moon-line"></i>
                        <i class="ri-sun-line"></i>
                    </button>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <i class="ri-dashboard-line me-1"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-light">Sign In</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">Manage Your Library with Ease</h1>
                        <p class="hero-description">
                            A comprehensive solution for managing your library's books, students, and transactions efficiently. Streamline your operations and focus on what matters most.
                        </p>
                        <div class="d-flex gap-3 flex-wrap">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                                    <i class="ri-user-add-line me-2"></i>Get Started
                                </a>
                            @endif
                            <a href="#features" class="btn btn-outline-light btn-lg px-4">
                                <i class="ri-information-line me-2"></i>Learn More
                            </a>
    </div>

                        <!-- Feature highlights -->
                        <div class="mt-5 pt-4 border-top border-white border-opacity-25">
                            <div class="d-flex align-items-center gap-4 flex-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ri-shield-check-line text-white fs-20"></i>
                                    <span class="text-white fs-14">Secure</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ri-smartphone-line text-white fs-20"></i>
                                    <span class="text-white fs-14">Responsive</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ri-speed-line text-white fs-20"></i>
                                    <span class="text-white fs-14">Fast</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="text-center">
                        <!-- Dashboard Preview Illustration -->
                        <svg viewBox="0 0 500 400" class="w-100" style="max-width: 500px;">
                            <!-- Browser Window -->
                            <rect x="50" y="30" width="400" height="320" rx="10" fill="white" opacity="0.95"/>
                            <rect x="50" y="30" width="400" height="35" rx="10" fill="#f0f0f0"/>
                            <circle cx="75" cy="47" r="6" fill="#ff5f57"/>
                            <circle cx="95" cy="47" r="6" fill="#febc2e"/>
                            <circle cx="115" cy="47" r="6" fill="#28c840"/>
                            
                            <!-- Sidebar -->
                            <rect x="50" y="65" width="80" height="285" fill="#667eea"/>
                            <rect x="65" y="85" width="50" height="8" rx="4" fill="white" opacity="0.3"/>
                            <rect x="65" y="110" width="50" height="8" rx="4" fill="white"/>
                            <rect x="65" y="135" width="50" height="8" rx="4" fill="white" opacity="0.3"/>
                            <rect x="65" y="160" width="50" height="8" rx="4" fill="white" opacity="0.3"/>
                            
                            <!-- Content Area -->
                            <rect x="145" y="85" width="140" height="80" rx="8" fill="#667eea" opacity="0.1"/>
                            <rect x="295" y="85" width="140" height="80" rx="8" fill="#764ba2" opacity="0.1"/>
                            <rect x="145" y="180" width="290" height="100" rx="8" fill="#f8f9fa"/>
                            
                            <!-- Chart Lines -->
                            <path d="M165 250 L200 230 L240 240 L280 210 L320 220 L360 190 L400 200" stroke="#667eea" stroke-width="3" fill="none"/>
                            <circle cx="165" cy="250" r="4" fill="#667eea"/>
                            <circle cx="200" cy="230" r="4" fill="#667eea"/>
                            <circle cx="240" cy="240" r="4" fill="#667eea"/>
                            <circle cx="280" cy="210" r="4" fill="#667eea"/>
                            <circle cx="320" cy="220" r="4" fill="#667eea"/>
                            <circle cx="360" cy="190" r="4" fill="#667eea"/>
                            <circle cx="400" cy="200" r="4" fill="#667eea"/>
                            
                            <!-- Table Rows -->
                            <rect x="145" y="295" width="290" height="40" rx="6" fill="white"/>
                            <line x1="145" y1="315" x2="435" y2="315" stroke="#f0f0f0"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary-transparent text-primary mb-3 px-3 py-2">Features</span>
                <h2 class="fw-bold mb-3">Everything You Need to Manage Your Library</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">
                    Comprehensive tools designed to streamline your library operations and enhance efficiency.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon bg-primary-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                            </div>
                        <h5 class="fw-semibold mb-2">Category Management</h5>
                        <p class="text-muted mb-0">Organize books into categories for easy navigation and structured content management.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon bg-success-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-success" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h5 class="fw-semibold mb-2">Book Inventory</h5>
                        <p class="text-muted mb-0">Manage your entire book collection with detailed information, ISBN tracking, and availability status.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon bg-info-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-info" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        </div>
                        <h5 class="fw-semibold mb-2">Student Records</h5>
                        <p class="text-muted mb-0">Keep track of student information including courses, year levels, and borrowing history.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon bg-warning-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-warning" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                            </svg>
                        </div>
                        <h5 class="fw-semibold mb-2">Transaction Tracking</h5>
                        <p class="text-muted mb-0">Record and monitor all book borrowing activities with due date tracking.</p>
                    </div>
                </div>
            </div>
            
            <!-- Additional Features -->
            <div class="row g-4 mt-3">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-start gap-3">
                        <div class="avatar avatar-md bg-primary-transparent rounded-circle flex-shrink-0">
                            <i class="ri-search-line text-primary"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Advanced Search</h6>
                            <p class="text-muted mb-0 fs-14">Quickly find books, students, or transactions with powerful search filters.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-start gap-3">
                        <div class="avatar avatar-md bg-success-transparent rounded-circle flex-shrink-0">
                            <i class="ri-bar-chart-line text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Dashboard Analytics</h6>
                            <p class="text-muted mb-0 fs-14">Visual insights into your library's performance and activities.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-start gap-3">
                        <div class="avatar avatar-md bg-warning-transparent rounded-circle flex-shrink-0">
                            <i class="ri-shield-check-line text-warning"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Secure Access</h6>
                            <p class="text-muted mb-0 fs-14">Authentication system to protect your library data.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-start gap-3">
                        <div class="avatar avatar-md bg-danger-transparent rounded-circle flex-shrink-0">
                            <i class="ri-smartphone-line text-danger"></i>
                            </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Responsive Design</h6>
                            <p class="text-muted mb-0 fs-14">Access your library system from any device, anywhere.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-start gap-3">
                        <div class="avatar avatar-md bg-info-transparent rounded-circle flex-shrink-0">
                            <i class="ri-time-line text-info"></i>
                            </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Due Date Tracking</h6>
                            <p class="text-muted mb-0 fs-14">Monitor overdue books and upcoming returns easily.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-start gap-3">
                        <div class="avatar avatar-md bg-secondary-transparent rounded-circle flex-shrink-0">
                            <i class="ri-user-settings-line text-secondary"></i>
                            </div>
                        <div>
                            <h6 class="fw-semibold mb-1">User Management</h6>
                            <p class="text-muted mb-0 fs-14">Manage user accounts and profile settings securely.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5">
        <div class="container position-relative">
            <div class="text-center py-5">
                <h2 class="text-white fw-bold mb-3">Ready to Get Started?</h2>
                <p class="text-white-50 mb-4 mx-auto" style="max-width: 600px;">
                    Start managing your library more efficiently today.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5">
                            <i class="ri-rocket-line me-2"></i>Get Started
                        </a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">
                            <i class="ri-login-box-line me-2"></i>Sign In
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                    <span class="text-white fw-semibold">Library System</span>
                </div>
                <p class="text-white-50 mb-0">&copy; {{ date('Y') }} Library System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.landing-nav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Theme Toggle
        const themeToggle = document.getElementById('welcomeThemeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                const html = document.documentElement;
                const currentTheme = html.getAttribute('data-theme-mode');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                html.setAttribute('data-theme-mode', newTheme);
                localStorage.setItem('guest-theme-mode', newTheme);
            });
        }
    </script>

</body>

</html>
