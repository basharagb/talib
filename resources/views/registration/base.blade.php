<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Talib') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Arabic Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- English Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/toast.js') }}"></script>
    
    <style>
        body {
            font-family: {{ app()->getLocale() == 'ar' ? "'Cairo', 'Noto Sans Arabic', sans-serif" : "'Inter', 'Figtree', sans-serif" }};
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        /* Hero Gradient */
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
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 50%, rgba(255,255,255,0.1) 100%);
            animation: shimmer 3s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-gradient {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.9) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Animations */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        /* Form Sections */
        .form-section {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .form-section:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -10px rgba(102, 126, 234, 0.2);
            border-color: rgba(102, 126, 234, 0.3);
        }
        
        /* Input Styles */
        .form-input {
            transition: all 0.3s ease;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            background: rgba(255, 255, 255, 0.9);
        }
        
        .form-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: rgba(255, 255, 255, 1);
        }
        
        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(102, 126, 234, 0.4);
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
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen relative">
        <!-- Floating Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="floating-element absolute top-20 right-10 w-32 h-32 bg-gradient-to-r from-purple-400/20 to-blue-400/20 rounded-full blur-xl"></div>
            <div class="floating-element absolute bottom-20 left-10 w-24 h-24 bg-gradient-to-r from-blue-400/20 to-indigo-400/20 rounded-full blur-xl"></div>
            <div class="floating-element absolute top-1/2 right-1/3 w-16 h-16 bg-gradient-to-r from-indigo-400/20 to-purple-400/20 rounded-full blur-xl"></div>
        </div>

        <!-- Navigation -->
        <nav class="glass-nav fixed top-0 w-full z-50 shadow-lg hidden md:block">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center animate-slide-up">
                        <a href="{{ route('home') }}" class="flex items-center group">
                            <div class="relative">
                                <h1 class="text-3xl font-black text-gradient">طالب</h1>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full animate-pulse"></div>
                            </div>
                            <div class="mr-4 text-sm text-gray-600 font-medium">
                                <div>{{ app()->getLocale() == 'ar' ? 'منصة التعليم الرقمي' : 'Digital Education Platform' }}</div>
                                <div class="text-xs text-purple-500">{{ app()->getLocale() == 'ar' ? 'الرائدة في المنطقة' : 'Leading in the Region' }}</div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-4 rtl:space-x-reverse animate-slide-up">
                        <!-- Language Switcher -->
                        <div class="flex items-center space-x-2 rtl:space-x-reverse bg-white/50 rounded-full p-1 backdrop-blur-sm">
                            <a href="{{ url()->current() }}?lang=ar" 
                               class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ app()->getLocale() == 'ar' ? 'bg-gradient-to-r from-purple-500 to-blue-500 text-white shadow-lg' : 'text-gray-600 hover:text-gray-900 hover:bg-white/70' }}">
                                🇸🇦 العربية
                            </a>
                            <a href="{{ url()->current() }}?lang=en" 
                               class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ app()->getLocale() == 'en' ? 'bg-gradient-to-r from-purple-500 to-blue-500 text-white shadow-lg' : 'text-gray-600 hover:text-gray-900 hover:bg-white/70' }}">
                                🇺🇸 English
                            </a>
                        </div>
                        
                        <a href="{{ route('home') }}" class="flex items-center space-x-2 rtl:space-x-reverse text-gray-600 hover:text-purple-600 transition-all duration-300 font-medium bg-white/50 px-4 py-2 rounded-full backdrop-blur-sm hover:bg-white/70">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>{{ __('Back to Home') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="pt-8 md:pt-28 pb-12 relative z-10">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Registration Header -->
                <div class="text-center mb-12 animate-slide-up">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-purple-500 to-blue-500 rounded-full mb-6 animate-float">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-4xl font-black text-gray-900 mb-4">
                        @yield('page-title')
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        @yield('page-description')
                    </p>
                    <div class="mt-6 flex items-center justify-center">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse bg-gradient-to-r from-green-100 to-blue-100 px-4 py-2 rounded-full">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">{{ app()->getLocale() == 'ar' ? 'تسجيل آمن ومضمون' : 'Safe & Secure Registration' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Registration Form Card -->
                <div class="card-gradient shadow-2xl rounded-3xl overflow-hidden animate-fade-in">
                    <div class="px-8 py-10">
                        @if ($errors->any())
                            <div class="mb-6 bg-red-50 border-l-4 border-red-400 rounded-md p-4 shadow-sm animate-shake">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 rtl:ml-0 rtl:mr-3">
                                        <h3 class="text-sm font-medium text-red-800">
                                            {{ __('Please fix the following errors:') }}
                                        </h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <ul class="list-disc pl-5 rtl:pl-0 rtl:pr-5 space-y-1">
                                                @foreach ($errors->all() as $error)
                                                    <li class="animate-fade-in">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @yield('form-content')
                    </div>
                </div>

                <!-- Registration Types Links -->
                <div class="mt-12 text-center animate-slide-up">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ __('messages.register_different_type') }}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <a href="{{ route('register.teacher') }}" class="group relative overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-500 hover:to-blue-600 rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-blue-500 group-hover:bg-white rounded-full flex items-center justify-center mb-3 transition-colors duration-300">
                                    <svg class="w-6 h-6 text-white group-hover:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="text-blue-700 group-hover:text-white font-semibold transition-colors duration-300">{{ __('messages.teacher') }}</span>
                                <span class="text-xs text-blue-600 group-hover:text-blue-100 mt-1 transition-colors duration-300">10 JD</span>
                            </div>
                        </a>
                        
                        <a href="{{ route('register.educational-center') }}" class="group relative overflow-hidden bg-gradient-to-br from-green-50 to-green-100 hover:from-green-500 hover:to-green-600 rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-green-500 group-hover:bg-white rounded-full flex items-center justify-center mb-3 transition-colors duration-300">
                                    <svg class="w-6 h-6 text-white group-hover:text-green-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <span class="text-green-700 group-hover:text-white font-semibold transition-colors duration-300">{{ __('messages.educational_center') }}</span>
                                <span class="text-xs text-green-600 group-hover:text-green-100 mt-1 transition-colors duration-300">25 JD</span>
                            </div>
                        </a>
                        
                        <a href="{{ route('register.school') }}" class="group relative overflow-hidden bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-500 hover:to-purple-600 rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-purple-500 group-hover:bg-white rounded-full flex items-center justify-center mb-3 transition-colors duration-300">
                                    <svg class="w-6 h-6 text-white group-hover:text-purple-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <span class="text-purple-700 group-hover:text-white font-semibold transition-colors duration-300">{{ __('messages.school') }}</span>
                                <span class="text-xs text-purple-600 group-hover:text-purple-100 mt-1 transition-colors duration-300">50 JD</span>
                            </div>
                        </a>
                        
                        <a href="{{ route('register.kindergarten') }}" class="group relative overflow-hidden bg-gradient-to-br from-pink-50 to-pink-100 hover:from-pink-500 hover:to-pink-600 rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-pink-500 group-hover:bg-white rounded-full flex items-center justify-center mb-3 transition-colors duration-300">
                                    <svg class="w-6 h-6 text-white group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8m-5-10v2m0 0V4m0 2h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-pink-700 group-hover:text-white font-semibold transition-colors duration-300">{{ __('messages.kindergarten') }}</span>
                                <span class="text-xs text-pink-600 group-hover:text-pink-100 mt-1 transition-colors duration-300">50 JD</span>
                            </div>
                        </a>
                        
                        <a href="{{ route('register.nursery') }}" class="group relative overflow-hidden bg-gradient-to-br from-yellow-50 to-yellow-100 hover:from-yellow-500 hover:to-yellow-600 rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-yellow-500 group-hover:bg-white rounded-full flex items-center justify-center mb-3 transition-colors duration-300">
                                    <svg class="w-6 h-6 text-white group-hover:text-yellow-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-yellow-700 group-hover:text-white font-semibold transition-colors duration-300">{{ __('messages.nursery') }}</span>
                                <span class="text-xs text-yellow-600 group-hover:text-yellow-100 mt-1 transition-colors duration-300">40 JD</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- JavaScript for dynamic functionality -->
    <script>
        // Country/City dropdown functionality
        function loadCities(countryId, citySelectId) {
            const citySelect = document.getElementById(citySelectId);
            const locale = '{{ app()->getLocale() }}';
            
            if (!countryId) {
                citySelect.innerHTML = '<option value="">{{ __("messages.Select City") }}</option>';
                return;
            }
            
            // Show loading state
            citySelect.innerHTML = '<option value="">{{ app()->getLocale() == "ar" ? "جاري التحميل..." : "Loading..." }}</option>';
            citySelect.disabled = true;
            
            // Set timeout for slow connections
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 10000);
            
            fetch(`/register/cities/${countryId}`, { signal: controller.signal })
                .then(response => {
                    clearTimeout(timeoutId);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(cities => {
                    citySelect.innerHTML = '<option value="">{{ __("messages.Select City") }}</option>';
                    if (cities && cities.length > 0) {
                        cities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = locale === 'ar' ? city.name_ar : city.name_en;
                            citySelect.appendChild(option);
                        });
                    } else {
                        citySelect.innerHTML = '<option value="">{{ app()->getLocale() == "ar" ? "لا توجد مدن" : "No cities found" }}</option>';
                    }
                    citySelect.disabled = false;
                })
                .catch(error => {
                    clearTimeout(timeoutId);
                    console.error('Error loading cities:', error);
                    citySelect.innerHTML = '<option value="">{{ app()->getLocale() == "ar" ? "خطأ في التحميل - حاول مرة أخرى" : "Error loading - try again" }}</option>';
                    citySelect.disabled = false;
                });
        }
        
        // File upload preview
        function previewImage(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        }
    </script>
    
    @yield('scripts')
    
    <!-- Toast Messages -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showSuccess('{{ session('success') }}');
            @endif
            
            @if(session('error'))
                showError('{{ session('error') }}');
            @endif
            
            @if(session('warning'))
                showWarning('{{ session('warning') }}');
            @endif
            
            @if(session('info'))
                showInfo('{{ session('info') }}');
            @endif
            
            @if($errors->any())
                @foreach($errors->all() as $error)
                    showError('{{ $error }}');
                @endforeach
            @endif
        });
    </script>
</body>
</html>
