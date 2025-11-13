@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Payment Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">
                {{ __('Complete Your Payment') }}
            </h2>
            <p class="text-gray-600">
                {{ __('Secure payment to activate your account') }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Payment Form -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="px-6 py-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">{{ __('Payment Information') }}</h3>
                        
                        <form method="POST" action="{{ route('payment.process', $subscription) }}" id="payment-form">
                            @csrf
                            
                            <!-- Payment Method Selection -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    {{ __('Payment Method') }} <span class="text-red-500">*</span>
                                </label>
                                <div class="space-y-3">
                                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="credit_card" class="text-blue-600 focus:ring-blue-500" required>
                                        <div class="ml-3 rtl:ml-0 rtl:mr-3">
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 text-blue-600 mr-2 rtl:mr-0 rtl:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                </svg>
                                                <span class="font-medium text-gray-900">{{ __('Credit/Debit Card') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-500">{{ __('Pay securely with your credit or debit card') }}</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="paypal" class="text-blue-600 focus:ring-blue-500">
                                        <div class="ml-3 rtl:ml-0 rtl:mr-3">
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 text-blue-600 mr-2 rtl:mr-0 rtl:ml-2" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.421c-.315-.168-.652-.31-1.006-.421a7.83 7.83 0 0 0-1.284-.17c-.282-.019-.57-.019-.862-.019H9.722c-.524 0-.968.382-1.05.9L7.55 13.992a.641.641 0 0 0 .633.74h2.19c4.298 0 7.664-1.747 8.647-6.797.03-.149.054-.294.077-.437a6.75 6.75 0 0 0-.875-1.581z"/>
                                                </svg>
                                                <span class="font-medium text-gray-900">{{ __('PayPal') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-500">{{ __('Pay with your PayPal account') }}</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="bank_transfer" class="text-blue-600 focus:ring-blue-500">
                                        <div class="ml-3 rtl:ml-0 rtl:mr-3">
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 text-blue-600 mr-2 rtl:mr-0 rtl:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                <span class="font-medium text-gray-900">{{ __('Bank Transfer') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-500">{{ __('Transfer directly from your bank account') }}</p>
                                        </div>
                                    </label>
                                </div>
                                @error('payment_method')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Credit Card Details (shown when credit card is selected) -->
                            <div id="credit-card-details" class="space-y-4 hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label for="card_holder_name" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('Cardholder Name') }} <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="card_holder_name" name="card_holder_name" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        @error('card_holder_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="md:col-span-2">
                                        <label for="card_number" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('Card Number') }} <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        @error('card_number')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="card_expiry" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('Expiry Date') }} <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="card_expiry" name="card_expiry" placeholder="MM/YY"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        @error('card_expiry')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="card_cvv" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('CVV') }} <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="card_cvv" name="card_cvv" placeholder="123"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        @error('card_cvv')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Transfer Details (shown when bank transfer is selected) -->
                            <div id="bank-transfer-details" class="hidden">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <h4 class="font-medium text-blue-900 mb-2">{{ __('Bank Transfer Instructions') }}</h4>
                                    <div class="text-sm text-blue-800 space-y-1">
                                        <p><strong>{{ __('Bank Name:') }}</strong> Jordan Bank</p>
                                        <p><strong>{{ __('Account Number:') }}</strong> 123456789</p>
                                        <p><strong>{{ __('IBAN:') }}</strong> JO12 BANK 1234 5678 9012 3456 78</p>
                                        <p><strong>{{ __('Reference:') }}</strong> {{ $subscription->id }}</p>
                                    </div>
                                    <p class="text-sm text-blue-700 mt-3">
                                        {{ __('Please include the reference number in your transfer and contact us after completing the transfer.') }}
                                    </p>
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="mt-4 bg-red-50 border border-red-200 rounded-md p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3 rtl:ml-0 rtl:mr-3">
                                            <h3 class="text-sm font-medium text-red-800">
                                                {{ __('Payment Error') }}
                                            </h3>
                                            <div class="mt-2 text-sm text-red-700">
                                                <ul class="list-disc pl-5 rtl:pl-0 rtl:pr-5 space-y-1">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="mt-8">
                                <button type="submit" 
                                        class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    {{ __('Complete Payment') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden sticky top-8">
                    <div class="px-6 py-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">{{ __('Order Summary') }}</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">{{ __('Subscription Type:') }}</span>
                                <span class="font-medium text-gray-900 capitalize">
                                    {{ __(ucfirst(str_replace('_', ' ', $subscription->type))) }}
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">{{ __('Duration:') }}</span>
                                <span class="font-medium text-gray-900">{{ __('1 Year') }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">{{ __('Valid Until:') }}</span>
                                <span class="font-medium text-gray-900">
                                    {{ $subscription->expires_at->format('M d, Y') }}
                                </span>
                            </div>
                            
                            <hr class="border-gray-200">
                            
                            <div class="flex justify-between items-center text-lg font-semibold">
                                <span class="text-gray-900">{{ __('Total:') }}</span>
                                <span class="text-green-600">{{ $subscription->amount }} {{ __('JD') }}</span>
                            </div>
                        </div>
                        
                        <!-- Security Badge -->
                        <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2 rtl:mr-0 rtl:ml-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-gray-600">{{ __('Secure SSL Encrypted Payment') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const creditCardDetails = document.getElementById('credit-card-details');
    const bankTransferDetails = document.getElementById('bank-transfer-details');
    
    paymentMethods.forEach(function(method) {
        method.addEventListener('change', function() {
            // Hide all details sections
            creditCardDetails.classList.add('hidden');
            bankTransferDetails.classList.add('hidden');
            
            // Show relevant section
            if (this.value === 'credit_card') {
                creditCardDetails.classList.remove('hidden');
            } else if (this.value === 'bank_transfer') {
                bankTransferDetails.classList.remove('hidden');
            }
        });
    });
    
    // Format card number input
    const cardNumberInput = document.getElementById('card_number');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        });
    }
    
    // Format expiry date input
    const cardExpiryInput = document.getElementById('card_expiry');
    if (cardExpiryInput) {
        cardExpiryInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });
    }
    
    // Format CVV input
    const cardCvvInput = document.getElementById('card_cvv');
    if (cardCvvInput) {
        cardCvvInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
        });
    }
});
</script>
@endsection
