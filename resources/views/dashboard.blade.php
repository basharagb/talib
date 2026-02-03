@extends('layouts.dashboard')

@section('title', __('messages.dashboard') . ' - ' . config('app.name', 'طالب'))

@section('content-header')
@endsection

@section('page-title', __('messages.dashboard'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('messages.dashboard') }}</li>
@endsection

@section('content')
    <!-- Statistics Row -->
    <!-- First Row - Main Categories -->
    <div class="row g-3 g-md-4">
        <!-- Teachers -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-primary" style="min-height: 180px;">
                <div class="inner" style="padding: 1.5rem;">
                    @php
                        $teacherCount = \App\Models\User::where('role', 'teacher')->where('status', 'active')->count();
                    @endphp
                    <h3 class="display-4 fw-bold mb-2">{{ $teacherCount }}</h3>
                    <p class="fs-5 mb-1">{{ __('messages.teachers') }}</p>
                    <small class="opacity-75 fs-6">{{ __('messages.teacher_fee') }}</small>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" style="font-size: 4rem; opacity: 0.3;">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <a href="{{ route('register.teacher') }}" class="small-box-footer"
                    style="padding: 0.75rem; font-size: 1rem;">
                    {{ __('messages.register_now') }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Educational Centers -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-success" style="min-height: 180px;">
                <div class="inner" style="padding: 1.5rem;">
                    @php
                        $centerCount = \App\Models\User::where('role', 'educational_center')->where('status', 'active')->count();
                    @endphp
                    <h3 class="display-4 fw-bold mb-2">{{ $centerCount }}</h3>
                    <p class="fs-5 mb-1">{{ __('messages.educational_centers') }}</p>
                    <small class="opacity-75 fs-6">{{ __('messages.center_fee') }}</small>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" style="font-size: 4rem; opacity: 0.3;">
                    <path
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                <a href="{{ route('register.educational-center') }}" class="small-box-footer"
                    style="padding: 0.75rem; font-size: 1rem;">
                    {{ __('messages.register_now') }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Private Schools -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-warning" style="min-height: 180px;">
                <div class="inner" style="padding: 1.5rem;">
                    @php
                        $schoolCount = \App\Models\User::where('role', 'school')->where('status', 'active')->count();
                    @endphp
                    <h3 class="display-4 fw-bold mb-2">{{ $schoolCount }}</h3>
                    <p class="fs-5 mb-1">{{ __('messages.private_schools') }}</p>
                    <small class="opacity-75 fs-6">{{ __('messages.school_fee') }}</small>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" style="font-size: 4rem; opacity: 0.3;">
                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                    </path>
                </svg>
                <a href="{{ route('register.school') }}" class="small-box-footer"
                    style="padding: 0.75rem; font-size: 1rem;">
                    {{ __('messages.register_now') }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-info" style="min-height: 180px;">
                <div class="inner" style="padding: 1.5rem;">
                    @php
                        $totalRevenue = ($teacherCount * 10) + ($centerCount * 25) + ($schoolCount * 50) +
                            (\App\Models\User::where('role', 'kindergarten')->where('status', 'active')->count() * 50) +
                            (\App\Models\User::where('role', 'nursery')->where('status', 'active')->count() * 40);
                    @endphp
                    <h3 class="display-5 fw-bold mb-2">{{ number_format($totalRevenue) }}</h3>
                    <p class="fs-5 mb-1">{{ __('messages.total_revenue') }}</p>
                    <small class="opacity-75 fs-6">{{ __('messages.annually') }}</small>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" style="font-size: 4rem; opacity: 0.3;">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                    </path>
                </svg>
                <a href="#" class="small-box-footer" style="padding: 0.75rem; font-size: 1rem;">
                    {{ __('messages.view_details') }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Second Row - Additional Categories -->
    <div class="row g-3 g-md-4 mt-2">
        <!-- Kindergartens -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-secondary" style="min-height: 180px;">
                <div class="inner" style="padding: 1.5rem;">
                    @php
                        $kindergartenCount = \App\Models\User::where('role', 'kindergarten')->where('status', 'active')->count();
                    @endphp
                    <h3 class="display-4 fw-bold mb-2">{{ $kindergartenCount }}</h3>
                    <p class="fs-5 mb-1">{{ __('messages.kindergartens') }}</p>
                    <small class="opacity-75 fs-6">{{ __('messages.kindergarten_fee') }}</small>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" style="font-size: 4rem; opacity: 0.3;">
                    <path
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                    </path>
                </svg>
                <a href="{{ route('register.kindergarten') }}" class="small-box-footer"
                    style="padding: 0.75rem; font-size: 1rem;">
                    {{ __('messages.register_now') }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Nurseries -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-dark" style="min-height: 180px;">
                <div class="inner" style="padding: 1.5rem;">
                    @php
                        $nurseryCount = \App\Models\User::where('role', 'nursery')->where('status', 'active')->count();
                    @endphp
                    <h3 class="display-4 fw-bold mb-2">{{ $nurseryCount }}</h3>
                    <p class="fs-5 mb-1">{{ __('messages.nurseries') }}</p>
                    <small class="opacity-75 fs-6">{{ __('messages.nursery_fee') }}</small>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" style="font-size: 4rem; opacity: 0.3;">
                    <path
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                    </path>
                </svg>
                <a href="{{ route('register.nursery') }}" class="small-box-footer"
                    style="padding: 0.75rem; font-size: 1rem;">
                    {{ __('messages.register_now') }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Students & Parents (Free) -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-light text-dark" style="min-height: 180px;">
                <div class="inner" style="padding: 1.5rem;">
                    @php
                        $studentCount = \App\Models\User::where('role', 'student')->count();
                    @endphp
                    <h3 class="display-4 fw-bold mb-2">{{ $studentCount }}</h3>
                    <p class="fs-5 mb-1">{{ __('messages.students_parents') }}</p>
                    <small class="opacity-75 fs-6">{{ __('messages.free') }}</small>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" style="font-size: 4rem; opacity: 0.3;">
                    <path
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                    </path>
                </svg>
                <a href="{{ route('search') }}" class="small-box-footer" style="padding: 0.75rem; font-size: 1rem;">
                    {{ __('messages.search_now') }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Pending Registrations -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-danger" style="min-height: 180px;">
                <div class="inner" style="padding: 1.5rem;">
                    @php
                        $pendingCount = \App\Models\User::where('status', 'pending')->count();
                    @endphp
                    <h3 class="display-4 fw-bold mb-2">{{ $pendingCount }}</h3>
                    <p class="fs-5 mb-1">{{ __('messages.pending_registrations') }}</p>
                    <small class="opacity-75 fs-6">{{ __('messages.needs_review') }}</small>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" style="font-size: 4rem; opacity: 0.3;">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <a href="{{ route('admin.registrations.index') }}" class="small-box-footer"
                    style="padding: 0.75rem; font-size: 1rem;">
                    {{ __('messages.review_now') }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row g-3 g-md-4 mt-3">
        <!-- Recent Activity -->
        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.recent_activity') }}</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3 p-3 bg-light rounded">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-center"
                                style="width: 40px; height: 40px;">
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
                            <div class="bg-success rounded-circle d-flex align-items-center justify-center"
                                style="width: 40px; height: 40px;">
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
                            <div class="bg-warning rounded-circle d-flex align-items-center justify-center"
                                style="width: 40px; height: 40px;">
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

        <!-- Quick Actions -->
        <div class="col-lg-4 col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.quick_actions') }}</h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('search') }}" class="btn btn-primary btn-lg py-3">
                            <i class="bi bi-search me-2"></i>{{ __('messages.search_platform') }}
                        </a>
                        <a href="{{ route('admin.registrations.index') }}" class="btn btn-danger btn-lg py-3">
                            <i class="bi bi-clipboard-check me-2"></i>{{ __('messages.registration_review') }}
                            @php
                                $quickPendingCount = \App\Models\User::where('status', 'pending')->count();
                            @endphp
                            @if($quickPendingCount > 0)
                                <span class="badge bg-white text-danger ms-2">{{ $quickPendingCount }}</span>
                            @endif
                        </a>

                        <hr class="my-3">
                        <small
                            class="text-muted text-center d-block fs-6 mb-2">{{ __('messages.registration_options') }}</small>

                        <a href="{{ route('register.teacher') }}" class="btn btn-outline-primary py-2">
                            <i class="bi bi-person me-2"></i>{{ __('messages.teacher') }} (10 {{ __('messages.jd') }})
                        </a>
                        <a href="{{ route('register.educational-center') }}" class="btn btn-outline-success py-2">
                            <i class="bi bi-building me-2"></i>{{ __('messages.educational_center') }} (25
                            {{ __('messages.jd') }})
                        </a>
                        <a href="{{ route('register.school') }}" class="btn btn-outline-warning py-2">
                            <i class="bi bi-mortarboard me-2"></i>{{ __('messages.school') }} (50 {{ __('messages.jd') }})
                        </a>
                        <a href="{{ route('register.kindergarten') }}" class="btn btn-outline-info py-2">
                            <i class="bi bi-star me-2"></i>{{ __('messages.kindergarten') }} (50 {{ __('messages.jd') }})
                        </a>
                        <a href="{{ route('register.nursery') }}" class="btn btn-outline-secondary py-2">
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
@endsection