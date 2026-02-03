<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     * Redirect pending users to their payment status page only.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Admin can access everything
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Pending users can only access payment status page, home, and dashboard (which will show payment status)
        if ($user->isPending()) {
            $subscription = $user->subscription;
            
            // Allow access to payment status route
            if ($request->routeIs('payment.status') || $request->routeIs('payment.show') || $request->routeIs('payment.process')) {
                return $next($request);
            }
            
            // Allow access to home page
            if ($request->routeIs('home')) {
                return $next($request);
            }
            
            // Allow access to dashboard (will redirect to payment status via view logic)
            if ($request->routeIs('dashboard')) {
                if ($subscription) {
                    return redirect()->route('payment.status', ['subscription' => $subscription->id]);
                }
                return redirect()->route('home');
            }
            
            // Allow access to logout
            if ($request->routeIs('logout')) {
                return $next($request);
            }
            
            // Allow access to locale switching
            if ($request->routeIs('locale.switch')) {
                return $next($request);
            }
            
            // Redirect to payment status page
            if ($subscription) {
                return redirect()->route('payment.status', ['subscription' => $subscription->id]);
            }
            
            // If no subscription, redirect to home
            return redirect()->route('home');
        }

        return $next($request);
    }
}
