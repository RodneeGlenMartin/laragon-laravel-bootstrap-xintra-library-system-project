<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">
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
    <meta name="description" content="Library Management System - Manage books, students, and transactions efficiently">
    <title>@yield('title', 'Authentication') - {{ config('app.name', 'Library System') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234f46e5' stroke-width='2'><path d='M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20'/></svg>" type="image/svg+xml">

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/authentication-main.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <style>
        /* Enhanced Auth Cover Styles */
        .authentication-cover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            position: relative;
            overflow: hidden;
        }
        
        .authentication-cover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }
        
        .authentication-cover-logo {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            z-index: 10;
        }
        
        .aunthentication-cover-content {
            position: relative;
            z-index: 5;
            padding: 2rem;
        }
        
        /* Floating Books Animation */
        .floating-books {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .floating-book {
            position: absolute;
            opacity: 0.1;
            animation: float 15s infinite ease-in-out;
        }
        
        .floating-book:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; }
        .floating-book:nth-child(2) { left: 80%; top: 60%; animation-delay: 2s; }
        .floating-book:nth-child(3) { left: 30%; top: 70%; animation-delay: 4s; }
        .floating-book:nth-child(4) { left: 70%; top: 15%; animation-delay: 6s; }
        .floating-book:nth-child(5) { left: 50%; top: 45%; animation-delay: 8s; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(5deg); }
            50% { transform: translateY(0) rotate(0deg); }
            75% { transform: translateY(20px) rotate(-5deg); }
        }
        
        /* Feature Pills */
        .feature-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }
        
        .feature-pill {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            padding: 0.4rem 0.8rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        
        .feature-pill i {
            font-size: 0.85rem;
        }
        
        /* Card Enhancements */
        .custom-card.auth-card {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
        }
        
        .custom-card.auth-card .card-body {
            padding: 2.5rem;
        }
        
        /* Password Strength Indicator */
        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 0.5rem;
            background: #e9ecef;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            border-radius: 2px;
            transition: width 0.3s ease, background 0.3s ease;
        }
        
        .password-strength-text {
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
        
        /* Form Input Enhancements */
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
        }
        
        .form-label {
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.4rem;
        }
        
        .input-hint {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
        
        /* Responsive */
        @media (max-width: 1199.98px) {
            .authentication-cover {
                display: none !important;
            }
        }
        
        /* Theme Toggle Button */
        .theme-toggle-guest {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 1050;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: white;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .theme-toggle-guest:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        
        .theme-toggle-guest i {
            font-size: 1.25rem;
            color: #6c757d;
            transition: color 0.3s ease;
        }
        
        .theme-toggle-guest .ri-moon-line {
            display: block;
        }
        
        .theme-toggle-guest .ri-sun-line {
            display: none;
        }
        
        /* Dark Mode Styles */
        [data-theme-mode="dark"] body {
            background-color: #1a1d21 !important;
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .bg-white {
            background-color: #1a1d21 !important;
        }
        
        [data-theme-mode="dark"] .card.custom-card.auth-card {
            background-color: #212529;
            border-color: #2d3238;
        }
        
        [data-theme-mode="dark"] .text-dark {
            color: #e9ecef !important;
        }
        
        [data-theme-mode="dark"] .text-muted {
            color: #9ca3af !important;
        }
        
        [data-theme-mode="dark"] .form-control {
            background-color: #2d3238;
            border-color: #3d4248;
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .form-control::placeholder {
            color: #6c757d;
        }
        
        [data-theme-mode="dark"] .form-control:focus {
            background-color: #2d3238;
            border-color: #667eea;
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .form-label {
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .form-check-label {
            color: #9ca3af;
        }
        
        [data-theme-mode="dark"] a:not(.btn) {
            color: #818cf8;
        }
        
        [data-theme-mode="dark"] a:not(.btn):hover {
            color: #a5b4fc;
        }
        
        [data-theme-mode="dark"] .theme-toggle-guest {
            background: #2d3238;
            border-color: #3d4248;
        }
        
        [data-theme-mode="dark"] .theme-toggle-guest i {
            color: #fbbf24;
        }
        
        [data-theme-mode="dark"] .theme-toggle-guest .ri-moon-line {
            display: none;
        }
        
        [data-theme-mode="dark"] .theme-toggle-guest .ri-sun-line {
            display: block;
        }
        
        [data-theme-mode="dark"] .password-strength {
            background: #3d4248;
        }
        
        [data-theme-mode="dark"] .alert {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
        }
        
        [data-theme-mode="dark"] .alert code {
            background-color: rgba(0, 0, 0, 0.3);
            color: #a5b4fc;
            padding: 0.15rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.8em;
        }
        
        code {
            background-color: rgba(0, 0, 0, 0.05);
            color: #6366f1;
            padding: 0.15rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.8em;
        }
    </style>
</head>

<body class="bg-white">

    <!-- Theme Toggle Button -->
    <button type="button" class="theme-toggle-guest" id="guestThemeToggle" title="Toggle dark mode">
        <i class="ri-moon-line"></i>
        <i class="ri-sun-line"></i>
    </button>

    <div class="row authentication authentication-cover-main mx-0">
        <div class="col-xxl-6 col-xl-7">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xxl-7 col-xl-9 col-lg-6 col-md-8 col-sm-10 col-12">
                    {{ $slot }}
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-xl-5 col-lg-12 d-xl-block d-none px-0">
            <div class="authentication-cover overflow-hidden position-relative h-100">
                <!-- Floating Books Animation -->
                <div class="floating-books">
                    <svg class="floating-book" width="60" height="60" viewBox="0 0 24 24" fill="white">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                    <svg class="floating-book" width="50" height="50" viewBox="0 0 24 24" fill="white">
                        <path d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25v14.25"/>
                    </svg>
                    <svg class="floating-book" width="45" height="45" viewBox="0 0 24 24" fill="white">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                    <svg class="floating-book" width="55" height="55" viewBox="0 0 24 24" fill="white">
                        <path d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25v14.25"/>
                    </svg>
                    <svg class="floating-book" width="40" height="40" viewBox="0 0 24 24" fill="white">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                </div>
                
                <!-- Logo -->
                <div class="authentication-cover-logo"> 
                    <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                        </svg>
                        <span class="fs-4 fw-semibold text-white">Library System</span>
                    </a> 
                </div>
                
                <!-- Content -->
                <div class="aunthentication-cover-content d-flex align-items-center justify-content-center h-100">
                    <div class="px-4" style="max-width: 480px;">
                        <h2 class="text-white mb-2 fw-bold">Library Management System</h2>
                        <h6 class="text-white-50 mb-3 fw-normal">Streamline Your Library Operations</h6>
                        <p class="text-white-50 mb-0 lh-lg">
                            A comprehensive platform to manage your book inventory, track student borrowings, and streamline library transactions.
                        </p>
                        
                        <!-- Feature Pills -->
                        <div class="feature-pills">
                            <span class="feature-pill">
                                <i class="ri-book-2-line"></i> Book Management
                            </span>
                            <span class="feature-pill">
                                <i class="ri-user-line"></i> Student Records
                            </span>
                            <span class="feature-pill">
                                <i class="ri-exchange-line"></i> Transactions
                            </span>
                            <span class="feature-pill">
                                <i class="ri-shield-check-line"></i> Secure
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Show Password JS -->
    <script src="{{ asset('assets/js/show-password.js') }}"></script>
    
    <!-- Password Strength Checker -->
    <script>
        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            return strength;
        }
        
        function updatePasswordStrength(inputId, barId, textId) {
            const input = document.getElementById(inputId);
            const bar = document.getElementById(barId);
            const text = document.getElementById(textId);
            
            if (!input || !bar || !text) return;
            
            input.addEventListener('input', function() {
                const strength = checkPasswordStrength(this.value);
                const colors = ['#dc3545', '#fd7e14', '#ffc107', '#20c997', '#198754'];
                const labels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
                const widths = ['20%', '40%', '60%', '80%', '100%'];
                
                if (this.value.length === 0) {
                    bar.style.width = '0%';
                    text.textContent = '';
                } else {
                    const idx = Math.min(strength, 4);
                    bar.style.width = widths[idx];
                    bar.style.background = colors[idx];
                    text.textContent = labels[idx];
                    text.style.color = colors[idx];
                }
            });
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updatePasswordStrength('password', 'password-strength-bar', 'password-strength-text');
        });
    </script>
    
    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('guestThemeToggle');
            
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    const html = document.documentElement;
                    const currentTheme = html.getAttribute('data-theme-mode');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    
                    html.setAttribute('data-theme-mode', newTheme);
                    localStorage.setItem('guest-theme-mode', newTheme);
                });
            }
        });
    </script>

</body>

</html>
