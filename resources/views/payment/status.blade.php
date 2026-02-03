@extends('layouts.dashboard')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient text-white text-center py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h3 class="mb-0">
                        <i class="bi bi-receipt me-2"></i>
                        {{ __('Registration & Payment Status') }}
                    </h3>
                </div>
                
                <div class="card-body p-5">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            {{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Registration Status -->
                    <div class="mb-5">
                        <h4 class="border-bottom pb-3 mb-4">
                            <i class="bi bi-person-check me-2 text-primary"></i>
                            {{ __('Registration Status') }}
                        </h4>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <div class="flex-shrink-0">
                                        @if($subscription->user->status === 'active')
                                            <div class="bg-success text-white rounded-circle p-3">
                                                <i class="bi bi-check-lg fs-4"></i>
                                            </div>
                                        @elseif($subscription->user->status === 'pending')
                                            <div class="bg-warning text-white rounded-circle p-3">
                                                <i class="bi bi-clock fs-4"></i>
                                            </div>
                                        @else
                                            <div class="bg-secondary text-white rounded-circle p-3">
                                                <i class="bi bi-hourglass fs-4"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ __('Account Status') }}</h6>
                                        <p class="mb-0">
                                            @if($subscription->user->status === 'active')
                                                <span class="badge bg-success">{{ __('Active') }}</span>
                                            @elseif($subscription->user->status === 'pending')
                                                <span class="badge bg-warning">{{ __('Pending Approval') }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($subscription->user->status) }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <div class="flex-shrink-0">
                                        <div class="bg-info text-white rounded-circle p-3">
                                            <i class="bi bi-person-badge fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ __('Account Type') }}</h6>
                                        <p class="mb-0">
                                            <span class="badge bg-info">{{ ucfirst($subscription->type) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Status -->
                    <div class="mb-5">
                        <h4 class="border-bottom pb-3 mb-4">
                            <i class="bi bi-credit-card me-2 text-primary"></i>
                            {{ __('Payment Status') }}
                        </h4>
                        
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="text-center p-4 bg-light rounded">
                                    <div class="mb-3">
                                        @if($subscription->payment_status === 'paid')
                                            <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                                        @elseif($subscription->payment_status === 'pending')
                                            <i class="bi bi-hourglass-split text-warning" style="font-size: 3rem;"></i>
                                        @elseif($subscription->payment_status === 'failed')
                                            <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
                                        @else
                                            <i class="bi bi-question-circle text-secondary" style="font-size: 3rem;"></i>
                                        @endif
                                    </div>
                                    <h6>{{ __('Payment Status') }}</h6>
                                    <p class="mb-0">
                                        @if($subscription->payment_status === 'paid')
                                            <span class="badge bg-success">{{ __('Paid') }}</span>
                                        @elseif($subscription->payment_status === 'pending')
                                            <span class="badge bg-warning">{{ __('Pending') }}</span>
                                        @elseif($subscription->payment_status === 'failed')
                                            <span class="badge bg-danger">{{ __('Failed') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('Not Paid') }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="text-center p-4 bg-light rounded">
                                    <div class="mb-3">
                                        <i class="bi bi-wallet2 text-primary" style="font-size: 3rem;"></i>
                                    </div>
                                    <h6>{{ __('Payment Method') }}</h6>
                                    <p class="mb-0">
                                        @if($subscription->payment_method)
                                            @if($subscription->payment_method === 'card')
                                                <span class="badge bg-primary">{{ __('Credit/Debit Card') }}</span>
                                            @elseif($subscription->payment_method === 'cash')
                                                <span class="badge bg-success">{{ __('Cash') }}</span>
                                            @elseif($subscription->payment_method === 'bank_transfer')
                                                <span class="badge bg-info">{{ __('Bank Transfer') }}</span>
                                            @elseif($subscription->payment_method === 'paypal')
                                                <span class="badge bg-warning">{{ __('PayPal') }}</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">{{ __('Not Selected') }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="text-center p-4 bg-light rounded">
                                    <div class="mb-3">
                                        <i class="bi bi-currency-dollar text-success" style="font-size: 3rem;"></i>
                                    </div>
                                    <h6>{{ __('Amount') }}</h6>
                                    <p class="mb-0">
                                        <strong class="text-success fs-5">{{ $subscription->amount }} {{ __('JOD') }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($subscription->payment_reference)
                            <div class="alert alert-info mt-4">
                                <strong>{{ __('Payment Reference') }}:</strong> {{ $subscription->payment_reference }}
                            </div>
                        @endif

                        @if($subscription->paid_at)
                            <div class="alert alert-success mt-4">
                                <i class="bi bi-calendar-check me-2"></i>
                                <strong>{{ __('Paid At') }}:</strong> {{ $subscription->paid_at->format('Y-m-d H:i') }}
                            </div>
                        @endif
                    </div>

                    <!-- Admin Approval Status -->
                    @if($subscription->payment_status === 'pending' && in_array($subscription->payment_method, ['cash', 'bank_transfer']))
                        <div class="alert alert-warning border-0 shadow-sm">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill fs-3 me-3"></i>
                                <div>
                                    <h5 class="alert-heading mb-2">{{ __('Waiting for Admin Approval') }}</h5>
                                    <p class="mb-0">
                                        {{ __('Your payment is being reviewed by our admin team. You will receive a notification once your payment is approved and your account is activated.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($subscription->auto_approved)
                        <div class="alert alert-success border-0 shadow-sm">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-shield-check fs-3 me-3"></i>
                                <div>
                                    <h5 class="alert-heading mb-2">{{ __('Auto-Approved Payment') }}</h5>
                                    <p class="mb-0">
                                        {{ __('Your electronic payment was automatically verified and approved. Your account is now active!') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="text-center mt-5">
                        @if($subscription->status === 'active')
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-house-door me-2"></i>
                                {{ __('Go to Dashboard') }}
                            </a>
                        @else
                            <a href="{{ route('home') }}" class="btn btn-secondary btn-lg px-5">
                                <i class="bi bi-arrow-left me-2"></i>
                                {{ __('Back to Home') }}
                            </a>
                        @endif
                    </div>

                    <!-- Payment Notes -->
                    @if($subscription->payment_notes)
                        <div class="mt-4">
                            <h6 class="text-muted">{{ __('Notes') }}:</h6>
                            <p class="text-muted small">{{ $subscription->payment_notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Help Section -->
            <div class="card mt-4 border-0 shadow-sm">
                <div class="card-body text-center py-4">
                    <h5 class="mb-3">{{ __('Need Help?') }}</h5>
                    <p class="text-muted mb-3">
                        {{ __('If you have any questions about your registration or payment, please contact our support team.') }}
                    </p>
                    <a href="mailto:support@talib.live" class="btn btn-outline-primary">
                        <i class="bi bi-envelope me-2"></i>
                        {{ __('Contact Support') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
