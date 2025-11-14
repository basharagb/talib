@extends('layouts.public')

@section('title', __('messages.search') . ' - ' . config('app.name', 'طالب'))

@section('styles')
<style>
    .search-card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .search-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .type-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 1rem;
    }
    
    .search-form {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .filter-section {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<div class="main-content">
    <!-- Search Header -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="h2 text-primary mb-3">{{ __('messages.search_educational_services') }}</h1>
            <p class="text-muted">{{ __('messages.find_teachers_centers_schools') }}</p>
        </div>
    </div>

    <!-- Search Form -->
    <div class="search-form">
        <form method="GET" action="{{ route('search') }}">
            <!-- Main Search -->
            <div class="row mb-3">
                <div class="col-md-8">
                    <label for="search-input" class="form-label">{{ __('messages.search_by_name') }}</label>
                    <input type="text" name="q" id="search-input" value="{{ $query }}" 
                           placeholder="{{ __('messages.search_by_name') }}..."
                           class="form-control form-control-lg">
                </div>
                <div class="col-md-4">
                    <label for="type-select" class="form-label">{{ __('messages.type') }}</label>
                    <select name="type" id="type-select" class="form-select form-select-lg">
                        <option value="">{{ __('messages.all_types') }}</option>
                        <option value="teacher" {{ $type == 'teacher' ? 'selected' : '' }}>{{ __("messages.teacher") }}</option>
                        <option value="educational_center" {{ $type == 'educational_center' ? 'selected' : '' }}>{{ __("messages.educational_center") }}</option>
                        <option value="school" {{ $type == 'school' ? 'selected' : '' }}>{{ __("messages.school") }}</option>
                        <option value="kindergarten" {{ $type == 'kindergarten' ? 'selected' : '' }}>{{ __("messages.kindergarten") }}</option>
                        <option value="nursery" {{ $type == 'nursery' ? 'selected' : '' }}>{{ __("messages.nursery") }}</option>
                    </select>
                </div>
            </div>

            <!-- Advanced Filters -->
            <div class="filter-section">
                <h6 class="mb-3">{{ __("messages.advanced_filters") }}</h6>
                <div class="row">
                    <div class="col-md-3">
                        <label for="country-select" class="form-label">{{ __("messages.country") }}</label>
                        <select name="country_id" id="country-select" class="form-select">
                            <option value="">{{ __("messages.all_countries") }}</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $country_id == $country->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $country->name_ar : $country->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="subject-select" class="form-label">{{ __('messages.subject') }}</label>
                        <select name="subject_id" id="subject-select" class="form-select">
                            <option value="">{{ __('messages.all_subjects') }}</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $subject_id == $subject->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $subject->name_ar : $subject->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="grade-select" class="form-label">{{ __('messages.grade') }}</label>
                        <select name="grade_id" id="grade-select" class="form-select">
                            <option value="">{{ __('messages.all_grades') }}</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}" {{ $grade_id == $grade->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $grade->name_ar : $grade->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="educational-stage-select" class="form-label">{{ __('messages.educational_stage') }}</label>
                        <select name="educational_stage_id" id="educational-stage-select" class="form-select">
                            <option value="">{{ __('messages.all_stages') }}</option>
                            @foreach($educationalStages as $stage)
                                <option value="{{ $stage->id }}" {{ $educational_stage_id == $stage->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $stage->name_ar : $stage->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="student-type-select" class="form-label">{{ __('messages.student_type') }}</label>
                        <select name="student_type_id" id="student-type-select" class="form-select">
                            <option value="">{{ __('messages.all_types') }}</option>
                            @foreach($studentTypes as $type)
                                <option value="{{ $type->id }}" {{ $student_type_id == $type->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'ar' ? $type->name_ar : $type->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-2"></i>{{ __('messages.search') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Results -->
    @if(count($results) > 0)
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="h4 text-success">
                    {{ __("messages.search_results") }} ({{ count($results) }} {{ __("messages.results_found") }})
                </h3>
            </div>
        </div>

        <div class="row" id="results-grid">
            @foreach($results as $index => $result)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card search-card h-100">
                        <!-- Image -->
                        <div class="card-img-top bg-gradient text-white d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            @if(isset($result['image']) && $result['image'])
                                <img src="{{ asset('storage/' . $result['image']) }}" alt="{{ $result['name'] }}"
                                     class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                            @else
                                <div class="text-center">
                                    @switch($result['type'])
                                        @case('teacher')
                                            <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                                            @break
                                        @case('educational_center')
                                            <i class="bi bi-building" style="font-size: 4rem;"></i>
                                            @break
                                        @case('school')
                                            <i class="bi bi-mortarboard" style="font-size: 4rem;"></i>
                                            @break
                                        @case('kindergarten')
                                            <i class="bi bi-star" style="font-size: 4rem;"></i>
                                            @break
                                        @case('nursery')
                                            <i class="bi bi-heart" style="font-size: 4rem;"></i>
                                            @break
                                    @endswitch
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="card-body">
                            <!-- Type Badge -->
                            <div class="mb-2">
                                @switch($result['type'])
                                    @case('teacher')
                                        <span class="badge bg-primary type-badge">{{ __("messages.teacher") }}</span>
                                        @break
                                    @case('educational_center')
                                        <span class="badge bg-success type-badge">{{ __("messages.educational_center") }}</span>
                                        @break
                                    @case('school')
                                        <span class="badge bg-warning type-badge">{{ __("messages.school") }}</span>
                                        @break
                                    @case('kindergarten')
                                        <span class="badge bg-info type-badge">{{ __("messages.kindergarten") }}</span>
                                        @break
                                    @case('nursery')
                                        <span class="badge bg-secondary type-badge">{{ __("messages.nursery") }}</span>
                                        @break
                                @endswitch
                            </div>

                            <!-- Name -->
                            <h5 class="card-title">{{ $result['name'] }}</h5>

                            <!-- Description -->
                            @if(isset($result['description']) && $result['description'])
                                <p class="card-text text-muted">
                                    {{ Str::limit($result['description'], 100) }}
                                </p>
                            @endif

                            <!-- Location -->
                            @if(isset($result['location']) && $result['location'])
                                <div class="d-flex align-items-center text-muted mb-2">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    <small>{{ $result['location'] }}</small>
                                </div>
                            @endif

                            <!-- Contact Info -->
                            @if(isset($result['phone']) && $result['phone'])
                                <div class="d-flex align-items-center text-muted mb-2">
                                    <i class="bi bi-telephone me-2"></i>
                                    <small>{{ $result['phone'] }}</small>
                                </div>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('search.show', [$result['type'], $result['id']]) }}" class="btn btn-outline-primary btn-sm w-100">
                                <i class="bi bi-eye me-2"></i>{{ __('messages.view_details') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($results->hasPages())
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $results->links() }}
                </div>
            </div>
        @endif
    @else
        <!-- No Results -->
        <div class="row">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-body py-5">
                        <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">{{ __("messages.no_results_found") }}</h4>
                        <p class="text-muted">{{ __("messages.try_adjusting_search") }}</p>
                        <a href="{{ route('search') }}" class="btn btn-primary">
                            {{ __("messages.browse_all") }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Auto-submit form when filters change
    document.addEventListener('DOMContentLoaded', function() {
        const selects = document.querySelectorAll('#type-select, #country-select, #subject-select, #grade-select, #educational-stage-select, #student-type-select');
        selects.forEach(select => {
            select.addEventListener('change', function() {
                // Optional: Auto-submit on filter change
                // this.form.submit();
            });
        });
    });
</script>
@endsection
