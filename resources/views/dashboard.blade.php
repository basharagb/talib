<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ __('messages.welcome_back') }}, {{ Auth::user()->name }}!
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                {{ __('messages.dashboard_subtitle') }}
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Students -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">{{ __('messages.total_students') }}</p>
                            <p class="text-3xl font-bold">5,247</p>
                            <p class="text-blue-100 text-sm">{{ __('messages.new_students') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Teachers -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">{{ __('messages.active_teachers') }}</p>
                            <p class="text-3xl font-bold">1,250</p>
                            <p class="text-green-100 text-sm">{{ __('messages.registered_teachers') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Educational Centers -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">{{ __('messages.educational_centers') }}</p>
                            <p class="text-3xl font-bold">340</p>
                            <p class="text-purple-100 text-sm">{{ __('messages.institutions') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 6a2 2 0 104 0 2 2 0 00-4 0zm6 0a2 2 0 104 0 2 2 0 00-4 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Satisfaction Rate -->
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-medium">{{ __('messages.satisfaction_rate') }}</p>
                            <p class="text-3xl font-bold">98%</p>
                            <p class="text-orange-100 text-sm">{{ __('messages.customer_satisfaction') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activity -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('messages.recent_activity') }}</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.new_student_enrolled') }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('messages.activity_time_1') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.assignment_completed') }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('messages.activity_time_2') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.new_teacher_registered') }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('messages.activity_time_3') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('messages.quick_actions') }}</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <a href="{{ route('search') }}" class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg p-4 hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-medium">{{ __('messages.search_platform') }}</span>
                                </div>
                            </a>

                            <a href="{{ route('register.teacher') }}" class="block w-full bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg p-4 hover:from-green-600 hover:to-green-700 transition-all duration-200 transform hover:scale-105">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                                    </svg>
                                    <span class="font-medium">{{ __('messages.register_as_teacher') }}</span>
                                </div>
                            </a>

                            <a href="{{ route('register.educational_center') }}" class="block w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg p-4 hover:from-purple-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 6a2 2 0 104 0 2 2 0 00-4 0zm6 0a2 2 0 104 0 2 2 0 00-4 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-medium">{{ __('messages.register_center') }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Schedule -->
            <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('messages.todays_schedule') }}</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800 rounded-lg p-4 border border-blue-200 dark:border-blue-700">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-blue-800 dark:text-blue-200">09:00 AM</span>
                                <span class="px-2 py-1 text-xs bg-blue-200 dark:bg-blue-700 text-blue-800 dark:text-blue-200 rounded-full">{{ __('messages.active') }}</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ __('messages.mathematics_grade_10') }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.with_teacher') }} أحمد محمد</p>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 rounded-lg p-4 border border-green-200 dark:border-green-700">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-green-800 dark:text-green-200">11:00 AM</span>
                                <span class="px-2 py-1 text-xs bg-green-200 dark:bg-green-700 text-green-800 dark:text-green-200 rounded-full">{{ __('messages.upcoming') }}</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ __('messages.english_grade_9') }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.with_teacher') }} سارة أحمد</p>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900 dark:to-purple-800 rounded-lg p-4 border border-purple-200 dark:border-purple-700">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-purple-800 dark:text-purple-200">02:00 PM</span>
                                <span class="px-2 py-1 text-xs bg-purple-200 dark:bg-purple-700 text-purple-800 dark:text-purple-200 rounded-full">{{ __('messages.scheduled') }}</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ __('messages.science_grade_8') }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.with_teacher') }} محمد علي</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Overview -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('messages.performance_overview') }}</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('messages.student_engagement') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">85%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                        
                        <div class="space-y-4 mt-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('messages.course_completion') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">92%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('messages.monthly_revenue') }}</h3>
                    </div>
                    <div class="p-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gray-900 dark:text-white mb-2">12,450 {{ __('messages.jd') }}</div>
                            <div class="text-sm text-green-600 dark:text-green-400 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                +15% {{ __('messages.from_last_month') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>