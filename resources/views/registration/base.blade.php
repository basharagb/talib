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
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: {{ app()->getLocale() == 'ar' ? "'Noto Sans Arabic', sans-serif" : "'Figtree', sans-serif" }};
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <h1 class="text-2xl font-bold text-blue-600">{{ __('Talib') }}</h1>
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        <!-- Language Switcher -->
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <a href="{{ url()->current() }}?lang=ar" 
                               class="px-3 py-1 rounded {{ app()->getLocale() == 'ar' ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900' }}">
                                العربية
                            </a>
                            <a href="{{ url()->current() }}?lang=en" 
                               class="px-3 py-1 rounded {{ app()->getLocale() == 'en' ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900' }}">
                                English
                            </a>
                        </div>
                        
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">
                            {{ __('Back to Home') }}
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Registration Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">
                        @yield('page-title')
                    </h2>
                    <p class="text-gray-600">
                        @yield('page-description')
                    </p>
                </div>

                <!-- Registration Form Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="px-6 py-8">
                        @if ($errors->any())
                            <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 rtl:ml-0 rtl:mr-3">
                                        <h3 class="text-sm font-medium text-red-800">
                                            {{ __('There were some errors with your submission') }}
                                        </h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <ul class="list-disc pl-5 rtl:pl-0 rtl:pr-5 space-y-1">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
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
                <div class="mt-8 text-center">
                    <p class="text-gray-600 mb-4">{{ __('Register as a different type:') }}</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('register.teacher') }}" class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors">
                            {{ __('Teacher') }}
                        </a>
                        <a href="{{ route('register.educational-center') }}" class="px-4 py-2 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition-colors">
                            {{ __('Educational Center') }}
                        </a>
                        <a href="{{ route('register.school') }}" class="px-4 py-2 bg-purple-100 text-purple-700 rounded-md hover:bg-purple-200 transition-colors">
                            {{ __('School') }}
                        </a>
                        <a href="{{ route('register.kindergarten') }}" class="px-4 py-2 bg-pink-100 text-pink-700 rounded-md hover:bg-pink-200 transition-colors">
                            {{ __('Kindergarten') }}
                        </a>
                        <a href="{{ route('register.nursery') }}" class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200 transition-colors">
                            {{ __('Nursery') }}
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
            
            if (!countryId) {
                citySelect.innerHTML = '<option value="">{{ __("Select City") }}</option>';
                return;
            }
            
            fetch(`/register/cities/${countryId}`)
                .then(response => response.json())
                .then(cities => {
                    citySelect.innerHTML = '<option value="">{{ __("Select City") }}</option>';
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name_{{ app()->getLocale() }};
                        citySelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error loading cities:', error);
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
</body>
</html>
