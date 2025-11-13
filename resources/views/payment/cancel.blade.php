@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-8 text-center">
                <!-- Cancel Icon -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                
                <!-- Cancel Message -->
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    {{ __('Payment Cancelled') }}
                </h2>
                
                <p class="text-gray-600 mb-8">
                    {{ __('Your payment was cancelled. No charges have been made to your account.') }}
                </p>
                
                <!-- Payment Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Payment Information') }}</h3>
                    
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
                            <span class="text-gray-600">{{ __('Status:') }}</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                {{ __('Cancelled') }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Information -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-yellow-900 mb-3">{{ __('What Happens Now?') }}</h3>
                    <div class="text-sm text-yellow-800 space-y-2">
                        <p>• {{ __('Your registration is still saved in our system') }}</p>
                        <p>• {{ __('You can complete the payment at any time to activate your account') }}</p>
                        <p>• {{ __('Your account will remain inactive until payment is completed') }}</p>
                        <p>• {{ __('No charges have been made to your payment method') }}</p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('payment.show', $payment->subscription) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ __('Try Payment Again') }}
                    </a>
                    
                    <a href="{{ route('home') }}" 
                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        {{ __('Back to Home') }}
                    </a>
                </div>
                
                <!-- Support Info -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-500">
                        {{ __('Having trouble with payment? Contact our support team at') }} 
                        <a href="mailto:support@talib.com" class="text-blue-600 hover:text-blue-700">support@talib.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
