<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'storyspace. - selle books')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    
    <style>
        :root {
            --bg-color: #f8f9fa;
            --text-color: #212529;
            --text-muted: #6c757d;
            --text-light: #f8f9fa;
            --card-bg: #ffffff;
            --card-border: #e9ecef;
            --navbar-bg: #ffffff;
            --footer-bg: #343a40;
            --footer-text: #ffffff;
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --table-header: #212529;
            --border-color: #dee2e6;
        }

        .dark-mode {
            --bg-color: #121212;
            --text-color: #e9ecef;
            --text-muted: #adb5bd;
            --text-light: #e9ecef;
            --card-bg: #1e1e1e;
            --card-border: #2d2d2d;
            --navbar-bg: #1a1a1a;
            --footer-bg: #0d0d0d;
            --footer-text: #adb5bd;
            --primary-color: #3d8bfd;
            --secondary-color: #adb5bd;
            --table-header: #2d2d2d;
            --border-color: #444;
        }

        /* Base Styles */
        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Text Colors */
        .text-muted {
            color: var(--text-muted) !important;
        }

        .text-white {
            color: var(--text-light) !important;
        }

        .text-dark, .text-black {
            color: var(--text-color) !important;
        }

        /* Border Colors */
        .border,
        .border-top,
        .border-bottom,
        .border-start,
        .border-end {
            border-color: var(--border-color) !important;
        }

        /* Navigation */
        .navbar {
            background-color: var(--navbar-bg) !important;
            transition: background-color 0.3s ease;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--text-color) !important;
        }

        .nav-link {
            color: var(--text-color) !important;
        }

        /* Cards */
        .card {
            background-color: var(--card-bg);
            border-color: var(--card-border);
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, 
                        background-color 0.3s ease, border-color 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
        }

        .card-img-top {
            aspect-ratio: 2/3;
            object-fit: contain;
            background-color: var(--table-striped);
            padding: 15px;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            color: var(--text-color);
            font-size: 1rem;
            font-weight: 600;
            height: 2.5rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .card-text {
            color: var(--secondary-color);
            font-size: 0.875rem;
            height: 3.5rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .card-footer {
            background-color: var(--card-bg);
            border-top: 1px solid var(--card-border);
            padding: 0.75rem 1.25rem;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Admin Buttons */
        .btn-group-sm {
            display: inline-flex;
            align-items: stretch;
            gap: 2px;
        }

        .btn-group-sm > * {
            flex: 0 0 auto;
        }

        .btn-group-sm .btn,
        .btn-group-sm .delete-btn,
        .btn-group-sm .delete-confirm,
        .btn-group-sm button[type="submit"] {
            padding: 0.25rem 0.5rem !important;
            font-size: 0.875rem !important;
            line-height: 1.5 !important;
            border-radius: 4px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 34px !important;
            min-height: 34px !important;
            border-width: 1px !important;
        }

        .btn-group-sm .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .btn-group-sm .btn-outline-info {
            color: #0dcaf0;
            border-color: #0dcaf0;
        }

        .btn-group-sm .btn-outline-info:hover {
            background-color: #0dcaf0;
            color: white;
        }

        .btn-group-sm .btn-outline-warning {
            color: #ffc107;
            border-color: #ffc107;
        }

        .btn-group-sm .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-group-sm .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-group-sm .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        /* Tables */
        .table {
            color: var(--text-color);
        }

        .table-dark {
            background-color: var(--table-header) !important;
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: var(--table-striped);
        }

        /* Forms */
        .form-control,
        .form-select,
        textarea.form-control {
            background-color: var(--card-bg);
            border-color: var(--card-border);
            color: var(--text-color);
        }

        .form-control:focus {
            background-color: var(--card-bg);
            border-color: var(--primary-color);
            color: var(--text-color);
        }

        ::placeholder {
            color: var(--text-muted) !important;
            opacity: 0.7;
        }

        .form-label {
            color: var(--text-color);
        }

        /* Footer */
        footer {
            background-color: var(--footer-bg) !important;
            color: var(--footer-text) !important;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        footer, footer * {
            color: var(--footer-text) !important;
        }

        /* Alerts */
        .alert {
            background-color: var(--card-bg);
            border-color: var(--card-border);
            color: var(--text-color);
        }

        /* Modals */
        .modal-content {
            background-color: var(--card-bg);
            color: var(--text-color);
        }

        /* Pagination */
        .page-link {
            background-color: var(--card-bg);
            border-color: var(--card-border);
            color: var(--text-color);
        }

        .page-link:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* About Section */
        #tentang {
            background-color: var(--table-header) !important;
            color: var(--footer-text) !important;
        }

        .about-section {
            background-color: var(--table-header);
            border-radius: 12px;
        }

        .about-title {
            color: var(--text-light);
        }

        .about-text {
            color: var(--text-light);
        }

        /* Links */
        a {
            color: var(--primary-color);
        }

        a:hover {
            color: var(--primary-color);
            opacity: 0.8;
        }

        /* Dropdown */
        .dropdown-menu {
            background-color: var(--card-bg);
            border-color: var(--border-color);
        }

        .dropdown-item {
            color: var(--text-color);
        }

        .dropdown-item:hover {
            background-color: var(--table-striped);
            color: var(--text-color);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--card-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary-color);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Layout */
        @media (min-width: 992px) {
            .row-cols-lg-3 > * {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
        }

        /* Utility Classes */
        .text-muted-custom {
            color: var(--text-muted);
        }

        .search-icon {
            color: var(--text-muted);
        }

        .clear-btn {
            color: var(--text-muted) !important;
        }

        .result-count {
            color: var(--text-muted);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @include('partials.navigation')
    
    <main class="py-4">
        <div class="container container-main">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>
    
    @include('partials.footer')
    
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Dark Mode Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;
            
            const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
            const currentTheme = localStorage.getItem('theme');
            
            if (currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
                body.classList.add('dark-mode');
                darkModeToggle.checked = true;
            }
            
            darkModeToggle.addEventListener('change', function() {
                if (this.checked) {
                    body.classList.add('dark-mode');
                    localStorage.setItem('theme', 'dark');
                } else {
                    body.classList.remove('dark-mode');
                    localStorage.setItem('theme', 'light');
                }
            });
            
            prefersDarkScheme.addEventListener('change', function(e) {
                if (!localStorage.getItem('theme')) {
                    if (e.matches) {
                        body.classList.add('dark-mode');
                        darkModeToggle.checked = true;
                    } else {
                        body.classList.remove('dark-mode');
                        darkModeToggle.checked = false;
                    }
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>