<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Library System') - {{ config('app.name', 'OOP System') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234f46e5' stroke-width='2'><path d='M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20'/></svg>" type="image/svg+xml">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Choices JS -->
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet"> 

    <!-- Simplebar Css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- FlatPickr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">

    <!-- Auto Complete CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css') }}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

    @stack('styles')
    
    <style>
        /* Logo text styling */
        .header-logo svg { flex-shrink: 0; }
        .main-sidebar-header .header-logo { padding: 0.5rem; }
        [data-theme-mode="dark"] .header-logo .desktop-logo,
        [data-theme-mode="light"] .header-logo .desktop-dark { display: none !important; }
        [data-theme-mode="dark"] .header-logo .desktop-dark,
        [data-theme-mode="light"] .header-logo .desktop-logo { display: inline !important; }
        [data-toggled="close"] .main-sidebar-header .desktop-logo,
        [data-toggled="close"] .main-sidebar-header .desktop-dark { display: none !important; }
        .main-sidebar-header .toggle-logo { display: none; }
        .main-sidebar-header .toggle-white { display: block; }
        [data-toggled="close"] .main-sidebar-header .toggle-logo,
        [data-toggled="close"] .main-sidebar-header .toggle-white { display: block !important; }
        .horizontal-logo .desktop-dark,
        .horizontal-logo .toggle-logo,
        .horizontal-logo .toggle-white { display: none !important; }
        
        /* Global Search Styles */
        .header-search {
            position: relative;
            max-width: 320px;
        }
        
        .header-search .form-control {
            padding-left: 2.5rem;
            border-radius: 0.5rem;
            border: 1px solid #e9ecef;
            background: #f8f9fa;
            transition: all 0.2s ease;
        }
        
        .header-search .form-control:focus {
            background: white;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
        }
        
        .header-search .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
        }
        
        .header-search .search-shortcut {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: #e9ecef;
            padding: 0.125rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.7rem;
            color: #6c757d;
        }
        
        /* Dark mode search bar styles */
        [data-theme-mode="dark"] .header-search .form-control {
            background: #2a2e35;
            border-color: #3d4248;
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .header-search .form-control::placeholder {
            color: #8b9299;
        }
        
        [data-theme-mode="dark"] .header-search .form-control:focus {
            background: #2a2e35;
            border-color: var(--primary-color);
        }
        
        [data-theme-mode="dark"] .header-search .search-icon {
            color: #8b9299;
        }
        
        [data-theme-mode="dark"] .header-search .search-shortcut {
            background: #3d4248;
            color: #8b9299;
        }
        
        /* Toast Container */
        .toast-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
        }
        
        .toast-custom {
            background: white;
            color: #212529;
            border-radius: 0.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border: none;
            min-width: 320px;
        }
        
        .toast-custom .toast-body {
            color: #212529;
        }
        
        .toast-custom.toast-success {
            border-left: 4px solid #198754;
        }
        
        .toast-custom.toast-error {
            border-left: 4px solid #dc3545;
        }
        
        .toast-custom.toast-warning {
            border-left: 4px solid #ffc107;
        }
        
        .toast-custom.toast-info {
            border-left: 4px solid #0dcaf0;
        }
        
        /* Dark mode toast fix */
        [data-theme-mode="dark"] .toast-custom {
            background: #2a2e35;
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .toast-custom .toast-body {
            color: #e9ecef;
        }
        
        [data-theme-mode="dark"] .toast-custom .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        
        /* Tooltip Enhancements */
        .tooltip-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            font-size: 10px;
            cursor: help;
            margin-left: 0.25rem;
        }
        
        /* Quick Actions Panel */
        .quick-actions-panel {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .quick-action-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid #e9ecef;
            background: white;
            color: #495057;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        
        .quick-action-btn:hover {
            background: #f8f9fa;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        /* Improved Sidebar */
        .side-menu__item {
            border-radius: 0.5rem;
            margin: 0.125rem 0.5rem;
            transition: all 0.2s ease;
        }
        
        .side-menu__item.active {
            background: rgba(255, 255, 255, 0.15) !important;
        }
        
        .side-menu__item:hover:not(.active) {
            background: rgba(255, 255, 255, 0.08) !important;
        }
        
        /* Light menu styles sidebar hover */
        [data-menu-styles="light"] .side-menu__item:hover:not(.active) {
            background: rgba(0, 0, 0, 0.05) !important;
        }
        
        [data-menu-styles="light"] .side-menu__item.active {
            background: rgba(var(--primary-rgb), 0.15) !important;
        }
        
        /* Page Header Improvements */
        .page-header-breadcrumb {
            padding: 1.5rem 0;
        }
        
        .page-title {
            font-weight: 600;
        }
        
        /* Card Improvements */
        .custom-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 0.75rem;
        }
        
        .custom-card .card-header {
            background: transparent;
            border-bottom: 1px solid #f0f0f0;
            padding: 1rem 1.25rem;
        }
        
        .custom-card .card-body {
            padding: 1.25rem;
        }
        
        /* Table Improvements */
        .table thead th {
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-bottom: 2px solid #e9ecef;
        }
        
        /* Button Improvements */
        .btn-wave {
            position: relative;
            overflow: hidden;
        }
        
        .btn-wave::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }
        
        .btn-wave:active::after {
            width: 200px;
            height: 200px;
        }
        
        /* Alert Improvements */
        .alert {
            border-radius: 0.5rem;
            border: none;
        }
        
        .alert-dismissible .btn-close {
            padding: 1rem;
        }
        
        /* Footer */
        .footer {
            border-top: 1px solid #e9ecef;
        }
        
        /* Keyboard Shortcut Modal */
        .keyboard-shortcuts {
            display: grid;
            gap: 0.75rem;
        }
        
        .keyboard-shortcut-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .keyboard-shortcut-item:last-child {
            border-bottom: none;
        }
        
        .kbd {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-family: monospace;
            background: #e9ecef;
            color: #212529 !important;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        
        kbd.small {
            padding: 0.15rem 0.35rem;
            font-size: 0.65rem;
            background: #e9ecef;
            color: #212529 !important;
        }
        
        /* Dark mode kbd fix */
        [data-theme-mode="dark"] .kbd,
        [data-theme-mode="dark"] kbd.small {
            background: #3a3f47;
            color: #e9ecef !important;
            border-color: #4a4f57;
        }
        
        /* Search Results Highlight */
        mark.bg-warning-transparent {
            background-color: rgba(255, 193, 7, 0.3) !important;
            padding: 0;
        }
        
        /* Search Modal List Items */
        #searchResultsList .list-group-item:hover,
        #quickNavigation .list-group-item:hover {
            background-color: #f8f9fa;
        }
        
        [data-theme-mode="dark"] #searchResultsList .list-group-item:hover,
        [data-theme-mode="dark"] #quickNavigation .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        /* Search modal footer in dark mode */
        [data-theme-mode="dark"] #searchModal .bg-light {
            background-color: rgba(0, 0, 0, 0.2) !important;
        }
        
        /* kbd arrows in search modal footer */
        #searchModal .border-top kbd {
            background: #e9ecef;
            color: #212529;
            border: 1px solid #dee2e6;
            padding: 0.1rem 0.3rem;
            font-size: 0.7rem;
            border-radius: 0.2rem;
        }
        
        [data-theme-mode="dark"] #searchModal .border-top kbd {
            background: #3a3f47;
            color: #e9ecef;
            border-color: #4a4f57;
        }
    </style>
</head>

<body>
    <!-- Loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!-- Loader -->

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <div class="page">
        <!-- app-header -->
        <header class="app-header sticky" id="header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="{{ route('dashboard') }}" class="header-logo d-flex align-items-center gap-2 text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                </svg>
                                <span class="fw-semibold fs-16 text-dark desktop-logo">Library</span>
                                <span class="fw-semibold fs-16 text-white desktop-dark">Library</span>
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element mx-lg-0 mx-2">
                        <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element - Global Search -->
                    <div class="header-element d-none d-lg-block">
                        <div class="header-search">
                            <i class="ri-search-line search-icon"></i>
                            <input type="text" class="form-control" id="globalSearch" placeholder="Search books, students, transactions..." autocomplete="off">
                            <span class="search-shortcut">⌘K</span>
                        </div>
                    </div>
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <ul class="header-content-right">

                    <!-- Start::header-element - Mobile Search -->
                    <li class="header-element d-lg-none">
                        <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 header-link-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </a>
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element - Theme -->
                    <li class="header-element header-theme-mode">
                        <a href="javascript:void(0);" class="header-link layout-setting" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Toggle Dark Mode">
                            <span class="light-layout">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 header-link-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                </svg>
                            </span>
                            <span class="dark-layout">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 header-link-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                </svg>
                            </span>
                        </a>
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element - Fullscreen -->
                    <li class="header-element header-fullscreen d-none d-lg-block">
                        <a onclick="openFullscreen();" href="javascript:void(0);" class="header-link" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Fullscreen">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 full-screen-open header-link-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 full-screen-close header-link-icon d-none" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                            </svg>
                        </a>
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element - Profile -->
                    <li class="header-element dropdown">
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-primary-transparent rounded-circle d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </div>
                                <div class="d-none d-xl-block ms-2">
                                    <span class="fw-medium fs-14">{{ Auth::user()->name ?? 'User' }}</span>
                                </div>
                            </div>
                        </a>
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                            <li>
                                <div class="dropdown-item text-center border-bottom py-3">
                                    <div class="avatar avatar-lg bg-primary-transparent rounded-circle mx-auto mb-2">
                                        <span class="avatar-title fs-18">{{ substr(Auth::user()->name ?? 'U', 0, 1) }}</span>
                                    </div>
                                    <span class="d-block fw-semibold">{{ Auth::user()->name ?? 'User' }}</span>
                                    <span class="d-block fs-12 text-muted">{{ Auth::user()->email ?? '' }}</span>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                    <i class="ri-user-line me-2 fs-16 text-muted"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard') }}">
                                    <i class="ri-dashboard-line me-2 fs-16 text-muted"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#keyboardShortcutsModal">
                                    <i class="ri-keyboard-line me-2 fs-16 text-muted"></i>
                                    <span>Keyboard Shortcuts</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="ri-logout-box-r-line me-2 fs-16"></i>
                                        <span>Sign Out</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- End::header-element -->

                </ul>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->

        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="{{ route('dashboard') }}" class="header-logo d-flex align-items-center gap-2 text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary toggle-logo">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white toggle-white">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                    <span class="fw-semibold fs-18 text-white desktop-logo">Library System</span>
                    <span class="fw-semibold fs-18 text-dark desktop-dark">Library System</span>
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                    </div>
                    <ul class="main-menu">
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Main</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide - Dashboard -->
                        <li class="slide">
                            <a href="{{ route('dashboard') }}" class="side-menu__item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <span class="side-menu__label">Dashboard</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Library Management</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide - Categories -->
                        <li class="slide">
                            <a href="{{ route('categories.index') }}" class="side-menu__item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                                <span class="side-menu__label">Categories</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide - Books -->
                        <li class="slide">
                            <a href="{{ route('books.index') }}" class="side-menu__item {{ request()->routeIs('books.*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                                <span class="side-menu__label">Books</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide - Students -->
                        <li class="slide">
                            <a href="{{ route('students.index') }}" class="side-menu__item {{ request()->routeIs('students.*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                </svg>
                                <span class="side-menu__label">Students</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide - Transactions -->
                        <li class="slide">
                            <a href="{{ route('transactions.index') }}" class="side-menu__item {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg>
                                <span class="side-menu__label">Transactions</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Account</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide - Profile -->
                        <li class="slide">
                            <a href="{{ route('profile.edit') }}" class="side-menu__item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <span class="side-menu__label">Profile Settings</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                    </ul>
                    <div class="slide-right" id="slide-right">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg>
                    </div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-1">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                        <h1 class="page-title fw-medium fs-18 mb-0">@yield('page-title')</h1>
                    </div>
                    <div class="btn-list">
                        @yield('page-actions')
                    </div>
                </div>
                <!-- Page Header Close -->

                <!-- Flash Messages -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="ri-checkbox-circle-line fs-20 me-2"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="ri-error-warning-line fs-20 me-2"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <div class="d-flex align-items-start">
                        <i class="ri-error-warning-line fs-20 me-2 mt-1"></i>
                        <div>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-1 ps-3">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @yield('content')

            </div>
        </div>
        <!-- End::app-content -->

        <!-- Footer Start -->
        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <span class="text-muted">
                        Copyright © <span id="year"></span> <span class="text-dark fw-medium">Library System</span>. All rights reserved.
                    </span>
                    <a href="javascript:void(0);" class="text-muted fs-13" data-bs-toggle="modal" data-bs-target="#keyboardShortcutsModal">
                        <i class="ri-keyboard-line me-1"></i>Keyboard Shortcuts
                    </a>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

    </div>

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-3">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="ri-search-line fs-20"></i>
                            </span>
                            <input type="text" class="form-control border-0 shadow-none fs-16" id="modalSearchInput" placeholder="Search books, students, transactions..." autofocus>
                            <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="border-top" id="searchResults" style="max-height: 400px; overflow-y: auto;">
                        <!-- Default: Quick Navigation -->
                        <div class="p-3" id="quickNavigation">
                            <p class="text-muted mb-2 fs-12 text-uppercase fw-semibold">Quick Navigation</p>
                            <div class="list-group list-group-flush">
                                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-2">
                                    <div class="avatar avatar-sm bg-primary-transparent rounded">
                                        <i class="ri-dashboard-line text-primary"></i>
                                    </div>
                                    <div>
                                        <span class="fw-medium">Dashboard</span>
                                        <span class="d-block text-muted fs-12">View library overview</span>
                                    </div>
                                    <span class="ms-auto"><kbd class="small">G</kbd> <kbd class="small">D</kbd></span>
                                </a>
                                <a href="{{ route('books.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-2">
                                    <div class="avatar avatar-sm bg-success-transparent rounded">
                                        <i class="ri-book-2-line text-success"></i>
                                    </div>
                                    <div>
                                        <span class="fw-medium">Books</span>
                                        <span class="d-block text-muted fs-12">Manage book inventory</span>
                                    </div>
                                    <span class="ms-auto"><kbd class="small">G</kbd> <kbd class="small">B</kbd></span>
                                </a>
                                <a href="{{ route('students.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-2">
                                    <div class="avatar avatar-sm bg-info-transparent rounded">
                                        <i class="ri-user-line text-info"></i>
                                    </div>
                                    <div>
                                        <span class="fw-medium">Students</span>
                                        <span class="d-block text-muted fs-12">Manage student records</span>
                                    </div>
                                    <span class="ms-auto"><kbd class="small">G</kbd> <kbd class="small">S</kbd></span>
                                </a>
                                <a href="{{ route('transactions.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-2">
                                    <div class="avatar avatar-sm bg-warning-transparent rounded">
                                        <i class="ri-exchange-line text-warning"></i>
                                    </div>
                                    <div>
                                        <span class="fw-medium">Transactions</span>
                                        <span class="d-block text-muted fs-12">Track borrowed books</span>
                                    </div>
                                    <span class="ms-auto"><kbd class="small">G</kbd> <kbd class="small">T</kbd></span>
                                </a>
                                <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-2">
                                    <div class="avatar avatar-sm bg-secondary-transparent rounded">
                                        <i class="ri-price-tag-3-line text-secondary"></i>
                                    </div>
                                    <div>
                                        <span class="fw-medium">Categories</span>
                                        <span class="d-block text-muted fs-12">Organize book categories</span>
                                    </div>
                                    <span class="ms-auto"><kbd class="small">G</kbd> <kbd class="small">C</kbd></span>
                                </a>
                            </div>
                            
                            <p class="text-muted mb-2 mt-4 fs-12 text-uppercase fw-semibold">Quick Actions</p>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('books.create') }}" class="btn btn-sm btn-outline-success">
                                    <i class="ri-add-line me-1"></i> Add Book
                                </a>
                                <a href="{{ route('students.create') }}" class="btn btn-sm btn-outline-info">
                                    <i class="ri-add-line me-1"></i> Add Student
                                </a>
                                <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-outline-warning">
                                    <i class="ri-add-line me-1"></i> New Transaction
                                </a>
                                <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="ri-add-line me-1"></i> Add Category
                                </a>
                            </div>
                        </div>
                        
                        <!-- Search Results (hidden by default) -->
                        <div class="p-3 d-none" id="searchResultsContent">
                            <p class="text-muted mb-2 fs-12 text-uppercase fw-semibold">Search Results</p>
                            <div id="searchResultsList"></div>
                        </div>
                        
                        <!-- No Results -->
                        <div class="p-4 text-center d-none" id="noResults">
                            <i class="ri-search-line fs-40 text-muted d-block mb-2"></i>
                            <p class="text-muted mb-0">No results found for "<span id="searchQueryText"></span>"</p>
                        </div>
                        
                        <!-- Loading -->
                        <div class="p-4 text-center d-none" id="searchLoading">
                            <div class="spinner-border spinner-border-sm text-primary me-2"></div>
                            <span class="text-muted">Searching...</span>
                        </div>
                    </div>
                    <div class="border-top p-2 bg-light">
                        <div class="d-flex justify-content-between align-items-center text-muted fs-12">
                            <span><kbd>↑</kbd> <kbd>↓</kbd> to navigate</span>
                            <span><kbd>Enter</kbd> to select</span>
                            <span><kbd>Esc</kbd> to close</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Keyboard Shortcuts Modal -->
    <div class="modal fade" id="keyboardShortcutsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ri-keyboard-line me-2"></i>Keyboard Shortcuts
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted fs-13 mb-3">Use these shortcuts to navigate quickly. Note: Shortcuts don't work when typing in input fields.</p>
                    
                    <h6 class="fw-semibold text-primary mb-2"><i class="ri-search-line me-1"></i> Search</h6>
                    <div class="keyboard-shortcuts mb-4">
                        <div class="keyboard-shortcut-item">
                            <span>Open Search</span>
                            <div><span class="kbd">Ctrl</span> + <span class="kbd">K</span> or <span class="kbd">/</span></div>
                        </div>
                    </div>
                    
                    <h6 class="fw-semibold text-primary mb-2"><i class="ri-compass-line me-1"></i> Navigation (Press G, then...)</h6>
                    <div class="keyboard-shortcuts mb-4">
                        <div class="keyboard-shortcut-item">
                            <span>Go to Dashboard</span>
                            <div><span class="kbd">G</span> then <span class="kbd">D</span></div>
                        </div>
                        <div class="keyboard-shortcut-item">
                            <span>Go to Books</span>
                            <div><span class="kbd">G</span> then <span class="kbd">B</span></div>
                        </div>
                        <div class="keyboard-shortcut-item">
                            <span>Go to Students</span>
                            <div><span class="kbd">G</span> then <span class="kbd">S</span></div>
                        </div>
                        <div class="keyboard-shortcut-item">
                            <span>Go to Transactions</span>
                            <div><span class="kbd">G</span> then <span class="kbd">T</span></div>
                        </div>
                        <div class="keyboard-shortcut-item">
                            <span>Go to Categories</span>
                            <div><span class="kbd">G</span> then <span class="kbd">C</span></div>
                        </div>
                        <div class="keyboard-shortcut-item">
                            <span>Go to Profile</span>
                            <div><span class="kbd">G</span> then <span class="kbd">P</span></div>
                        </div>
                    </div>
                    
                    <h6 class="fw-semibold text-primary mb-2"><i class="ri-settings-3-line me-1"></i> Other</h6>
                    <div class="keyboard-shortcuts">
                        <div class="keyboard-shortcut-item">
                            <span>Toggle Dark Mode</span>
                            <div><span class="kbd">Ctrl</span> + <span class="kbd">Shift</span> + <span class="kbd">L</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>

    <!-- Auto Complete JS -->
    <script src="{{ asset('assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- Date & Time Picker JS -->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Custom-Switcher JS -->
    <script src="{{ asset('assets/js/custom-switcher.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        // Set current year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
        
        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Navigation routes
        const navigationRoutes = {
            'd': '{{ route("dashboard") }}',
            'b': '{{ route("books.index") }}',
            's': '{{ route("students.index") }}',
            't': '{{ route("transactions.index") }}',
            'c': '{{ route("categories.index") }}',
            'p': '{{ route("profile.edit") }}'
        };
        
        // Keyboard shortcuts state
        let waitingForSecondKey = false;
        let shortcutTimeout = null;
        
        // Global keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Don't trigger shortcuts when typing in inputs
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.isContentEditable) {
                return;
            }
            
            // Cmd/Ctrl + K - Open search modal
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                var searchModal = new bootstrap.Modal(document.getElementById('searchModal'));
                searchModal.show();
                return;
            }
            
            // Cmd/Ctrl + Shift + L - Toggle dark mode
            if ((e.metaKey || e.ctrlKey) && e.shiftKey && e.key === 'L') {
                e.preventDefault();
                document.querySelector('.layout-setting').click();
                return;
            }
            
            // G then [key] navigation shortcuts
            if (e.key === 'g' || e.key === 'G') {
                if (!waitingForSecondKey) {
                    waitingForSecondKey = true;
                    // Show visual indicator
                    showToast('Press D (Dashboard), B (Books), S (Students), T (Transactions), C (Categories)', 'info');
                    // Reset after 2 seconds
                    shortcutTimeout = setTimeout(() => {
                        waitingForSecondKey = false;
                    }, 2000);
                }
                return;
            }
            
            // Second key for G+[key] navigation
            if (waitingForSecondKey) {
                const key = e.key.toLowerCase();
                if (navigationRoutes[key]) {
                    e.preventDefault();
                    window.location.href = navigationRoutes[key];
                }
                waitingForSecondKey = false;
                clearTimeout(shortcutTimeout);
                return;
            }
            
            // / key - Focus on search
            if (e.key === '/') {
                e.preventDefault();
                var searchModal = new bootstrap.Modal(document.getElementById('searchModal'));
                searchModal.show();
            }
        });
        
        // Search Modal functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchModal = document.getElementById('searchModal');
            const modalSearchInput = document.getElementById('modalSearchInput');
            const globalSearchInput = document.getElementById('globalSearch');
            const quickNavigation = document.getElementById('quickNavigation');
            const searchResultsContent = document.getElementById('searchResultsContent');
            const searchResultsList = document.getElementById('searchResultsList');
            const noResults = document.getElementById('noResults');
            const searchLoading = document.getElementById('searchLoading');
            const searchQueryText = document.getElementById('searchQueryText');
            
            // Search API endpoint (using relative URL)
            const searchApiUrl = '/search';
            
            // Focus on input when modal opens
            searchModal.addEventListener('shown.bs.modal', function() {
                modalSearchInput.focus();
                modalSearchInput.value = '';
                resetSearchUI();
            });
            
            // Reset UI function
            function resetSearchUI() {
                quickNavigation.classList.remove('d-none');
                searchResultsContent.classList.add('d-none');
                noResults.classList.add('d-none');
                searchLoading.classList.add('d-none');
            }
            
            // Color mapping for result types
            const typeColors = {
                'Student': 'info',
                'Book': 'success',
                'Category': 'secondary',
                'Transaction': 'warning',
                'Page': 'primary'
            };
            
            // Search function using API
            async function performSearch(query) {
                if (!query || query.trim().length < 2) {
                    resetSearchUI();
                    return;
                }
                
                quickNavigation.classList.add('d-none');
                searchLoading.classList.remove('d-none');
                searchResultsContent.classList.add('d-none');
                noResults.classList.add('d-none');
                
                try {
                    const response = await fetch(`${searchApiUrl}?q=${encodeURIComponent(query.trim())}`, {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    
                    const results = await response.json();
                    console.log('Search results:', results);
                    
                    searchLoading.classList.add('d-none');
                    
                    if (results.length > 0) {
                        searchResultsContent.classList.remove('d-none');
                        noResults.classList.add('d-none');
                        
                        searchResultsList.innerHTML = results.map(item => `
                            <a href="${item.url}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-2">
                                <div class="avatar avatar-sm bg-${typeColors[item.type] || 'primary'}-transparent rounded">
                                    <i class="${item.icon} text-${typeColors[item.type] || 'primary'}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-medium">${highlightMatch(item.title, query)}</span>
                                        <span class="badge bg-${typeColors[item.type] || 'primary'}-transparent text-${typeColors[item.type] || 'primary'} fs-10">${item.type}</span>
                                    </div>
                                    <span class="d-block text-muted fs-12">${highlightMatch(item.subtitle, query)}</span>
                                </div>
                            </a>
                        `).join('');
                    } else {
                        searchResultsContent.classList.add('d-none');
                        noResults.classList.remove('d-none');
                        searchQueryText.textContent = query;
                    }
                } catch (error) {
                    console.error('Search error:', error);
                    console.error('Search URL was:', `${searchApiUrl}?q=${encodeURIComponent(query.trim())}`);
                    searchLoading.classList.add('d-none');
                    noResults.classList.remove('d-none');
                    searchQueryText.textContent = query + ' (Error: ' + error.message + ')';
                }
            }
            
            // Highlight matching text
            function highlightMatch(text, query) {
                const regex = new RegExp(`(${query})`, 'gi');
                return text.replace(regex, '<mark class="bg-warning-transparent px-0">$1</mark>');
            }
            
            // Search input event (modal)
            let searchTimeout;
            modalSearchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value;
                
                if (query.length >= 2) {
                    // Show loading state immediately
                    quickNavigation.classList.add('d-none');
                    searchLoading.classList.remove('d-none');
                    searchResultsContent.classList.add('d-none');
                    noResults.classList.add('d-none');
                    
                    // Debounce the search
                    searchTimeout = setTimeout(() => {
                        performSearch(query);
                    }, 300);
                } else {
                    resetSearchUI();
                }
            });
            
            // Global search input (header) - opens modal on focus
            if (globalSearchInput) {
                globalSearchInput.addEventListener('focus', function() {
                    this.blur();
                    var modal = new bootstrap.Modal(searchModal);
                    modal.show();
                });
            }
            
            // Handle Enter key in search
            modalSearchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    const firstResult = searchResultsList.querySelector('a');
                    if (firstResult) {
                        window.location.href = firstResult.href;
                    }
                }
            });
        });
        
        // Toast notification function
        function showToast(message, type = 'info') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast toast-custom toast-${type} show`;
            const iconColor = type === 'success' ? 'success' : type === 'error' ? 'danger' : type === 'warning' ? 'warning' : 'info';
            const iconName = type === 'success' ? 'checkbox-circle' : type === 'error' ? 'error-warning' : type === 'warning' ? 'alert' : 'information';
            toast.innerHTML = `
                <div class="toast-body d-flex align-items-start gap-2 p-3">
                    <i class="ri-${iconName}-line fs-20 text-${iconColor}"></i>
                    <div class="flex-grow-1">${message}</div>
                    <button type="button" class="btn-close" onclick="this.parentElement.parentElement.remove()"></button>
                </div>
            `;
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
        
        // Auto-hide alerts after 5 seconds
        document.querySelectorAll('.alert-dismissible').forEach(function(alert) {
            setTimeout(function() {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    </script>

    @stack('scripts')
</body>

</html>
