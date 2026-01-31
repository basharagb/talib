<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip tracking for API requests, assets, and admin analytics page to avoid loops
        if ($request->is('api/*') || 
            $request->is('*.css') || 
            $request->is('*.js') || 
            $request->is('*.ico') ||
            $request->is('admin/analytics*')) {
            return $next($request);
        }

        $this->trackVisitor($request);

        return $next($request);
    }

    /**
     * Track the visitor.
     */
    protected function trackVisitor(Request $request): void
    {
        $userAgent = $request->userAgent();
        $ipAddress = $request->ip();

        // Parse user agent for device info
        $deviceInfo = $this->parseUserAgent($userAgent);

        // Get geo location (basic implementation - can be enhanced with IP geolocation service)
        $geoInfo = $this->getGeoInfo($ipAddress);

        // Determine gender from authenticated user if available
        $gender = 'unknown';
        if (Auth::check() && Auth::user()->gender) {
            $gender = Auth::user()->gender;
        }

        Visitor::create([
            'ip_address' => $ipAddress,
            'user_agent' => substr($userAgent ?? '', 0, 255),
            'device_type' => $deviceInfo['device_type'],
            'browser' => $deviceInfo['browser'],
            'os' => $deviceInfo['os'],
            'country_code' => $geoInfo['country_code'],
            'country_name' => $geoInfo['country_name'],
            'city' => $geoInfo['city'],
            'region' => $geoInfo['region'],
            'page_visited' => $request->path(),
            'referrer' => $request->header('referer'),
            'user_id' => Auth::id(),
            'gender' => $gender,
        ]);
    }

    /**
     * Parse user agent string.
     */
    protected function parseUserAgent(?string $userAgent): array
    {
        $result = [
            'device_type' => 'desktop',
            'browser' => 'Unknown',
            'os' => 'Unknown',
        ];

        if (!$userAgent) {
            return $result;
        }

        // Detect device type
        if (preg_match('/Mobile|Android|iPhone|iPad/i', $userAgent)) {
            $result['device_type'] = preg_match('/iPad|Tablet/i', $userAgent) ? 'tablet' : 'mobile';
        }

        // Detect browser
        if (preg_match('/Chrome/i', $userAgent) && !preg_match('/Edge/i', $userAgent)) {
            $result['browser'] = 'Chrome';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $result['browser'] = 'Firefox';
        } elseif (preg_match('/Safari/i', $userAgent) && !preg_match('/Chrome/i', $userAgent)) {
            $result['browser'] = 'Safari';
        } elseif (preg_match('/Edge/i', $userAgent)) {
            $result['browser'] = 'Edge';
        } elseif (preg_match('/MSIE|Trident/i', $userAgent)) {
            $result['browser'] = 'IE';
        }

        // Detect OS
        if (preg_match('/Windows/i', $userAgent)) {
            $result['os'] = 'Windows';
        } elseif (preg_match('/Mac/i', $userAgent)) {
            $result['os'] = 'macOS';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $result['os'] = 'Linux';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $result['os'] = 'Android';
        } elseif (preg_match('/iOS|iPhone|iPad/i', $userAgent)) {
            $result['os'] = 'iOS';
        }

        return $result;
    }

    /**
     * Get geo information from IP (basic implementation).
     * For production, integrate with IP geolocation API like MaxMind, ipstack, etc.
     */
    protected function getGeoInfo(string $ipAddress): array
    {
        // Default values - in production, use a geolocation service
        $result = [
            'country_code' => null,
            'country_name' => null,
            'city' => null,
            'region' => null,
        ];

        // For local IPs, return default
        if (in_array($ipAddress, ['127.0.0.1', '::1', 'localhost'])) {
            $result['country_code'] = 'JO';
            $result['country_name'] = 'Jordan';
            $result['city'] = 'Amman';
            $result['region'] = 'Amman';
            return $result;
        }

        // Try to get geo info from free service (optional - for production use paid service)
        try {
            $response = @file_get_contents("http://ip-api.com/json/{$ipAddress}?fields=status,country,countryCode,regionName,city");
            if ($response) {
                $data = json_decode($response, true);
                if ($data && $data['status'] === 'success') {
                    $result['country_code'] = $data['countryCode'] ?? null;
                    $result['country_name'] = $data['country'] ?? null;
                    $result['city'] = $data['city'] ?? null;
                    $result['region'] = $data['regionName'] ?? null;
                }
            }
        } catch (\Exception $e) {
            // Silently fail - geo info is not critical
        }

        return $result;
    }
}
