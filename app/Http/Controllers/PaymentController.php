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
            'payment_method' => 'required|in:card,cash,bank_transfer,paypal',
            'card_number' => 'required_if:payment_method,card',
            'card_expiry' => 'required_if:payment_method,card',
            'card_cvv' => 'required_if:payment_method,card',
            'card_holder_name' => 'required_if:payment_method,card',
            'transfer_receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Ensure the subscription belongs to the authenticated user
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            DB::beginTransaction();

            // Store receipt if uploaded
            $receiptPath = null;
            if ($request->hasFile('transfer_receipt')) {
                $receiptPath = $request->file('transfer_receipt')->store('payment_receipts', 'public');
            }

            // Update subscription with payment info
            $subscription->update([
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'payment_reference' => $this->generateTransactionId(),
                'payment_notes' => $receiptPath ? 'Receipt uploaded: ' . $receiptPath : null,
            ]);

            // Process payment based on method
            $paymentResult = $this->processPaymentByMethod($request->payment_method, $subscription, $request);

            if ($paymentResult['success']) {
                // Update subscription based on payment method
                $updateData = [
                    'payment_status' => $paymentResult['payment_status'],
                    'payment_reference' => $paymentResult['transaction_id'],
                ];

                // Auto-approve for electronic payments (card, paypal)
                if (in_array($request->payment_method, ['card', 'paypal'])) {
                    $updateData['status'] = 'active';
                    $updateData['payment_status'] = 'paid';
                    $updateData['paid_at'] = now();
                    $updateData['auto_approved'] = true;
                    $subscription->user->update(['status' => 'active']);
                }

                $subscription->update($updateData);

                DB::commit();

                if ($subscription->status === 'active') {
                    return redirect()->route('payment.status', $subscription)
                                   ->with('success', __('Payment completed successfully! Your account is now active.'));
                } else {
                    return redirect()->route('payment.status', $subscription)
                                   ->with('info', __('Payment submitted. Waiting for admin approval.'));
                }
            } else {
                $subscription->update([
                    'payment_status' => 'failed',
                    'payment_notes' => $paymentResult['error'] ?? 'Payment processing failed',
                ]);

                DB::rollBack();

                return back()->withErrors(['payment' => $paymentResult['error'] ?? __('Payment failed. Please try again.')]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['payment' => __('Payment processing failed. Please try again.')]);
        }
    }

    public function status(Subscription $subscription)
    {
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment.status', compact('subscription'));
    }

    public function success(Subscription $subscription)
    {
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment.success', compact('subscription'));
    }

    public function cancel(Subscription $subscription)
    {
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment.cancel', compact('subscription'));
    }

    private function processPaymentByMethod(string $method, Subscription $subscription, Request $request): array
    {
        switch ($method) {
            case 'card':
                return $this->processCardPayment($subscription, $request);
            case 'paypal':
                return $this->processPayPalPayment($subscription, $request);
            case 'bank_transfer':
                return $this->processBankTransferPayment($subscription, $request);
            case 'cash':
                return $this->processCashPayment($subscription, $request);
            default:
                return ['success' => false, 'error' => 'Invalid payment method'];
        }
    }

    private function processCardPayment(Subscription $subscription, Request $request): array
    {
        // This is a placeholder for card processing
        // In a real application, you would integrate with a payment gateway like Stripe, Checkout.com, etc.
        
        // Simulate payment processing
        $success = rand(1, 10) > 1; // 90% success rate for demo
        
        if ($success) {
            return [
                'success' => true,
                'transaction_id' => 'CARD_' . time() . '_' . uniqid(),
                'payment_status' => 'paid',
            ];
        } else {
            return [
                'success' => false,
                'error' => 'Card payment failed. Please check your card details.',
            ];
        }
    }

    private function processPayPalPayment(Subscription $subscription, Request $request): array
    {
        // This is a placeholder for PayPal processing
        // In a real application, you would integrate with PayPal API
        
        return [
            'success' => true,
            'transaction_id' => 'PAYPAL_' . time() . '_' . uniqid(),
            'payment_status' => 'paid',
        ];
    }

    private function processBankTransferPayment(Subscription $subscription, Request $request): array
    {
        // Bank transfer payments require manual verification
        return [
            'success' => true,
            'transaction_id' => 'TRANSFER_' . time() . '_' . uniqid(),
            'payment_status' => 'pending',
        ];
    }

    private function processCashPayment(Subscription $subscription, Request $request): array
    {
        // Cash payments require manual verification by admin
        return [
            'success' => true,
            'transaction_id' => 'CASH_' . time() . '_' . uniqid(),
            'payment_status' => 'pending',
        ];
    }

    private function generateTransactionId(): string
    {
        return 'TXN_' . time() . '_' . uniqid();
    }
}
