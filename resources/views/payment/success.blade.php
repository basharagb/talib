@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-8 text-center">
                <!-- Success Icon -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <!-- Success Message -->
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    {{ __('Payment Successful!') }}
                </h2>
                
                <p class="text-gray-600 mb-8">
                    {{ __('Thank you for your payment. Your account has been activated successfully.') }}
                </p>
                
                <!-- Payment Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Payment Details') }}</h3>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('Transaction ID:') }}</span>
                            <span class="font-medium text-gray-900">{{ $payment->transaction_id }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('Amount:') }}</span>
                            <span class="font-medium text-gray-900">{{ $payment->amount }} {{ __('JD') }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('Payment Method:') }}</span>
                            <span class="font-medium text-gray-900 capitalize">
                                {{ __(ucfirst(str_replace('_', ' ', $payment->payment_method))) }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('Date:') }}</span>
                            <span class="font-medium text-gray-900">
                                {{ $payment->paid_at->format('M d, Y \a\t H:i') }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('Status:') }}</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ __('Completed') }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Next Steps -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">{{ __('What\'s Next?') }}</h3>
                    <div class="text-sm text-blue-800 space-y-2">
                        <p>✓ {{ __('Your account is now active and ready to use') }}</p>
                        <p>✓ {{ __('You can now access all premium features') }}</p>
                        <p>✓ {{ __('Your subscription is valid until') }} {{ $payment->subscription->expires_at->format('M d, Y') }}</p>
                        <p>✓ {{ __('A confirmation email has been sent to your email address') }}</p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('dashboard') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ __('Go to Dashboard') }}
                    </a>
                    
                    <a href="{{ route('home') }}" 
                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        {{ __('Back to Home') }}
                    </a>
                </div>
                
                <!-- Support Info -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-500">
                        {{ __('Need help? Contact our support team at') }} 
                        <a href="mailto:support@talib.com" class="text-blue-600 hover:text-blue-700">support@talib.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
