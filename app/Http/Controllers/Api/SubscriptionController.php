<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    /**
     * Get all subscription plans
     */
    public function plans()
    {
        $plans = SubscriptionPlan::where('is_active', true)
            ->orderBy('price')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $plans
        ]);
    }

    /**
     * Get user's subscription
     */
    public function mySubscription(Request $request)
    {
        $subscription = Subscription::where('user_id', $request->user()->id)
            ->with('plan')
            ->latest()
            ->first();

        return response()->json([
            'success' => true,
            'data' => $subscription
        ]);
    }

    /**
     * Create a new subscription
     */
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:subscription_plans,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $plan = SubscriptionPlan::findOrFail($request->plan_id);
        $user = $request->user();

        // Check if user already has an active subscription
        $existingSubscription = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if ($existingSubscription) {
            return response()->json([
                'success' => false,
                'message' => 'You already have an active subscription'
            ], 400);
        }

        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration_days),
            'status' => 'pending',
            'amount' => $plan->price,
            'payment_status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subscription created successfully. Please proceed to payment.',
            'data' => $subscription
        ], 201);
    }

    /**
     * Process payment for subscription
     */
    public function processPayment(Request $request, $subscriptionId)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|in:card,cash,bank_transfer,paypal',
            'payment_reference' => 'nullable|string',
            'payment_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $subscription = Subscription::where('id', $subscriptionId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        if ($subscription->payment_status === 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'This subscription has already been paid'
            ], 400);
        }

        $paymentMethod = $request->payment_method;
        $autoApproved = in_array($paymentMethod, ['card', 'paypal']);

        $subscription->update([
            'payment_method' => $paymentMethod,
            'payment_reference' => $request->payment_reference,
            'payment_notes' => $request->payment_notes,
            'payment_status' => $autoApproved ? 'paid' : 'pending',
            'paid_at' => $autoApproved ? now() : null,
            'status' => $autoApproved ? 'active' : 'pending',
            'auto_approved' => $autoApproved,
        ]);

        // Activate user account if auto-approved
        if ($autoApproved) {
            $request->user()->update(['is_active' => true]);
        }

        return response()->json([
            'success' => true,
            'message' => $autoApproved 
                ? 'Payment processed successfully. Your account is now active.' 
                : 'Payment submitted. Waiting for admin approval.',
            'data' => $subscription
        ]);
    }

    /**
     * Get subscription payment status
     */
    public function paymentStatus(Request $request, $subscriptionId)
    {
        $subscription = Subscription::where('id', $subscriptionId)
            ->where('user_id', $request->user()->id)
            ->with('plan')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'subscription' => $subscription,
                'user_active' => $request->user()->is_active,
                'payment_status' => $subscription->payment_status,
                'subscription_status' => $subscription->status,
                'auto_approved' => $subscription->auto_approved,
            ]
        ]);
    }
}
