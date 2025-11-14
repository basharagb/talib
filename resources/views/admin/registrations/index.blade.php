@extends('layouts.dashboard')

@section('title', __('messages.pending_registrations') . ' - ' . config('app.name', 'طالب'))

@section('content-header')
@endsection

@section('page-title', __('messages.pending_registrations'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('messages.registration_review') }}</li>
@endsection

@section('styles')
<style>
    .registration-card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .registration-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .header-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .badge-pending {
        background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
    }
    
    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.5rem;
    }
    
    .role-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .role-teacher { background: #e3f2fd; color: #1976d2; }
    .role-educational_center { background: #e8f5e8; color: #388e3c; }
    .role-school { background: #fff3e0; color: #f57c00; }
    .role-kindergarten { background: #fce4ec; color: #c2185b; }
    .role-nursery { background: #f3e5f5; color: #7b1fa2; }
</style>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card header-gradient text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-2">{{ __('messages.pending_registrations') }}</h2>
                            <p class="mb-0 opacity-75">{{ __('messages.review_and_approve_registrations') }}</p>
                        </div>
                        <div class="text-end">
                            <div class="h3 mb-0">{{ $pendingUsers->total() }}</div>
                            <small class="opacity-75">{{ __('messages.pending_requests') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Registrations List -->
    @if($pendingUsers->count() > 0)
        @foreach($pendingUsers as $user)
            <div class="card registration-card mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="user-avatar">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="mb-0 me-3">{{ $user->name }}</h5>
                                <span class="badge role-badge role-{{ $user->role }}">
                                    {{ __('messages.' . $user->role) }}
                                </span>
                            </div>
                            <div class="text-muted small">
                                <i class="bi bi-envelope me-1"></i> {{ $user->email }}
                                @if($user->phone)
                                    <span class="ms-3">
                                        <i class="bi bi-telephone me-1"></i> {{ $user->phone }}
                                    </span>
                                @endif
                            </div>
                            <div class="text-muted small mt-1">
                                <i class="bi bi-calendar me-1"></i> 
                                {{ __('messages.registered_on') }}: {{ $user->created_at->format('Y-m-d H:i') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.registrations.show', $user) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye me-1"></i> {{ __('messages.view') }}
                                </a>
                                <button type="button" class="btn btn-success btn-sm" onclick="approveRegistration({{ $user->id }})">
                                    <i class="bi bi-check-lg me-1"></i> {{ __('messages.approve') }}
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="showRejectModal({{ $user->id }}, '{{ $user->name }}')">
                                    <i class="bi bi-x-lg me-1"></i> {{ __('messages.reject') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $pendingUsers->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3">{{ __('messages.no_pending_registrations') }}</h4>
                <p class="text-muted">{{ __('messages.all_registrations_processed') }}</p>
            </div>
        </div>
    @endif

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
