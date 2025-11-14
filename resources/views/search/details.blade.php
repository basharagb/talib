@extends('layouts.public')

@section('title', __('messages.view_details') . ' - ' . config('app.name', 'طالب'))

@section('styles')
<style>
    .detail-card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 1rem;
        overflow: hidden;
    }
    
    .profile-image {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 1rem;
    }
    
    .contact-info {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.5rem;
    }
    
    .badge-large {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
    }
    
    .social-links a {
        display: inline-block;
        margin: 0.25rem;
        padding: 0.5rem;
        background: #667eea;
        color: white;
        border-radius: 50%;
        text-decoration: none;
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 30px;
    }
    
    .social-links a:hover {
        background: #764ba2;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<div class="main-content">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('search') }}">{{ __('messages.search') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('messages.view_details') }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="detail-card">
        <div class="card-body p-4">
            <div class="row">
                <!-- Profile Image -->
                <div class="col-md-3 text-center mb-4">
                    @if(isset($details['image']) && $details['image'])
                        <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="profile-image">
                    @else
                        <div class="profile-image bg-gradient d-flex align-items-center justify-content-center mx-auto" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            @switch($details['type'])
                                @case('teacher')
                                    <i class="bi bi-person-circle text-white" style="font-size: 4rem;"></i>
                                    @break
                                @case('educational_center')
                                    <i class="bi bi-building text-white" style="font-size: 4rem;"></i>
                                    @break
                                @case('school')
                                    <i class="bi bi-mortarboard text-white" style="font-size: 4rem;"></i>
                                    @break
                                @case('kindergarten')
                                    <i class="bi bi-star text-white" style="font-size: 4rem;"></i>
                                    @break
                                @case('nursery')
                                    <i class="bi bi-heart text-white" style="font-size: 4rem;"></i>
                                    @break
                            @endswitch
                        </div>
                    @endif
                    
                    <!-- Type Badge -->
                    <div class="mt-3">
                        @switch($details['type'])
                            @case('teacher')
                                <span class="badge bg-primary badge-large">{{ __('messages.teacher') }}</span>
                                @break
                            @case('educational_center')
                                <span class="badge bg-success badge-large">{{ __('messages.educational_center') }}</span>
                                @break
                            @case('school')
                                <span class="badge bg-warning badge-large">{{ __('messages.school') }}</span>
                                @break
                            @case('kindergarten')
                                <span class="badge bg-info badge-large">{{ __('messages.kindergarten') }}</span>
                                @break
                            @case('nursery')
                                <span class="badge bg-secondary badge-large">{{ __('messages.nursery') }}</span>
                                @break
                        @endswitch
                    </div>
                </div>
                
                <!-- Main Information -->
                <div class="col-md-6">
                    <h1 class="h2 text-primary mb-3">{{ $details['name'] }}</h1>
                    
                    @if(isset($details['description']) && $details['description'])
                        <div class="mb-4">
                            <h5>{{ __('messages.description') }}</h5>
                            <p class="text-muted">{{ $details['description'] }}</p>
                        </div>
                    @endif
                    
                    <!-- Location -->
                    @if(isset($details['location']) && $details['location'])
                        <div class="mb-3">
                            <h6><i class="bi bi-geo-alt text-primary me-2"></i>{{ __('messages.location') }}</h6>
                            <p class="mb-0">{{ $details['location'] }}</p>
                        </div>
                    @endif
                    
                    <!-- Teacher specific info -->
                    @if($details['type'] === 'teacher')
                        @if(isset($details['degree']) && $details['degree'])
                            <div class="mb-3">
                                <h6><i class="bi bi-mortarboard text-primary me-2"></i>{{ __('messages.academic_degree') }}</h6>
                                <p class="mb-0">{{ $details['degree'] }}</p>
                            </div>
                        @endif
                        
                        @if(isset($details['experience']) && $details['experience'])
                            <div class="mb-3">
                                <h6><i class="bi bi-briefcase text-primary me-2"></i>{{ __('messages.experience') }}</h6>
                                <p class="mb-0">{{ $details['experience'] }} {{ __('messages.years') }}</p>
                            </div>
                        @endif
                        
                        @if(isset($details['subjects']) && $details['subjects'])
                            <div class="mb-3">
                                <h6><i class="bi bi-book text-primary me-2"></i>{{ __('messages.subjects') }}</h6>
                                <p class="mb-0">{{ $details['subjects'] }}</p>
                            </div>
                        @endif
                    @endif
                    
                    <!-- School specific info -->
                    @if($details['type'] === 'school')
                        @if(isset($details['grades']) && $details['grades'])
                            <div class="mb-3">
                                <h6><i class="bi bi-list-ol text-primary me-2"></i>{{ __('messages.grades') }}</h6>
                                <p class="mb-0">{{ $details['grades'] }}</p>
                            </div>
                        @endif
                        
                        @if(isset($details['educational_stages']) && $details['educational_stages'])
                            <div class="mb-3">
                                <h6><i class="bi bi-diagram-3 text-primary me-2"></i>{{ __('messages.educational_stages') }}</h6>
                                <p class="mb-0">{{ $details['educational_stages'] }}</p>
                            </div>
                        @endif
                        
                        @if(isset($details['student_types']) && $details['student_types'])
                            <div class="mb-3">
                                <h6><i class="bi bi-people text-primary me-2"></i>{{ __('messages.student_types') }}</h6>
                                <p class="mb-0">{{ $details['student_types'] }}</p>
                            </div>
                        @endif
                    @endif
                    
                    <!-- Educational Center specific info -->
                    @if($details['type'] === 'educational_center')
                        @if(isset($details['subjects']) && $details['subjects'])
                            <div class="mb-3">
                                <h6><i class="bi bi-book text-primary me-2"></i>{{ __('messages.subjects') }}</h6>
                                <p class="mb-0">{{ $details['subjects'] }}</p>
                            </div>
                        @endif
                    @endif
                    
                    <!-- Kindergarten specific info -->
                    @if($details['type'] === 'kindergarten')
                        @if(isset($details['grades']) && $details['grades'])
                            <div class="mb-3">
                                <h6><i class="bi bi-list-ol text-primary me-2"></i>{{ __('messages.grades') }}</h6>
                                <p class="mb-0">{{ $details['grades'] }}</p>
                            </div>
                        @endif
                    @endif
                    
                    <!-- Nursery specific info -->
                    @if($details['type'] === 'nursery')
                        @if(isset($details['ages']) && $details['ages'])
                            <div class="mb-3">
                                <h6><i class="bi bi-calendar text-primary me-2"></i>{{ __('messages.accepted_ages') }}</h6>
                                <p class="mb-0">{{ $details['ages'] }}</p>
                            </div>
                        @endif
                    @endif
                </div>
                
                <!-- Contact Information -->
                <div class="col-md-3">
                    <div class="contact-info">
                        <h5 class="mb-3">{{ __('messages.contact_information') }}</h5>
                        
                        @if(isset($details['phone']) && $details['phone'])
                            <div class="mb-3">
                                <h6><i class="bi bi-telephone text-primary me-2"></i>{{ __('messages.phone') }}</h6>
                                <p class="mb-0">
                                    <a href="tel:{{ $details['phone'] }}" class="text-decoration-none">{{ $details['phone'] }}</a>
                                </p>
                            </div>
                        @endif
                        
                        @if(isset($details['email']) && $details['email'])
                            <div class="mb-3">
                                <h6><i class="bi bi-envelope text-primary me-2"></i>{{ __('messages.email') }}</h6>
                                <p class="mb-0">
                                    <a href="mailto:{{ $details['email'] }}" class="text-decoration-none">{{ $details['email'] }}</a>
                                </p>
                            </div>
                        @endif
                        
                        <!-- Social Media Links -->
                        @if(isset($details['social_links']) && is_array($details['social_links']) && count($details['social_links']) > 0)
                            <div class="mb-3">
                                <h6>{{ __('messages.social_media') }}</h6>
                                <div class="social-links">
                                    @foreach($details['social_links'] as $platform => $link)
                                        @if($link)
                                            <a href="{{ $link }}" target="_blank" title="{{ ucfirst($platform) }}">
                                                @switch($platform)
                                                    @case('facebook')
                                                        <i class="bi bi-facebook"></i>
                                                        @break
                                                    @case('twitter')
                                                        <i class="bi bi-twitter"></i>
                                                        @break
                                                    @case('instagram')
                                                        <i class="bi bi-instagram"></i>
                                                        @break
                                                    @case('linkedin')
                                                        <i class="bi bi-linkedin"></i>
                                                        @break
                                                    @case('whatsapp')
                                                        <i class="bi bi-whatsapp"></i>
                                                        @break
                                                    @default
                                                        <i class="bi bi-link"></i>
                                                @endswitch
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <!-- Contact Button -->
                        <div class="d-grid">
                            <button class="btn btn-primary">
                                <i class="bi bi-chat-dots me-2"></i>{{ __('messages.contact_now') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('search') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i>{{ __('messages.back_to_search') }}
            </a>
        </div>
    </div>
</div>
@endsection
