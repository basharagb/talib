<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('messages.welcome') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-blue-600">طالب - Talib</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('search') }}" class="text-gray-600 hover:text-blue-600">{{ __('Search') }}</a>
                    <a href="?lang=ar" class="text-gray-600 hover:text-blue-600">العربية</a>
                    <a href="?lang=en" class="text-gray-600 hover:text-blue-600">English</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-blue-600">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">{{ __('messages.login') }}</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">{{ __('messages.register') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-12 px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.welcome') }}</h2>
            <p class="text-xl text-gray-600 mb-8">{{ __('messages.description') }}</p>
            
            <div class="max-w-md mx-auto">
                <form method="GET" action="{{ route('search') }}" class="flex">
                    <input type="text" name="q" placeholder="{{ __('messages.search_placeholder') }}" 
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-r-md hover:bg-blue-700">
                        {{ __('Search') }}
                    </button>
                </form>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold mb-2">{{ __('messages.teacher') }}</h3>
                <p class="text-gray-600 mb-4">{{ __('messages.teacher_fee') }}</p>
                <a href="{{ route('register') }}?role=teacher" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    {{ __('messages.register') }}
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold mb-2">{{ __('messages.educational_center') }}</h3>
                <p class="text-gray-600 mb-4">{{ __('messages.center_fee') }}</p>
                <a href="{{ route('register') }}?role=educational_center" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    {{ __('messages.register') }}
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold mb-2">{{ __('messages.school') }}</h3>
                <p class="text-gray-600 mb-4">{{ __('messages.school_fee') }}</p>
                <a href="{{ route('register') }}?role=school" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    {{ __('messages.register') }}
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold mb-2">{{ __('messages.kindergarten') }}</h3>
                <p class="text-gray-600 mb-4">{{ __('messages.kindergarten_fee') }}</p>
                <a href="{{ route('register') }}?role=kindergarten" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    {{ __('messages.register') }}
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold mb-2">{{ __('messages.nursery') }}</h3>
                <p class="text-gray-600 mb-4">{{ __('messages.nursery_fee') }}</p>
                <a href="{{ route('register') }}?role=nursery" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    {{ __('messages.register') }}
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold mb-2">{{ __('messages.student') }}</h3>
                <p class="text-gray-600 mb-4">{{ __('messages.student_free') }}</p>
                <a href="{{ route('register') }}?role=student" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    {{ __('messages.register') }}
                </a>
            </div>
        </div>
    </main>
</body>
</html>
