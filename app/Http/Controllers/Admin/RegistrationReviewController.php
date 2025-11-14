<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use App\Models\EducationalCenter;
use App\Models\School;
use App\Models\Kindergarten;
use App\Models\Nursery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationReviewController extends Controller
{
    /**
     * Display pending registrations for review
     */
    public function index()
    {
        // Get all pending users with their related data
        $pendingUsers = User::with(['teacher', 'educationalCenter', 'school', 'kindergarten', 'nursery'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.registrations.index', compact('pendingUsers'));
    }

    /**
     * Show detailed view of a specific registration
     */
    public function show(User $user)
    {
        // Load the related model based on user role
        $relationName = $this->getRelationName($user->role);
        if ($relationName) {
            $user->load($relationName);
        }
        
        return view('admin.registrations.show', compact('user'));
    }
    
    /**
     * Get the correct relation name for the user role
     */
    private function getRelationName($role)
    {
        $relations = [
            'teacher' => 'teacher',
            'educational_center' => 'educationalCenter',
            'school' => 'school',
            'kindergarten' => 'kindergarten',
            'nursery' => 'nursery',
        ];
        
        return $relations[$role] ?? null;
    }

    /**
     * Approve a registration
     */
    public function approve(Request $request, User $user)
    {
        if ($user->status !== 'pending') {
            return redirect()->back()->with('error', __('messages.registration_already_processed'));
        }

        DB::transaction(function () use ($user, $request) {
            // Update user status to active
            $user->update([
                'status' => 'active',
                'email_verified_at' => now()
            ]);

            // Create subscription record
            $user->subscriptions()->create([
                'subscription_type' => $user->role,
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addYear(),
                'amount' => $this->getSubscriptionAmount($user->role)
            ]);
        });

        return redirect()->route('admin.registrations.index')
            ->with('success', __('messages.registration_approved_successfully'));
    }

    /**
     * Reject a registration
     */
    public function reject(Request $request, User $user)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        if ($user->status !== 'pending') {
            return redirect()->back()->with('error', __('messages.registration_already_processed'));
        }

        DB::transaction(function () use ($user, $request) {
            // Update user status to rejected
            $user->update([
                'status' => 'rejected',
                'rejection_reason' => $request->rejection_reason
            ]);
        });

        return redirect()->route('admin.registrations.index')
            ->with('success', __('messages.registration_rejected_successfully'));
    }

    /**
     * Get subscription amount based on user role
     */
    private function getSubscriptionAmount($role)
    {
        $amounts = [
            'teacher' => 10,
            'educational_center' => 25,
            'school' => 50,
            'kindergarten' => 50,
            'nursery' => 40
        ];

        return $amounts[$role] ?? 0;
    }

    /**
     * Get pending registrations count for dashboard
     */
    public function getPendingCount()
    {
        return User::where('status', 'pending')->count();
    }
}
