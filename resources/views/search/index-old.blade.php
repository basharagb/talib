@extends('layouts.dashboard')

@section('title', __('Search') . ' - ' . config('app.name', 'طالب'))

@section('content-header')
@endsection

@section('page-title', __('Search'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('Search') }}</li>
@endsection

@section('styles')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .search-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .search-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('Search Educational Services') }}</h1>
            <p class="text-xl text-gray-600">{{ __('Find teachers, educational centers, schools, kindergartens, and nurseries') }}</p>
        </div>

        <!-- Search Form -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <form method="GET" action="{{ route('search') }}" class="space-y-6">
                <!-- Main Search -->
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="q" value="{{ $query }}" 
                               placeholder="{{ __('Search by name...') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ __('Search') }}
                    </button>
                </div>

                <!-- Mobile Filter Toggle -->
                <div class="md:hidden mb-4">
                    <button id="mobile-filter-toggle" 
                            class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg flex items-center justify-between hover:bg-gray-200 transition-colors">
                        <span>{{ __('Filters') }}</span>
                        <svg id="filter-icon" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Filters -->
                <div id="filters-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-7 gap-4 md:block hidden md:grid">
                    <!-- Type Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Type') }}</label>
                        <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">{{ __('All Types') }}</option>
                            <option value="teacher" {{ $type === 'teacher' ? 'selected' : '' }}>{{ __('Teachers') }}</option>
                            <option value="educational_center" {{ $type === 'educational_center' ? 'selected' : '' }}>{{ __('Educational Centers') }}</option>
                            <option value="school" {{ $type === 'school' ? 'selected' : '' }}>{{ __('Schools') }}</option>
                            <option value="kindergarten" {{ $type === 'kindergarten' ? 'selected' : '' }}>{{ __('Kindergartens') }}</option>
                            <option value="nursery" {{ $type === 'nursery' ? 'selected' : '' }}>{{ __('Nurseries') }}</option>
                        </select>
                    </div>

                    <!-- Country Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Country') }}</label>
                        <select name="country_id" id="country_filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">{{ __('All Countries') }}</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $country_id == $country->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $country->name_ar : $country->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- City Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('City') }}</label>
                        <select name="city_id" id="city_filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">{{ __('All Cities') }}</option>
                        </select>
                    </div>

                    <!-- Subject Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Subject') }}</label>
                        <select name="subject_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">{{ __('All Subjects') }}</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $subject_id == $subject->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $subject->name_ar : $subject->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Grade Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Grade') }}</label>
                        <select name="grade_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">{{ __('All Grades') }}</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}" {{ $grade_id == $grade->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $grade->name_ar : $grade->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Educational Stage Filter (for Schools) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Educational Stage') }}</label>
                        <select name="educational_stage_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">{{ __('All Stages') }}</option>
                            @if(isset($educationalStages))
                                @foreach($educationalStages as $stage)
                                    <option value="{{ $stage->id }}" {{ $educational_stage_id == $stage->id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'ar' ? $stage->name_ar : $stage->name_en }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Student Type Filter (for Schools) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Student Type') }}</label>
                        <select name="student_type_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">{{ __('All Types') }}</option>
                            @if(isset($studentTypes))
                                @foreach($studentTypes as $studentType)
                                    <option value="{{ $studentType->id }}" {{ $student_type_id == $studentType->id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'ar' ? $studentType->name_ar : $studentType->name_en }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results -->
        @if(count($results) > 0)
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    {{ __('Search Results') }} ({{ count($results) }} {{ __('results found') }})
                </h2>
            </div>

            <!-- Mobile Filter Toggle -->
            <div class="md:hidden mb-4">
                <button id="mobile-filter-toggle" 
                        class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg flex items-center justify-between hover:bg-gray-200 transition-colors">
                    <span>{{ __('Filters') }}</span>
                    <svg id="filter-icon" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Type Badge -->
                            <div class="mb-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @switch($result['type'])
                                        @case('teacher')
                                            bg-blue-100 text-blue-800
                                            @break
                                        @case('educational_center')
                                            bg-purple-100 text-purple-800
                                            @break
                                        @case('school')
                                            bg-green-100 text-green-800
                                            @break
                                        @case('kindergarten')
                                            bg-pink-100 text-pink-800
                                            @break
                                        @case('nursery')
                                            bg-yellow-100 text-yellow-800
                                            @break
                                    @endswitch
                                ">
                                    {{ __(ucfirst(str_replace('_', ' ', $result['type']))) }}
                                </span>
                            </div>

                            <!-- Name -->
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $result['name'] }}</h3>

                            <!-- Location -->
                            <p class="text-gray-600 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $result['location'] }}
                            </p>

                            <!-- Description -->
                            <p class="text-gray-700 mb-4 line-clamp-3">{{ Str::limit($result['description'], 120) }}</p>

                            <!-- Additional Info -->
                            @if(isset($result['subjects']) && $result['subjects'])
                                <p class="text-sm text-gray-600 mb-2">
                                    <strong>{{ __('Subjects') }}:</strong> {{ $result['subjects'] }}
                                </p>
                            @endif

                            @if(isset($result['grades']) && $result['grades'])
                                <p class="text-sm text-gray-600 mb-2">
                                    <strong>{{ __('Grades') }}:</strong> {{ $result['grades'] }}
                                </p>
                            @endif

                            @if(isset($result['ages']) && $result['ages'])
                                <p class="text-sm text-gray-600 mb-2">
                                    <strong>{{ __('Ages') }}:</strong> {{ $result['ages'] }}
                                </p>
                            @endif

                            @if(isset($result['degree']) && $result['degree'])
                                <p class="text-sm text-gray-600 mb-2">
                                    <strong>{{ __('Degree') }}:</strong> {{ __(ucfirst($result['degree'])) }}
                                </p>
                            @endif

                            <!-- Contact -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <a href="tel:{{ $result['phone'] }}" 
                                   class="flex items-center text-blue-600 hover:text-blue-800">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    {{ $result['phone'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif(request()->hasAny(['q', 'type', 'country_id', 'city_id', 'subject_id', 'grade_id']))
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('No results found') }}</h3>
                <p class="text-gray-600">{{ __('Try adjusting your search criteria or browse all categories') }}</p>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🎓</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('Start your search') }}</h3>
                <p class="text-gray-600">{{ __('Use the search form above to find educational services') }}</p>
            </div>
        @endif
    </div>
</div>

<script>
document.getElementById('country_filter').addEventListener('change', function() {
    const countryId = this.value;
    const citySelect = document.getElementById('city_filter');
    
    // Clear existing options
    citySelect.innerHTML = '<option value="">{{ __("All Cities") }}</option>';
    
    if (countryId) {
        fetch(`{{ route('search.cities', '') }}/${countryId}`)
            .then(response => response.json())
            .then(cities => {
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = '{{ app()->getLocale() }}' === 'ar' ? city.name_ar : city.name_en;
                    if (city.id == '{{ $city_id }}') {
                        option.selected = true;
                    }
                    citySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
});

// Load cities on page load if country is selected
if (document.getElementById('country_filter').value) {
    document.getElementById('country_filter').dispatchEvent(new Event('change'));
}

// Mobile filter toggle
document.getElementById('mobile-filter-toggle').addEventListener('click', function() {
    const filtersContainer = document.getElementById('filters-container');
    const filterIcon = document.getElementById('filter-icon');
    
    if (filtersContainer.classList.contains('hidden')) {
        filtersContainer.classList.remove('hidden');
        filtersContainer.classList.add('block');
        filterIcon.style.transform = 'rotate(180deg)';
    } else {
        filtersContainer.classList.add('hidden');
        filtersContainer.classList.remove('block');
        filterIcon.style.transform = 'rotate(0deg)';
    }
});
</script>
@endsection
