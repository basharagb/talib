<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function show(Subscription $subscription)
    {
        // Ensure the subscription belongs to the authenticated user
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment.show', compact('subscription'));
    }

    public function process(Request $request, Subscription $subscription)
    {
        $request->validate([
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer',
            'card_number' => 'required_if:payment_method,credit_card',
            'card_expiry' => 'required_if:payment_method,credit_card',
            'card_cvv' => 'required_if:payment_method,credit_card',
            'card_holder_name' => 'required_if:payment_method,credit_card',
        ]);

        // Ensure the subscription belongs to the authenticated user
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            DB::beginTransaction();

            // Create payment record
            $payment = Payment::create([
                'user_id' => auth()->id(),
                'subscription_id' => $subscription->id,
                'amount' => $subscription->amount,
                'currency' => 'JOD',
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'transaction_id' => $this->generateTransactionId(),
            ]);

            // Process payment based on method
            $paymentResult = $this->processPaymentByMethod($request->payment_method, $payment, $request);

            if ($paymentResult['success']) {
                // Update payment status
                $payment->update([
                    'status' => 'completed',
                    'gateway_transaction_id' => $paymentResult['transaction_id'] ?? null,
                    'paid_at' => now(),
                ]);

                // Update subscription status
                $subscription->update([
                    'status' => 'active',
                    'activated_at' => now(),
                ]);

                DB::commit();

                return redirect()->route('dashboard')
                               ->with('success', __('Payment completed successfully! Your account is now active.'));
            } else {
                // Update payment status to failed
                $payment->update([
                    'status' => 'failed',
                    'failure_reason' => $paymentResult['error'] ?? 'Payment processing failed',
                ]);

                DB::rollBack();

                return back()->withErrors(['payment' => $paymentResult['error'] ?? __('Payment failed. Please try again.')]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['payment' => __('Payment processing failed. Please try again.')]);
        }
    }

    public function success(Payment $payment)
    {
        if ($payment->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment.success', compact('payment'));
    }

    public function cancel(Payment $payment)
    {
        if ($payment->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment.cancel', compact('payment'));
    }

    private function processPaymentByMethod(string $method, Payment $payment, Request $request): array
    {
        switch ($method) {
            case 'credit_card':
                return $this->processCreditCardPayment($payment, $request);
            case 'paypal':
                return $this->processPayPalPayment($payment, $request);
            case 'bank_transfer':
                return $this->processBankTransferPayment($payment, $request);
            default:
                return ['success' => false, 'error' => 'Invalid payment method'];
        }
    }

    private function processCreditCardPayment(Payment $payment, Request $request): array
    {
        // This is a placeholder for credit card processing
        // In a real application, you would integrate with a payment gateway like Stripe, PayPal, etc.
        
        // Simulate payment processing
        $success = rand(1, 10) > 2; // 80% success rate for demo
        
        if ($success) {
            return [
                'success' => true,
                'transaction_id' => 'cc_' . uniqid(),
            ];
        } else {
            return [
                'success' => false,
                'error' => 'Credit card payment failed. Please check your card details.',
            ];
        }
    }

    private function processPayPalPayment(Payment $payment, Request $request): array
    {
        // This is a placeholder for PayPal processing
        // In a real application, you would integrate with PayPal API
        
        return [
            'success' => true,
            'transaction_id' => 'pp_' . uniqid(),
        ];
    }

    private function processBankTransferPayment(Payment $payment, Request $request): array
    {
        // Bank transfer payments are usually processed manually
        // Mark as pending and require admin approval
        
        $payment->update([
            'status' => 'pending_verification',
            'notes' => 'Bank transfer payment - requires manual verification',
        ]);

        return [
            'success' => true,
            'transaction_id' => 'bt_' . uniqid(),
        ];
    }

    private function generateTransactionId(): string
    {
        return 'TXN_' . time() . '_' . uniqid();
    }
}
