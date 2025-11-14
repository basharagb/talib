<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.dashboard') }} - {{ config('app.name', 'طالب') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <!-- AdminLTE CSS -->
    <style>
        .font-arabic { font-family: 'Cairo', sans-serif; }
        .font-english { font-family: 'Inter', sans-serif; }
        body { font-family: {{ app()->getLocale() == 'ar' ? "'Cairo'" : "'Inter'" }}, sans-serif; }
        
        /* AdminLTE-inspired styles with RTL support */
        .app-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .app-sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        
        /* RTL Support */
        [dir="rtl"] .app-sidebar {
            right: 0;
            left: auto;
        }
        
        [dir="ltr"] .app-sidebar {
            left: 0;
            right: auto;
        }
        
        .app-main {
            flex: 1;
            background: #f4f6f9;
            min-height: 100vh;
        }
        
        [dir="rtl"] .app-main {
            margin-right: 250px;
            margin-left: 0;
        }
        
        [dir="ltr"] .app-main {
            margin-left: 250px;
            margin-right: 0;
        }
        
        .app-header {
            background: white;
            border-bottom: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
        }
        
        .app-content-header {
            background: white;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
        }
        
        .app-content {
            padding: 1rem;
        }
        
        .sidebar-brand {
            padding: 1rem;
            border-bottom: 1px solid #495057;
        }
        
        .brand-link {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
        }
        
        .brand-image {
            width: 33px;
            height: 33px;
            margin-right: 0.5rem;
        }
        
        .sidebar-wrapper {
            padding: 0;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .nav-item {
            margin: 0;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #c2c7d0;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .nav-link:hover,
        .nav-link.active {
            background: #007bff;
            color: white;
        }
        
        .nav-icon {
            width: 1rem;
        }
        
        [dir="rtl"] .nav-icon {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        
        [dir="ltr"] .nav-icon {
            margin-right: 0.5rem;
            margin-left: 0;
        }
        
        .small-box {
            border-radius: 0.375rem;
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .small-box .inner h3 {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
        }
        
        .small-box .inner p {
            margin: 0;
            opacity: 0.8;
        }
        
        .small-box-icon {
            position: absolute;
            top: 1rem;
            width: 4rem;
            height: 4rem;
            opacity: 0.3;
        }
        
        [dir="rtl"] .small-box-icon {
            left: 1rem;
            right: auto;
        }
        
        [dir="ltr"] .small-box-icon {
            right: 1rem;
            left: auto;
        }
        
        .small-box-footer {
            display: block;
            padding: 0.5rem 0;
            margin-top: 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        .text-bg-primary { background-color: #007bff !important; }
        .text-bg-success { background-color: #28a745 !important; }
        .text-bg-warning { background-color: #ffc107 !important; color: #212529 !important; }
        .text-bg-danger { background-color: #dc3545 !important; }
        
        /* Fix Bootstrap conflicts */
        .app-wrapper .row {
            margin-right: 0;
            margin-left: 0;
        }
        
        .app-wrapper .col-lg-3,
        .app-wrapper .col-6 {
            padding-right: 0.75rem;
            padding-left: 0.75rem;
        }
        
        /* Improve card spacing */
        .small-box {
            margin-bottom: 1rem;
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        }
        
        /* Better responsive behavior */
        @media (max-width: 576px) {
            .small-box .inner h3 {
                font-size: 1.8rem;
            }
        }
        
        /* Sidebar submenu styles */
        .nav-treeview {
            display: none;
            padding-left: 1rem;
        }
        
        .nav-item.menu-open .nav-treeview {
            display: block;
        }
        
        .nav-item.menu-open > .nav-link .nav-arrow {
            transform: rotate(90deg);
        }
        
        .nav-arrow {
            transition: transform 0.3s;
            margin-left: auto;
        }
        
        [dir="rtl"] .nav-arrow {
            margin-left: 0;
            margin-right: auto;
        }
        
        .nav-treeview .nav-link {
            padding-left: 2rem;
        }
        
        [dir="rtl"] .nav-treeview .nav-link {
            padding-left: 1rem;
            padding-right: 2rem;
        }
        
        @media (max-width: 768px) {
            .app-sidebar {
                transition: transform 0.3s;
            }
            
            [dir="ltr"] .app-sidebar {
                transform: translateX(-100%);
            }
            
            [dir="rtl"] .app-sidebar {
                transform: translateX(100%);
            }
            
            .app-sidebar.show {
                transform: translateX(0);
            }
            
            .app-main {
                margin-left: 0;
                margin-right: 0;
            }
        }
    </style>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!-- App Wrapper -->
    <div class="app-wrapper">
        <!-- Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!-- Sidebar Brand -->
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}" class="brand-link">
                    <div class="brand-image bg-primary rounded-circle d-flex align-items-center justify-center" style="width: 33px; height: 33px;">
                        <span class="text-white fw-bold">ط</span>
                    </div>
                    <span class="brand-text fw-light">{{ __('messages.talib_platform') }}</span>
                </a>
            </div>
            
            <!-- Sidebar Wrapper -->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" role="navigation">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link active">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>{{ __('messages.dashboard') }}</p>
                            </a>
                        </li>
                        
                        <!-- Profile -->
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link">
                                <i class="nav-icon bi bi-person-circle"></i>
                                <p>{{ __('messages.profile') }}</p>
                            </a>
                        </li>
                        
                        <!-- Search -->
                        <li class="nav-item">
                            <a href="{{ route('search') }}" class="nav-link">
                                <i class="nav-icon bi bi-search"></i>
                                <p>{{ __('messages.search') }}</p>
                            </a>
                        </li>
                        
                        <!-- Registration Review -->
                        <li class="nav-item">
                            <a href="{{ route('admin.registrations.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-clipboard-check"></i>
                                <p>{{ __('messages.registration_review') }}
                                    @php
                                        $pendingCount = \App\Models\User::where('status', 'pending')->count();
                                    @endphp
                                    @if($pendingCount > 0)
                                        <span class="badge bg-danger rounded-pill ms-2">{{ $pendingCount }}</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                        
                        <!-- Registration Menu -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-person-plus"></i>
                                <p>{{ __('messages.registration') }}
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('register.teacher') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>{{ __('messages.teacher') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('register.educational-center') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>{{ __('messages.educational_center') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('register.school') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>{{ __('messages.school') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('register.kindergarten') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>{{ __('messages.kindergarten') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('register.nursery') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>{{ __('messages.nursery') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- Settings -->
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link">
                                <i class="nav-icon bi bi-gear"></i>
                                <p>{{ __('messages.settings') }}</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="app-main">
            <!-- Header -->
            <nav class="app-header navbar navbar-expand bg-body">
                <div class="container-fluid">
                    <!-- Start Navbar Links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                                <i class="bi bi-list"></i>
                            </a>
                        </li>
                        <li class="nav-item d-none d-md-block">
                            <a href="{{ route('home') }}" class="nav-link">{{ __('messages.home') }}</a>
                        </li>
                    </ul>
                    
                    <!-- End Navbar Links -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Language Switcher -->
                        <li class="nav-item dropdown">
                            <select onchange="window.location.href='/locale/' + this.value" class="form-select form-select-sm">
                                <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>🇸🇦 العربية</option>
                                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇺🇸 English</option>
                            </select>
                        </li>
                        
                        <!-- User Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-bs-toggle="dropdown" href="#">
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <span class="dropdown-item-text">{{ Auth::user()->name }}</span>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <i class="bi bi-person me-2"></i> {{ __('messages.profile') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('messages.logout') }}
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Content Header -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">{{ __('messages.dashboard') }}</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('messages.dashboard') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="app-content">
                <div class="container-fluid">
                    <!-- Statistics Row -->
                    <!-- First Row - Main Categories -->
                    <div class="row">
                        <!-- Teachers -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    @php
                                        $teacherCount = \App\Models\User::where('role', 'teacher')->where('status', 'active')->count();
                                    @endphp
                                    <h3>{{ $teacherCount }}</h3>
                                    <p>{{ __('messages.teachers') }}</p>
                                    <small class="opacity-75">{{ __('messages.teacher_fee') }}</small>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <a href="{{ route('register.teacher') }}" class="small-box-footer">
                                    {{ __('messages.register_now') }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Educational Centers -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-success">
                                <div class="inner">
                                    @php
                                        $centerCount = \App\Models\User::where('role', 'educational_center')->where('status', 'active')->count();
                                    @endphp
                                    <h3>{{ $centerCount }}</h3>
                                    <p>{{ __('messages.educational_centers') }}</p>
                                    <small class="opacity-75">{{ __('messages.center_fee') }}</small>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <a href="{{ route('register.educational-center') }}" class="small-box-footer">
                                    {{ __('messages.register_now') }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Private Schools -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-warning">
                                <div class="inner">
                                    @php
                                        $schoolCount = \App\Models\User::where('role', 'school')->where('status', 'active')->count();
                                    @endphp
                                    <h3>{{ $schoolCount }}</h3>
                                    <p>{{ __('messages.private_schools') }}</p>
                                    <small class="opacity-75">{{ __('messages.school_fee') }}</small>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                </svg>
                                <a href="{{ route('register.school') }}" class="small-box-footer">
                                    {{ __('messages.register_now') }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Total Revenue -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-info">
                                <div class="inner">
                                    @php
                                        $totalRevenue = ($teacherCount * 10) + ($centerCount * 25) + ($schoolCount * 50);
                                        $kindergartenCount = \App\Models\User::where('role', 'kindergarten')->where('status', 'active')->count();
                                        $nurseryCount = \App\Models\User::where('role', 'nursery')->where('status', 'active')->count();
                                        $totalRevenue += ($kindergartenCount * 50) + ($nurseryCount * 40);
                                    @endphp
                                    <h3>{{ number_format($totalRevenue) }}</h3>
                                    <p>{{ __('messages.total_revenue') }}</p>
                                    <small class="opacity-75">{{ __('messages.jd') }} {{ __('messages.annually') }}</small>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2v20m8-10H4"></path>
                                </svg>
                                <a href="#" class="small-box-footer">
                                    {{ __('messages.view_details') }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row - Additional Categories -->
                    <div class="row mt-3">
                        <!-- Kindergartens -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-secondary">
                                <div class="inner">
                                    <h3>{{ $kindergartenCount }}</h3>
                                    <p>{{ __('messages.kindergartens') }}</p>
                                    <small class="opacity-75">{{ __('messages.kindergarten_fee') }}</small>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                                <a href="{{ route('register.kindergarten') }}" class="small-box-footer">
                                    {{ __('messages.register_now') }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Nurseries -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-dark">
                                <div class="inner">
                                    <h3>{{ $nurseryCount }}</h3>
                                    <p>{{ __('messages.nurseries') }}</p>
                                    <small class="opacity-75">{{ __('messages.nursery_fee') }}</small>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                                <a href="{{ route('register.nursery') }}" class="small-box-footer">
                                    {{ __('messages.register_now') }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Free Users (Students/Parents) -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-light text-dark">
                                <div class="inner">
                                    @php
                                        $studentCount = \App\Models\User::where('role', 'student')->count();
                                    @endphp
                                    <h3>{{ $studentCount }}</h3>
                                    <p>{{ __('messages.students_parents') }}</p>
                                    <small class="opacity-75">{{ __('messages.student_free') }}</small>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <a href="{{ route('search') }}" class="small-box-footer">
                                    {{ __('messages.search_platform') }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Pending Registrations -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-danger">
                                <div class="inner">
                                    @php
                                        $pendingCount = \App\Models\User::where('status', 'pending')->count();
                                    @endphp
                                    <h3>{{ $pendingCount }}</h3>
                                    <p>{{ __('messages.pending_registrations') }}</p>
                                    <small class="opacity-75">{{ __('messages.needs_review') }}</small>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <a href="{{ route('admin.registrations.index') }}" class="small-box-footer">
                                    {{ __('messages.review_now') }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content Cards Row -->
                    <div class="row mt-4">
                        <!-- Recent Activity -->
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('messages.recent_activity') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                <div class="flex-shrink-0">
                                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-center" style="width: 40px; height: 40px;">
                                                        <i class="bi bi-person-plus text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">{{ __('messages.new_student_enrolled') }}</h6>
                                                    <p class="mb-0 text-muted">أحمد محمد انضم إلى دورة الرياضيات</p>
                                                    <small class="text-muted">{{ __('messages.activity_time_1') }}</small>
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                <div class="flex-shrink-0">
                                                    <div class="bg-success rounded-circle d-flex align-items-center justify-center" style="width: 40px; height: 40px;">
                                                        <i class="bi bi-check-circle text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">{{ __('messages.assignment_completed') }}</h6>
                                                    <p class="mb-0 text-muted">سارة أحمد أكملت واجب الفيزياء</p>
                                                    <small class="text-muted">{{ __('messages.activity_time_2') }}</small>
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                <div class="flex-shrink-0">
                                                    <div class="bg-warning rounded-circle d-flex align-items-center justify-center" style="width: 40px; height: 40px;">
                                                        <i class="bi bi-person-check text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">{{ __('messages.new_teacher_registered') }}</h6>
                                                    <p class="mb-0 text-muted">د. محمد علي انضم كمعلم كيمياء</p>
                                                    <small class="text-muted">{{ __('messages.activity_time_3') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('messages.quick_actions') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('search') }}" class="btn btn-primary">
                                            <i class="bi bi-search me-2"></i>{{ __('messages.search_platform') }}
                                        </a>
                                        <a href="{{ route('admin.registrations.index') }}" class="btn btn-danger">
                                            <i class="bi bi-clipboard-check me-2"></i>{{ __('messages.registration_review') }}
                                            @php
                                                $quickPendingCount = \App\Models\User::where('status', 'pending')->count();
                                            @endphp
                                            @if($quickPendingCount > 0)
                                                <span class="badge bg-white text-danger ms-2">{{ $quickPendingCount }}</span>
                                            @endif
                                        </a>
                                        
                                        <hr class="my-2">
                                        <small class="text-muted text-center">{{ __('messages.registration_options') }}</small>
                                        
                                        <a href="{{ route('register.teacher') }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-person me-2"></i>{{ __('messages.teacher') }} (10 {{ __('messages.jd') }})
                                        </a>
                                        <a href="{{ route('register.educational-center') }}" class="btn btn-outline-success btn-sm">
                                            <i class="bi bi-building me-2"></i>{{ __('messages.educational_center') }} (25 {{ __('messages.jd') }})
                                        </a>
                                        <a href="{{ route('register.school') }}" class="btn btn-outline-warning btn-sm">
                                            <i class="bi bi-mortarboard me-2"></i>{{ __('messages.school') }} (50 {{ __('messages.jd') }})
                                        </a>
                                        <a href="{{ route('register.kindergarten') }}" class="btn btn-outline-info btn-sm">
                                            <i class="bi bi-star me-2"></i>{{ __('messages.kindergarten') }} (50 {{ __('messages.jd') }})
                                        </a>
                                        <a href="{{ route('register.nursery') }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-heart me-2"></i>{{ __('messages.nursery') }} (40 {{ __('messages.jd') }})
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Welcome Card -->
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="card-title mb-0">{{ __('messages.welcome_back') }}</h3>
                                </div>
                                <div class="card-body">
                                    <h5>{{ Auth::user()->name }}!</h5>
                                    <p class="text-muted">{{ __('messages.dashboard_subtitle') }}</p>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success rounded-circle me-2" style="width: 8px; height: 8px;"></div>
                                        <small class="text-muted">{{ __('messages.active') }} - {{ now()->format('l, F j, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AdminLTE JS functionality -->
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('[data-lte-toggle="sidebar"]');
            const sidebar = document.querySelector('.app-sidebar');
            
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });
            
            // Submenu toggle functionality
            const menuItems = document.querySelectorAll('.nav-item > .nav-link');
            menuItems.forEach(function(menuItem) {
                menuItem.addEventListener('click', function(e) {
                    const parentItem = this.parentNode;
                    const submenu = parentItem.querySelector('.nav-treeview');
                    
                    if (submenu) {
                        e.preventDefault();
                        parentItem.classList.toggle('menu-open');
                        
                        // Close other open menus
                        const otherOpenMenus = document.querySelectorAll('.nav-item.menu-open');
                        otherOpenMenus.forEach(function(openMenu) {
                            if (openMenu !== parentItem) {
                                openMenu.classList.remove('menu-open');
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
