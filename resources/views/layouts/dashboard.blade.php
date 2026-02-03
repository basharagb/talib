<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'طالب'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family:
                {{ app()->getLocale() == 'ar' ? "'Cairo'" : "'Inter'" }}
                , sans-serif;
        }

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
            padding: 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #dee2e6;
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

        .brand-link:hover {
            color: #adb5bd;
        }

        .brand-image {
            margin-right: 0.5rem;
        }

        [dir="rtl"] .brand-image {
            margin-right: 0;
            margin-left: 0.5rem;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            border-bottom: 1px solid #495057;
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
            background: #495057;
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

        /* Sidebar submenu styles */
        .nav-treeview {
            display: none;
            padding-left: 1rem;
        }

        .nav-item.menu-open .nav-treeview {
            display: block;
        }

        .nav-item.menu-open>.nav-link .nav-arrow {
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

        /* Small Box Styles */
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
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .small-box-footer:hover {
            color: white;
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

    @yield('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!-- App Wrapper -->
    <div class="app-wrapper">
        <!-- Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!-- Sidebar Brand -->
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}" class="brand-link">
                    <div class="brand-image bg-primary rounded-circle d-flex align-items-center justify-center"
                        style="width: 33px; height: 33px;">
                        <span class="text-white fw-bold">ط</span>
                    </div>
                    <span class="brand-text fw-light">{{ __('messages.talib_platform') }}</span>
                </a>
            </div>

            <!-- Sidebar Wrapper -->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" role="navigation">
                        @php
                            $user = Auth::user();
                            $isAdmin = $user->isAdmin();
                            $isPending = $user->isPending();
                            $isActive = $user->isActive();
                        @endphp

                        @if($isPending)
                            {{-- المستخدم المعلق يرى حالة التسجيل والرئيسية --}}
                            <li class="nav-item">
                                <a href="{{ route('home') }}"
                                    class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-house-door"></i>
                                    <p>الرئيسية</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payment.status', ['subscription' => $user->subscription->id ?? 0]) }}"
                                    class="nav-link {{ request()->routeIs('payment.status') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-hourglass-split"></i>
                                    <p>{{ __('messages.registration_status') }}</p>
                                </a>
                            </li>
                        @else
                            {{-- المستخدم النشط أو الأدمن --}}

                            @if($isAdmin)
                                <!-- لوحة التحكم - للأدمن فقط -->
                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}"
                                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-speedometer"></i>
                                        <p>{{ __('messages.dashboard') }}</p>
                                    </a>
                                </li>
                            @endif

                            <!-- الملف الشخصي - للجميع -->
                            <li class="nav-item">
                                <a href="{{ route('profile.edit') }}"
                                    class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-person-circle"></i>
                                    <p>{{ __('messages.profile') }}</p>
                                </a>
                            </li>

                            @if($isAdmin)
                                <!-- البحث - للأدمن فقط في لوحة التحكم -->
                                <li class="nav-item">
                                    <a href="{{ route('search') }}"
                                        class="nav-link {{ request()->routeIs('search*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-search"></i>
                                        <p>{{ __('messages.search') }}</p>
                                    </a>
                                </li>

                                <!-- مراجعة التسجيلات - للأدمن فقط -->
                                <li class="nav-item">
                                    <a href="{{ route('admin.registrations.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
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

                                <!-- إدارة المستخدمين - للأدمن فقط -->
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-people"></i>
                                        <p>{{ __('messages.user_management') }}</p>
                                    </a>
                                </li>

                                <!-- التحليلات - للأدمن فقط -->
                                <li class="nav-item">
                                    <a href="{{ route('admin.analytics.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-graph-up"></i>
                                        <p>{{ __('messages.analytics') }}</p>
                                    </a>
                                </li>

                                <!-- قائمة التسجيل - للأدمن فقط -->
                                <li class="nav-item {{ request()->routeIs('register.*') ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-person-plus"></i>
                                        <p>{{ __('messages.registration') }}
                                            <i class="nav-arrow bi bi-chevron-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('register.teacher') }}"
                                                class="nav-link {{ request()->routeIs('register.teacher') ? 'active' : '' }}">
                                                <i class="nav-icon bi bi-circle"></i>
                                                <p>{{ __('messages.teacher') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('register.educational-center') }}"
                                                class="nav-link {{ request()->routeIs('register.educational-center') ? 'active' : '' }}">
                                                <i class="nav-icon bi bi-circle"></i>
                                                <p>{{ __('messages.educational_center') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('register.school') }}"
                                                class="nav-link {{ request()->routeIs('register.school') ? 'active' : '' }}">
                                                <i class="nav-icon bi bi-circle"></i>
                                                <p>{{ __('messages.school') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('register.kindergarten') }}"
                                                class="nav-link {{ request()->routeIs('register.kindergarten') ? 'active' : '' }}">
                                                <i class="nav-icon bi bi-circle"></i>
                                                <p>{{ __('messages.kindergarten') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('register.nursery') }}"
                                                class="nav-link {{ request()->routeIs('register.nursery') ? 'active' : '' }}">
                                                <i class="nav-icon bi bi-circle"></i>
                                                <p>{{ __('messages.nursery') }}</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- الإعدادات - للأدمن فقط -->
                                <li class="nav-item">
                                    <a href="{{ route('profile.edit') }}" class="nav-link">
                                        <i class="nav-icon bi bi-gear"></i>
                                        <p>{{ __('messages.settings') }}</p>
                                    </a>
                                </li>
                            @endif
                        @endif
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
                        <li class="nav-item d-none d-md-block">
                            <a href="{{ route('home') }}" class="nav-link">{{ __('messages.home') }}</a>
                        </li>
                    </ul>

                    <!-- End Navbar Links -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Language Switcher -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-globe"></i>
                                {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('locale.switch', 'ar') }}">العربية</a></li>
                                <li><a class="dropdown-item" href="{{ route('locale.switch', 'en') }}">English</a></li>
                            </ul>
                        </li>

                        <!-- User Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ route('profile.edit') }}">{{ __('messages.profile') }}</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">{{ __('messages.logout') }}</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Content Header -->
            @hasSection('content-header')
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">@yield('page-title')</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a>
                                    </li>
                                    @yield('breadcrumb')
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Content -->
            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS functionality -->
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggle = document.querySelector('[data-lte-toggle="sidebar"]');
            const sidebar = document.querySelector('.app-sidebar');

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    sidebar.classList.toggle('show');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function (e) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            // Submenu toggle functionality
            const menuItems = document.querySelectorAll('.nav-item > .nav-link');
            menuItems.forEach(function (menuItem) {
                menuItem.addEventListener('click', function (e) {
                    const parentItem = this.parentNode;
                    const submenu = parentItem.querySelector('.nav-treeview');

                    if (submenu) {
                        e.preventDefault();
                        parentItem.classList.toggle('menu-open');

                        // Close other open menus
                        const otherOpenMenus = document.querySelectorAll('.nav-item.menu-open');
                        otherOpenMenus.forEach(function (openMenu) {
                            if (openMenu !== parentItem) {
                                openMenu.classList.remove('menu-open');
                            }
                        });
                    }
                });
            });
        });
    </script>

    @yield('scripts')
</body>

</html>