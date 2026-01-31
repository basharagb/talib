<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ app()->getLocale() == 'ar' ? 'طالب - منصة التعليم الرقمي الرائدة' : 'Talib - Leading Digital Education Platform' }}
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'cairo': ['Cairo', 'sans-serif'],
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        'secondary': {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'slide-down': 'slideDown 0.8s ease-out',
                        'slide-left': 'slideLeft 0.8s ease-out',
                        'slide-right': 'slideRight 0.8s ease-out',
                        'scale-in': 'scaleIn 0.8s ease-out',
                        'bounce-in': 'bounceIn 1s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'spin-slow': 'spin 8s linear infinite',
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideLeft {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Gradients */
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 50%, rgba(255, 255, 255, 0.1) 100%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {

            0%,
            100% {
                transform: translateX(-100%);
            }

            50% {
                transform: translateX(100%);
            }
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-gradient {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Glass Effect */
        .glass-nav {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Interactive Elements */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
        }

        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .feature-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
            border-color: rgba(102, 126, 234, 0.3);
            background: rgba(255, 255, 255, 0.1);
        }

        /* Stats Counter Animation */
        .stat-number {
            font-variant-numeric: tabular-nums;
        }

        /* Floating Elements */
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(2) {
            animation-delay: -2s;
        }

        .floating-element:nth-child(3) {
            animation-delay: -4s;
        }

        /* Scroll Animations */
        .scroll-animate {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .scroll-animate.animate {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }
    </style>
</head>

<body
    class="{{ app()->getLocale() == 'ar' ? 'font-cairo' : 'font-inter' }} antialiased bg-gradient-to-br from-slate-50 to-blue-50 overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-nav animate-slide-down">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Logo -->
                <div class="flex items-center animate-slide-right">
                    <div class="relative">
                        <div class="text-2xl md:text-4xl font-black text-gradient">طالب</div>
                        <div
                            class="absolute -top-0.5 -right-0.5 w-2 h-2 md:w-3 md:h-3 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full animate-pulse">
                        </div>
                    </div>
                    <div class="mr-2 md:mr-4 text-xs md:text-sm text-gray-600 font-medium hidden sm:block">
                        <div>{{ app()->getLocale() == 'ar' ? 'منصة التعليم الرقمي' : 'Digital Education Platform' }}
                        </div>
                        <div class="text-xs text-primary-500">
                            {{ app()->getLocale() == 'ar' ? 'الرائدة في المنطقة' : 'Leading in the Region' }}
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-6 lg:gap-8 animate-slide-down">
                    <a href="#home"
                        class="nav-link text-gray-700 hover:text-primary-600 transition-all duration-300 font-medium relative group px-2">
                        {{ __('messages.home') }}
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-500 to-secondary-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#features"
                        class="nav-link text-gray-700 hover:text-primary-600 transition-all duration-300 font-medium relative group px-2">
                        {{ __('messages.features') }}
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-500 to-secondary-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#stats"
                        class="nav-link text-gray-700 hover:text-primary-600 transition-all duration-300 font-medium relative grouppx-2">
                        {{ __('messages.statistics') }}
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-500 to-secondary-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#testimonials"
                        class="nav-link text-gray-700 hover:text-primary-600 transition-all duration-300 font-medium relative group px-2">
                        {{ __('messages.testimonials') }}
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-500 to-secondary-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#contact"
                        class="nav-link text-gray-700 hover:text-primary-600 transition-all duration-300 font-medium relative group px-2">
                        {{ __('messages.contact') }}
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary-500 to-secondary-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

                <!-- Language Switcher -->
                <div class="hidden md:flex items-center space-x-2 space-x-reverse">
                    <div class="relative group">
                        <button
                            class="flex items-center space-x-2 space-x-reverse text-gray-700 hover:text-primary-600 transition-all duration-300 font-medium px-4 py-2 rounded-lg hover:bg-primary-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
                                </path>
                            </svg>
                            <span>{{ __('messages.language') }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div
                            class="absolute {{ app()->getLocale() == 'ar' ? 'right-0' : 'left-0' }} mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="{{ route('locale.switch', 'ar') }}"
                                class="flex items-center space-x-3 space-x-reverse px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors {{ app()->getLocale() == 'ar' ? 'bg-primary-50 text-primary-600' : '' }}">
                                <span class="text-lg">🇸🇦</span>
                                <span>{{ __('messages.arabic') }}</span>
                            </a>
                            <a href="{{ route('locale.switch', 'en') }}"
                                class="flex items-center space-x-3 space-x-reverse px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors {{ app()->getLocale() == 'en' ? 'bg-primary-50 text-primary-600' : '' }}">
                                <span class="text-lg">🇺🇸</span>
                                <span>{{ __('messages.english') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-2 space-x-reverse animate-slide-left">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="btn-primary text-white px-4 py-2 md:px-8 md:py-3 rounded-full font-semibold shadow-lg text-sm md:text-base">
                            <span class="hidden sm:inline">{{ __('messages.dashboard') }}</span>
                            <span class="sm:hidden">لوحة التحكم</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="hidden md:block text-gray-700 hover:text-primary-600 transition-all duration-300 font-medium px-4 py-2 rounded-lg hover:bg-primary-50">
                            {{ __('messages.nav_login') }}
                        </a>
                        <a href="#register"
                            class="btn-primary text-white px-4 py-2 md:px-8 md:py-3 rounded-full font-semibold shadow-lg text-sm md:text-base">
                            <span class="hidden sm:inline">{{ __('messages.start_now') }}</span>
                            <span class="sm:hidden">ابدأ الآن</span>
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button
                        class="md:hidden text-gray-700 hover:text-primary-600 transition-colors p-2 rounded-lg hover:bg-gray-100"
                        onclick="toggleMobileMenu()" id="mobile-menu-button">
                        <svg class="w-6 h-6 transition-transform duration-300" id="menu-icon" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="w-6 h-6 transition-transform duration-300 hidden" id="close-icon" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu"
                class="md:hidden hidden bg-white/95 backdrop-blur-lg border-t border-gray-200 animate-slide-down">
                <div class="px-4 py-4 space-y-2">
                    <a href="#home"
                        class="mobile-nav-link block text-gray-700 hover:text-primary-600 transition-colors font-medium py-3 px-4 rounded-lg hover:bg-primary-50 text-base">{{ __('messages.home') }}</a>
                    <a href="#features"
                        class="mobile-nav-link block text-gray-700 hover:text-primary-600 transition-colors font-medium py-3 px-4 rounded-lg hover:bg-primary-50 text-base">{{ __('messages.features') }}</a>
                    <a href="#stats"
                        class="mobile-nav-link block text-gray-700 hover:text-primary-600 transition-colors font-medium py-3 px-4 rounded-lg hover:bg-primary-50 text-base">{{ __('messages.statistics') }}</a>
                    <a href="#testimonials"
                        class="mobile-nav-link block text-gray-700 hover:text-primary-600 transition-colors font-medium py-3 px-4 rounded-lg hover:bg-primary-50 text-base">{{ __('messages.testimonials') }}</a>
                    <a href="#contact"
                        class="mobile-nav-link block text-gray-700 hover:text-primary-600 transition-colors font-medium py-3 px-4 rounded-lg hover:bg-primary-50 text-base">{{ __('messages.contact') }}</a>

                    <!-- Language Switcher for Mobile -->
                    <div class="border-t border-gray-200 pt-3 mt-3">
                        <div class="space-y-2">
                            <a href="{{ route('locale.switch', 'ar') }}"
                                class="mobile-nav-link flex items-center space-x-3 space-x-reverse text-gray-700 hover:text-primary-600 transition-colors font-medium py-3 px-4 rounded-lg hover:bg-primary-50 text-base {{ app()->getLocale() == 'ar' ? 'bg-primary-50 text-primary-600' : '' }}">
                                <span class="text-xl">🇸🇦</span>
                                <span>{{ __('messages.arabic') }}</span>
                            </a>
                            <a href="{{ route('locale.switch', 'en') }}"
                                class="mobile-nav-link flex items-center space-x-3 space-x-reverse text-gray-700 hover:text-primary-600 transition-colors font-medium py-3 px-4 rounded-lg hover:bg-primary-50 text-base {{ app()->getLocale() == 'en' ? 'bg-primary-50 text-primary-600' : '' }}">
                                <span class="text-xl">🇺🇸</span>
                                <span>{{ __('messages.english') }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-3 mt-3">
                        @guest
                            <a href="{{ route('login') }}"
                                class="mobile-nav-link block text-gray-700 hover:text-primary-600 transition-colors font-medium py-3 px-4 rounded-lg hover:bg-primary-50 text-base">{{ __('messages.nav_login') }}</a>
                            <a href="#register"
                                class="mobile-nav-link block btn-primary text-white py-3 px-4 rounded-lg mt-2 text-center text-base font-bold">{{ __('messages.start_now') }}</a>
                        @else
                            <a href="{{ url('/dashboard') }}"
                                class="mobile-nav-link block btn-primary text-white py-3 px-4 rounded-lg text-center text-base font-bold">{{ __('messages.dashboard') }}</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen hero-gradient flex items-center justify-center relative overflow-hidden">
        <!-- Floating Background Elements -->
        <div class="absolute inset-0 overflow-hidden hidden md:block">
            <div class="floating-element absolute top-20 right-10 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
            <div class="floating-element absolute top-40 left-20 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
            <div class="floating-element absolute bottom-20 right-1/4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            <div class="floating-element absolute bottom-40 left-10 w-16 h-16 bg-white/15 rounded-full blur-lg"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10 pt-20 pb-8 md:pt-0">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center min-h-screen">
                <!-- Content -->
                <div
                    class="text-white space-y-4 sm:space-y-6 lg:space-y-12 text-center lg:text-right order-2 lg:order-1">
                    <div class="animate-slide-right">
                        <div
                            class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 sm:px-6 py-2 mb-4 sm:mb-6">
                            <span
                                class="w-2 h-2 sm:w-3 sm:h-3 bg-green-400 rounded-full animate-pulse {{ app()->getLocale() == 'ar' ? 'ml-2 sm:ml-3' : 'mr-2 sm:mr-3' }}"></span>
                            <span
                                class="text-sm sm:text-base font-medium">{{ app()->getLocale() == 'ar' ? 'منصة تعليمية متطورة' : 'Advanced Educational Platform' }}</span>
                        </div>

                        <h1
                            class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black leading-tight mb-4 sm:mb-6">
                            {{ __('messages.hero_title') }}
                        </h1>
                    </div>

                    <p
                        class="text-lg sm:text-xl md:text-2xl lg:text-3xl text-gray-100 leading-relaxed max-w-2xl mx-auto lg:mx-0 animate-slide-up px-2 lg:px-0">
                        {{ __('messages.hero_subtitle') }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 animate-slide-up px-2 lg:px-0">
                        <a href="#register"
                            class="btn-primary text-white px-6 py-3 sm:px-8 sm:py-4 rounded-full font-bold text-base sm:text-lg shadow-2xl inline-flex items-center justify-center group">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 {{ app()->getLocale() == 'ar' ? 'ml-2 group-hover:translate-x-1' : 'mr-2 group-hover:-translate-x-1' }} transition-transform"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('messages.get_started') }}
                        </a>
                        <a href="#features"
                            class="border-2 border-white/30 text-white px-6 py-3 sm:px-8 sm:py-4 rounded-full font-semibold text-base sm:text-lg hover:bg-white/10 transition-all backdrop-blur-sm inline-flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ __('messages.learn_more') }}
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-4 lg:gap-8 pt-6 sm:pt-8 animate-slide-up">
                        <div
                            class="text-center bg-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-6 lg:p-8">
                            <div class="text-2xl sm:text-4xl lg:text-5xl font-bold stat-number" data-target="5000">0
                            </div>
                            <div class="text-xs sm:text-base text-gray-200 mt-1 sm:mt-2">
                                {{ __('messages.active_users') }}</div>
                        </div>
                        <div
                            class="text-center bg-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-6 lg:p-8">
                            <div class="text-2xl sm:text-4xl lg:text-5xl font-bold stat-number" data-target="150">0
                            </div>
                            <div class="text-xs sm:text-base text-gray-200 mt-1 sm:mt-2">
                                {{ __('messages.educational_institutions') }}
                            </div>
                        </div>
                        <div
                            class="text-center bg-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-6 lg:p-8">
                            <div class="text-2xl sm:text-4xl lg:text-5xl font-bold stat-number" data-target="98">0</div>
                            <div class="text-xs sm:text-base text-gray-200 mt-1 sm:mt-2">
                                {{ app()->getLocale() == 'ar' ? '% نسبة الرضا' : '% ' . __('messages.customer_satisfaction') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Elements -->
                <div class="relative animate-slide-left order-1 lg:order-2 mb-12 lg:mb-0 hidden lg:block">
                    <div class="relative z-10">
                        <!-- Main Card -->
                        <div
                            class="card-gradient rounded-3xl p-8 shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <h3 class="font-bold text-gray-900">أحمد محمد</h3>
                                        <p class="text-sm text-gray-600">معلم رياضيات</p>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">الطلاب النشطين</span>
                                        <span class="font-semibold text-primary-600">45</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">التقييم</span>
                                        <div class="flex text-yellow-400">
                                            ★★★★★
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div
                                            class="bg-gradient-to-r from-primary-500 to-secondary-500 h-2 rounded-full w-4/5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Cards -->
                        <div class="absolute -top-4 -left-4 card-gradient rounded-xl p-4 shadow-lg animate-float">
                            <div class="flex items-center text-white">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center ml-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">درس مكتمل</span>
                            </div>
                        </div>

                        <div class="absolute -bottom-4 -right-4 card-gradient rounded-xl p-4 shadow-lg animate-float"
                            style="animation-delay: -2s;">
                            <div class="flex items-center text-white">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center ml-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">{{ __('messages.new_students') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#features" class="text-white/70 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-12 sm:py-16 lg:py-20 bg-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 1px 1px, #667eea 1px, transparent 0); background-size: 20px 20px;">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16 scroll-animate">
                <div
                    class="inline-flex items-center bg-primary-50 text-primary-600 rounded-full px-3 sm:px-4 py-1.5 sm:py-2 mb-3 sm:mb-4">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 {{ app()->getLocale() == 'ar' ? 'ml-1.5 sm:ml-2' : 'mr-1.5 sm:mr-2' }}"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span
                        class="text-xs sm:text-sm">{{ app()->getLocale() == 'ar' ? 'الميزات الرئيسية' : 'Key Features' }}</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-gray-900 mb-3 sm:mb-4">
                    {{ __('messages.features_title') }}
                </h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed px-2">
                    {{ __('messages.features_subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                <!-- Feature 1 -->
                <div
                    class="feature-card bg-white p-4 sm:p-6 lg:p-8 rounded-xl sm:rounded-2xl text-center group scroll-animate">
                    <div class="relative mb-4 sm:mb-6">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 mx-auto bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-blue-500/25 transition-all duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 lg:w-10 lg:h-10 text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div
                            class="absolute -top-1 -right-1 sm:-top-2 sm:-right-2 w-5 h-5 sm:w-6 sm:h-6 bg-yellow-400 rounded-full flex items-center justify-center">
                            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 text-yellow-800" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-base sm:text-lg lg:text-xl font-bold text-gray-900 mb-2 sm:mb-3">
                        {{ __('messages.easy_setup') }}
                    </h3>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                        {{ __('messages.easy_setup_desc') }}
                    </p>
                    <div
                        class="mt-3 sm:mt-4 flex items-center justify-center text-blue-600 font-medium text-xs sm:text-sm">
                        <span
                            class="{{ app()->getLocale() == 'ar' ? 'ml-1.5' : 'mr-1.5' }}">{{ app()->getLocale() == 'ar' ? 'أقل من 5 دقائق' : 'Less than 5 minutes' }}</span>
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div
                    class="feature-card bg-white p-4 sm:p-6 lg:p-8 rounded-xl sm:rounded-2xl text-center group scroll-animate">
                    <div class="relative mb-4 sm:mb-6">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 mx-auto bg-gradient-to-br from-green-500 to-green-600 rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-green-500/25 transition-all duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 lg:w-10 lg:h-10 text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div
                            class="absolute -top-1 -right-1 sm:-top-2 sm:-right-2 w-5 h-5 sm:w-6 sm:h-6 bg-green-400 rounded-full flex items-center justify-center">
                            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 text-green-800" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-base sm:text-lg lg:text-xl font-bold text-gray-900 mb-2 sm:mb-3">
                        {{ __('messages.wide_network') }}</h3>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed">{{ __('messages.wide_network_desc') }}
                    </p>
                    <div
                        class="mt-3 sm:mt-4 flex items-center justify-center text-green-600 font-medium text-xs sm:text-sm">
                        <span
                            class="{{ app()->getLocale() == 'ar' ? 'ml-1.5' : 'mr-1.5' }}">{{ __('messages.wide_network_members') }}</span>
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-white p-8 rounded-3xl text-center group scroll-animate">
                    <div class="relative mb-8">
                        <div
                            class="w-20 h-20 mx-auto bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-purple-500/25 transition-all duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-6 h-6 bg-purple-400 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-purple-800" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('messages.smart_analytics') }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ __('messages.smart_analytics_desc') }}</p>
                    <div class="mt-6 flex items-center justify-center text-purple-600 font-medium">
                        <span
                            class="{{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}">{{ __('messages.smart_analytics_reports') }}</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                        </svg>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card bg-white p-8 rounded-3xl text-center group scroll-animate">
                    <div class="relative mb-8">
                        <div
                            class="w-20 h-20 mx-auto bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-orange-500/25 transition-all duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-6 h-6 bg-orange-400 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-orange-800" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('messages.advanced_security') }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ __('messages.advanced_security_desc') }}</p>
                    <div class="mt-6 flex items-center justify-center text-orange-600 font-medium">
                        <span
                            class="{{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}">{{ __('messages.advanced_security_ssl') }}</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card bg-white p-8 rounded-3xl text-center group scroll-animate">
                    <div class="relative mb-8">
                        <div
                            class="w-20 h-20 mx-auto bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-pink-500/25 transition-all duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2m3 0V2a1 1 0 011-1h4a1 1 0 011 1v2m-9 4h10a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V10a2 2 0 012-2z" />
                            </svg>
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-6 h-6 bg-pink-400 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-pink-800" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('messages.smart_scheduling') }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ __('messages.smart_scheduling_desc') }}</p>
                    <div class="mt-6 flex items-center justify-center text-pink-600 font-medium">
                        <span
                            class="{{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}">{{ __('messages.smart_scheduling_reminders') }}</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card bg-white p-8 rounded-3xl text-center group scroll-animate">
                    <div class="relative mb-8">
                        <div
                            class="w-20 h-20 mx-auto bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-indigo-500/25 transition-all duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-6 h-6 bg-indigo-400 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-indigo-800" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('messages.support_247') }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ __('messages.support_247_desc') }}</p>
                    <div class="mt-6 flex items-center justify-center text-indigo-600 font-medium">
                        <span
                            class="{{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}">{{ __('messages.support_247_response') }}</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="py-12 sm:py-16 lg:py-20 hero-gradient relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="floating-element absolute top-10 right-10 w-32 h-32 bg-white rounded-full blur-3xl"></div>
            <div class="floating-element absolute bottom-10 left-10 w-24 h-24 bg-white rounded-full blur-2xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16 scroll-animate">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white mb-4 sm:mb-6">
                    {{ __('messages.stats_title') }}
                </h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-100 max-w-3xl mx-auto px-4">
                    {{ __('messages.stats_description') }}
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 lg:gap-8">
                <div class="text-center scroll-animate">
                    <div class="card-gradient rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 mb-4">
                        <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white stat-number mb-1 sm:mb-2"
                            data-target="5247">0</div>
                        <div class="text-xs sm:text-sm lg:text-base text-gray-200 font-medium">
                            {{ __('messages.active_users') }}
                        </div>
                    </div>
                </div>
                <div class="text-center scroll-animate">
                    <div class="card-gradient rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 mb-4">
                        <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white stat-number mb-1 sm:mb-2"
                            data-target="1250">0</div>
                        <div class="text-xs sm:text-sm lg:text-base text-gray-200 font-medium">
                            {{ __('messages.registered_teachers') }}
                        </div>
                    </div>
                </div>
                <div class="text-center scroll-animate">
                    <div class="card-gradient rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 mb-4">
                        <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white stat-number mb-1 sm:mb-2"
                            data-target="340">0</div>
                        <div class="text-xs sm:text-sm lg:text-base text-gray-200 font-medium">
                            {{ __('messages.educational_institutions') }}
                        </div>
                    </div>
                </div>
                <div class="text-center scroll-animate">
                    <div class="card-gradient rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 mb-4">
                        <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white stat-number mb-1 sm:mb-2"
                            data-target="98">0</div>
                        <div class="text-xs sm:text-sm lg:text-base text-gray-200 font-medium">
                            {{ __('messages.customer_satisfaction') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-12 sm:py-16 lg:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16 scroll-animate">
                <div
                    class="inline-flex items-center bg-primary-50 text-primary-600 rounded-full px-4 sm:px-6 py-2 mb-4 sm:mb-6">
                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span class="text-sm sm:text-base">{{ __('messages.testimonials_badge') }}</span>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 mb-4 sm:mb-6">
                    {{ __('messages.testimonials_title') }}
                </h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                    {{ __('messages.testimonials_subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                <!-- Testimonial 1 -->
                <div
                    class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 shadow-lg hover:shadow-xl transition-all duration-300 scroll-animate">
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        "{{ __('messages.testimonial_1_text') }}"
                    </p>
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold ml-3 sm:ml-4 text-sm sm:text-base">
                            أ
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base">
                                {{ __('messages.testimonial_1_name') }}
                            </h4>
                            <p class="text-xs sm:text-sm text-gray-500">{{ __('messages.testimonial_1_title') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div
                    class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 shadow-lg hover:shadow-xl transition-all duration-300 scroll-animate">
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        "{{ __('messages.testimonial_2_text') }}"
                    </p>
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex items-center justify-center text-white font-bold ml-4">
                            س
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ __('messages.testimonial_2_name') }}</h4>
                            <p class="text-sm text-gray-500">{{ __('messages.testimonial_2_title') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div
                    class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 scroll-animate">
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        "{{ __('messages.testimonial_3_text') }}"
                    </p>
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full flex items-center justify-center text-white font-bold ml-4">
                            ف
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ __('messages.testimonial_3_name') }}</h4>
                            <p class="text-sm text-gray-500">{{ __('messages.testimonial_3_title') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 4 -->
                <div
                    class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 scroll-animate">
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        "{{ __('messages.testimonial_4_text') }}"
                    </p>
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold ml-4">
                            م
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ __('messages.testimonial_4_name') }}</h4>
                            <p class="text-sm text-gray-500">{{ __('messages.testimonial_4_title') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 5 -->
                <div
                    class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 scroll-animate">
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        "{{ __('messages.testimonial_5_text') }}"
                    </p>
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center text-white font-bold ml-4">
                            ل
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ __('messages.testimonial_5_name') }}</h4>
                            <p class="text-sm text-gray-500">{{ __('messages.testimonial_5_title') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 6 -->
                <div
                    class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 scroll-animate">
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        "{{ __('messages.testimonial_6_text') }}"
                    </p>
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center text-white font-bold ml-4">
                            ع
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ __('messages.testimonial_6_name') }}</h4>
                            <p class="text-sm text-gray-500">{{ __('messages.testimonial_6_title') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="register" class="py-20 hero-gradient relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="floating-element absolute top-20 right-20 w-40 h-40 bg-white rounded-full blur-3xl"></div>
            <div class="floating-element absolute bottom-20 left-20 w-32 h-32 bg-white rounded-full blur-2xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="text-white scroll-animate">
                <h2 class="text-4xl md:text-5xl font-black mb-6">{{ __('messages.cta_ready_title') }}</h2>
                <p class="text-lg md:text-xl mb-12 text-gray-100 max-w-3xl mx-auto leading-relaxed">
                    {{ __('messages.cta_ready_description') }}
                </p>

                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 md:gap-6 mb-12 max-w-6xl mx-auto">
                    <div
                        class="card-gradient rounded-2xl p-6 text-center flex flex-col justify-between min-h-[200px] hover:transform hover:scale-105 transition-all duration-300">
                        <div>
                            <div class="text-xl md:text-2xl font-bold mb-2">{{ __('messages.teacher') }}</div>
                            <div class="text-gray-200 mb-4 text-sm md:text-base">{{ __('messages.teacher_fee') }}</div>
                        </div>
                        <a href="{{ route('register.teacher') }}"
                            class="bg-white text-primary-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors inline-block w-full">
                            {{ __('messages.start_now_btn') }}
                        </a>
                    </div>
                    <div
                        class="card-gradient rounded-2xl p-6 text-center flex flex-col justify-between min-h-[200px] hover:transform hover:scale-105 transition-all duration-300">
                        <div>
                            <div class="text-xl md:text-2xl font-bold mb-2">{{ __('messages.educational_center') }}
                            </div>
                            <div class="text-gray-200 mb-4 text-sm md:text-base">{{ __('messages.center_fee') }}</div>
                        </div>
                        <a href="{{ route('register.educational-center') }}"
                            class="bg-white text-primary-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors inline-block w-full">
                            {{ __('messages.start_now_btn') }}
                        </a>
                    </div>
                    <div
                        class="card-gradient rounded-2xl p-6 text-center flex flex-col justify-between min-h-[200px] hover:transform hover:scale-105 transition-all duration-300">
                        <div>
                            <div class="text-xl md:text-2xl font-bold mb-2">{{ __('messages.school') }}</div>
                            <div class="text-gray-200 mb-4 text-sm md:text-base">{{ __('messages.school_fee') }}</div>
                        </div>
                        <a href="{{ route('register.school') }}"
                            class="bg-white text-primary-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors inline-block w-full">
                            {{ __('messages.start_now_btn') }}
                        </a>
                    </div>
                    <div
                        class="card-gradient rounded-2xl p-6 text-center flex flex-col justify-between min-h-[200px] hover:transform hover:scale-105 transition-all duration-300">
                        <div>
                            <div class="text-xl md:text-2xl font-bold mb-2">{{ __('messages.kindergarten') }}</div>
                            <div class="text-gray-200 mb-4 text-sm md:text-base">{{ __('messages.kindergarten_fee') }}
                            </div>
                        </div>
                        <a href="{{ route('register.kindergarten') }}"
                            class="bg-white text-primary-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors inline-block w-full">
                            {{ __('messages.start_now_btn') }}
                        </a>
                    </div>
                    <div
                        class="card-gradient rounded-2xl p-6 text-center flex flex-col justify-between min-h-[200px] hover:transform hover:scale-105 transition-all duration-300">
                        <div>
                            <div class="text-xl md:text-2xl font-bold mb-2">{{ __('messages.nursery') }}</div>
                            <div class="text-gray-200 mb-4 text-sm md:text-base">{{ __('messages.nursery_fee') }}</div>
                        </div>
                        <a href="{{ route('register.nursery') }}"
                            class="bg-white text-primary-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors inline-block w-full">
                            {{ __('messages.start_now_btn') }}
                        </a>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('search') }}"
                        class="bg-white text-primary-600 px-8 py-4 rounded-full font-bold text-lg shadow-2xl inline-flex items-center justify-center group">
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ __('messages.search_now_btn') }}
                    </a>
                    <a href="#contact"
                        class="border-2 border-white/30 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white/10 transition-all backdrop-blur-sm inline-flex items-center justify-center">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {{ __('messages.contact_us_btn') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="section-padding bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ __('messages.faq_title') }}</h2>
                <p class="text-xl text-gray-600">{{ __('messages.faq_subtitle') }}</p>
            </div>

            <div class="space-y-8">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">{{ __('messages.faq_1_question') }}</h3>
                    <p class="text-gray-600">{{ __('messages.faq_1_answer') }}</p>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">{{ __('messages.faq_2_question') }}</h3>
                    <p class="text-gray-600">{{ __('messages.faq_2_answer') }}</p>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">{{ __('messages.faq_3_question') }}</h3>
                    <p class="text-gray-600">{{ __('messages.faq_3_answer') }}</p>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">{{ __('messages.faq_4_question') }}</h3>
                    <p class="text-gray-600">{{ __('messages.faq_4_answer') }}</p>
                </div>

                <!-- FAQ Item 5 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">{{ __('messages.faq_5_question') }}</h3>
                    <p class="text-gray-600">{{ __('messages.faq_5_answer') }}</p>
                </div>

                <!-- FAQ Item 6 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">{{ __('messages.faq_6_question') }}</h3>
                    <p class="text-gray-600">{{ __('messages.faq_6_answer') }}</p>
                </div>
            </div>

            <div class="text-center mt-12">
                <p class="text-gray-600 mb-6">{{ __('messages.faq_no_answer') }}</p>
                <a href="#contact" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold text-lg">
                    {{ __('messages.contact_sales_btn') }}
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="register" class="section-padding hero-gradient">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="text-white">
                <h2 class="text-4xl font-bold mb-8">{{ __('messages.cta_create_account') }}</h2>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="{{ route('register.teacher') }}"
                        class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-50 transition-all">
                        {{ __('messages.start_now_btn') }}
                    </a>
                    <a href="#contact"
                        class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all">
                        {{ __('messages.contact_sales_link') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="text-2xl sm:text-3xl font-bold text-gradient mb-6 sm:mb-8">طالب</div>
            <p class="text-gray-400 mb-6 sm:mb-8 max-w-2xl mx-auto text-sm sm:text-base lg:text-lg">
                {{ __('messages.footer_description') }}
            </p>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center mb-8 sm:mb-12">
                <div class="text-gray-400 text-sm sm:text-base">{{ __('messages.footer_email') }}</div>
                <div class="text-gray-400 text-sm sm:text-base">{{ __('messages.footer_phone') }}</div>
                <div class="text-gray-400 text-sm sm:text-base">{{ __('messages.footer_location') }}</div>
            </div>

            <div class="border-t border-gray-800 pt-6 sm:pt-8">
                <p class="text-gray-400 text-sm sm:text-base">{{ __('messages.all_rights_reserved') }}</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            menu.classList.toggle('hidden');

            // Animate hamburger to X
            if (menu.classList.contains('hidden')) {
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            } else {
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            }
        }

        // Close mobile menu when clicking on links
        document.addEventListener('DOMContentLoaded', function () {
            const mobileLinks = document.querySelectorAll('.mobile-nav-link');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function () {
                    const menu = document.getElementById('mobile-menu');
                    if (!menu.classList.contains('hidden')) {
                        toggleMobileMenu();
                    }
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function (event) {
                const menu = document.getElementById('mobile-menu');
                const button = document.getElementById('mobile-menu-button');

                if (!menu.contains(event.target) && !button.contains(event.target) && !menu.classList.contains('hidden')) {
                    toggleMobileMenu();
                }
            });
        });

        // Smooth Scrolling
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

        // Stats Counter Animation
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);

            function updateCounter() {
                start += increment;
                if (start < target) {
                    element.textContent = Math.floor(start);
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target;
                }
            }
            updateCounter();
        }

        // Scroll Animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');

                    // Animate counters when stats section is visible
                    if (entry.target.classList.contains('stat-number')) {
                        const target = parseInt(entry.target.getAttribute('data-target'));
                        animateCounter(entry.target, target);
                    }
                }
            });
        }, observerOptions);

        // Observe all scroll-animate elements
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.scroll-animate').forEach(el => {
                observer.observe(el);
            });

            document.querySelectorAll('.stat-number').forEach(el => {
                observer.observe(el);
            });

            // Add stagger animation to feature cards
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('backdrop-blur-xl', 'bg-white/90');
            } else {
                nav.classList.remove('backdrop-blur-xl', 'bg-white/90');
            }
        });

        // Parallax effect for floating elements
        window.addEventListener('scroll', function () {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelectorAll('.floating-element');

            parallax.forEach((element, index) => {
                const speed = 0.5 + (index * 0.1);
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Add loading animation
        window.addEventListener('load', function () {
            document.body.classList.add('loaded');
        });
    </script>

    <!-- Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
</body>

</html>