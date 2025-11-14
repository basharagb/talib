@extends('layouts.dashboard')

@section('title', __('messages.registration_details') . ' - ' . config('app.name', 'طالب'))

@section('content-header')
@endsection

@section('page-title', __('messages.registration_details'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.registrations.index') }}">{{ __('messages.registration_review') }}</a></li>
    <li class="breadcrumb-item active">{{ __('messages.registration_details') }}</li>
@endsection

@section('styles')
<style>
    .detail-card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 1rem;
    }
    
    .user-avatar-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 3rem;
        margin: 0 auto 1rem;
    }
    
    .role-badge-large {
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 1rem;
        font-weight: 500;
    }
    
    .role-teacher { background: #e3f2fd; color: #1976d2; }
    .role-educational_center { background: #e8f5e8; color: #388e3c; }
    .role-school { background: #fff3e0; color: #f57c00; }
    .role-kindergarten { background: #fce4ec; color: #c2185b; }
    .role-nursery { background: #f3e5f5; color: #7b1fa2; }
    
    .info-row {
        padding: 0.75rem 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #495057;
    }
    
    .status-pending {
        background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.875rem;
    }
</style>
@endsection

@section('content')
    <!-- Back Button -->
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>{{ __('messages.back_to_list') }}
            </a>
        </div>
    </div>

    <!-- User Information Card -->
    <div class="row">
        <div class="col-md-4">
            <div class="card detail-card">
                <div class="card-body text-center">
                    <div class="user-avatar-large">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h4 class="mb-2">{{ $user->name }}</h4>
                    <span class="badge role-badge-large role-{{ $user->role }}">
                        {{ __('messages.' . $user->role) }}
                    </span>
                    <div class="mt-3">
                        <span class="status-pending">
                            <i class="bi bi-clock me-1"></i>{{ __('messages.pending') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card detail-card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('messages.basic_information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <div class="row">
                            <div class="col-sm-4 info-label">{{ __('messages.name') }}:</div>
                            <div class="col-sm-8">{{ $user->name }}</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="row">
                            <div class="col-sm-4 info-label">{{ __('messages.email') }}:</div>
                            <div class="col-sm-8">{{ $user->email }}</div>
                        </div>
                    </div>
                    @if($user->phone)
                    <div class="info-row">
                        <div class="row">
                            <div class="col-sm-4 info-label">{{ __('messages.phone') }}:</div>
                            <div class="col-sm-8">{{ $user->phone }}</div>
                        </div>
                    </div>
                    @endif
                    <div class="info-row">
                        <div class="row">
                            <div class="col-sm-4 info-label">{{ __('messages.role') }}:</div>
                            <div class="col-sm-8">{{ __('messages.' . $user->role) }}</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="row">
                            <div class="col-sm-4 info-label">{{ __('messages.registration_date') }}:</div>
                            <div class="col-sm-8">{{ $user->created_at->format('Y-m-d H:i') }}</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="row">
                            <div class="col-sm-4 info-label">{{ __('messages.status') }}:</div>
                            <div class="col-sm-8">
                                <span class="status-pending">{{ __('messages.pending') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Role-specific Information -->
    @if($user->role == 'teacher' && $user->teacher)
        <div class="row mt-3">
            <div class="col-12">
                <div class="card detail-card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('messages.teacher_information') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if($user->teacher->academic_degree)
                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">{{ __('messages.academic_degree') }}:</div>
                                        <div class="col-sm-8">{{ $user->teacher->academic_degree }}</div>
                                    </div>
                                </div>
                                @endif
                                @if($user->teacher->experience_years)
                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">{{ __('messages.experience_years') }}:</div>
                                        <div class="col-sm-8">{{ $user->teacher->experience_years }} {{ __('messages.years') }}</div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($user->teacher->specialization)
                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">{{ __('messages.specialization') }}:</div>
                                        <div class="col-sm-8">{{ $user->teacher->specialization }}</div>
                                    </div>
                                </div>
                                @endif
                                @if($user->teacher->gender)
                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">{{ __('messages.gender') }}:</div>
                                        <div class="col-sm-8">{{ __('messages.' . $user->teacher->gender) }}</div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($user->role == 'educational_center' && $user->educationalCenter)
        <div class="row mt-3">
            <div class="col-12">
                <div class="card detail-card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('messages.center_information') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if($user->educationalCenter->name)
                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">{{ __('messages.center_name') }}:</div>
                                        <div class="col-sm-8">{{ $user->educationalCenter->name }}</div>
                                    </div>
                                </div>
                                @endif
                                @if($user->educationalCenter->phone)
                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">{{ __('messages.phone') }}:</div>
                                        <div class="col-sm-8">{{ $user->educationalCenter->phone }}</div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($user->educationalCenter->address)
                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">{{ __('messages.address') }}:</div>
                                        <div class="col-sm-8">{{ $user->educationalCenter->address }}</div>
                                    </div>
                                </div>
                                @endif
                                @if($user->educationalCenter->website)
                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">{{ __('messages.website') }}:</div>
                                        <div class="col-sm-8">
                                            <a href="{{ $user->educationalCenter->website }}" target="_blank">{{ $user->educationalCenter->website }}</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @if($user->educationalCenter->description)
                        <div class="info-row mt-3">
                            <div class="info-label mb-2">{{ __('messages.description') }}:</div>
                            <div>{{ $user->educationalCenter->description }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card detail-card">
                <div class="card-body text-center">
                    <h5 class="mb-3">{{ __('messages.actions') }}</h5>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-success btn-lg" onclick="approveRegistration({{ $user->id }})">
                            <i class="bi bi-check-lg me-2"></i>{{ __('messages.approve') }}
                        </button>
                        <button type="button" class="btn btn-danger btn-lg" onclick="showRejectModal({{ $user->id }}, '{{ $user->name }}')">
                            <i class="bi bi-x-lg me-2"></i>{{ __('messages.reject') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.reject_registration') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>{{ __('messages.reject_registration_confirm') }} <strong id="userName"></strong>?</p>
                        <div class="mb-3">
                            <label for="rejection_reason" class="form-label">{{ __('messages.rejection_reason') }}</label>
                            <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('messages.reject') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function approveRegistration(userId) {
        if (confirm('{{ __('messages.approve_registration_confirm') }}')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/registrations/${userId}/approve`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            form.appendChild(csrfToken);
            document.body.appendChild(form);
            form.submit();
        }
    }

    function showRejectModal(userId, userName) {
        document.getElementById('userName').textContent = userName;
        document.getElementById('rejectForm').action = `/admin/registrations/${userId}/reject`;
        new bootstrap.Modal(document.getElementById('rejectModal')).show();
    }
</script>
@endsection
