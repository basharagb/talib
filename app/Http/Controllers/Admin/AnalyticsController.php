<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Country;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * Display the analytics dashboard.
     */
    public function index(Request $request)
    {
        // Get filter parameters
        $countryFilter = $request->get('country');
        $genderFilter = $request->get('gender');
        $dateFrom = $request->get('date_from', now()->subDays(30)->format('Y-m-d'));
        $dateTo = $request->get('date_to', now()->format('Y-m-d'));

        // Build visitor query with filters
        $visitorsQuery = Visitor::query();
        
        if ($countryFilter) {
            $visitorsQuery->where('country_code', $countryFilter);
        }
        
        if ($genderFilter) {
            $visitorsQuery->where('gender', $genderFilter);
        }
        
        $visitorsQuery->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59']);

        // Total visitors
        $totalVisitors = $visitorsQuery->count();
        $uniqueVisitors = (clone $visitorsQuery)->distinct('ip_address')->count('ip_address');

        // Visitors today
        $visitorsToday = Visitor::whereDate('created_at', today())->count();
        $uniqueVisitorsToday = Visitor::whereDate('created_at', today())->distinct('ip_address')->count('ip_address');

        // Recent visitors for table
        $recentVisitors = Visitor::with('user')
            ->orderByDesc('created_at')
            ->limit(50)
            ->get();

        // Gender statistics
        $genderStats = Visitor::getByGenderStats();
        $maleVisitors = $genderStats['male'] ?? 0;
        $femaleVisitors = $genderStats['female'] ?? 0;
        $unknownGender = $genderStats['unknown'] ?? 0;

        // Country statistics
        $countryStats = Visitor::getByCountryStats(10);

        // Region statistics
        $regionStats = Visitor::getByRegionStats(10);

        // Daily visitors for chart (last 30 days)
        $dailyVisitors = Visitor::getDailyVisitors(30);

        // Most visited pages
        $mostVisitedPages = Visitor::getMostVisitedPages(10);

        // Registered users statistics
        $totalRegisteredUsers = User::count();
        $activeSubscribedUsers = User::where('status', 'active')
            ->whereIn('role', ['teacher', 'educational_center', 'school', 'kindergarten', 'nursery'])
            ->count();

        // Users by role
        $usersByRole = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        // Countries for filter dropdown
        $countries = Country::orderBy('name_' . app()->getLocale())->get();

        // Device statistics
        $deviceStats = Visitor::selectRaw('device_type, COUNT(*) as count')
            ->groupBy('device_type')
            ->pluck('count', 'device_type')
            ->toArray();

        // Browser statistics
        $browserStats = Visitor::selectRaw('browser, COUNT(*) as count')
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderByDesc('count')
            ->limit(5)
            ->pluck('count', 'browser')
            ->toArray();

        return view('admin.analytics.index', compact(
            'totalVisitors',
            'uniqueVisitors',
            'visitorsToday',
            'uniqueVisitorsToday',
            'recentVisitors',
            'maleVisitors',
            'femaleVisitors',
            'unknownGender',
            'countryStats',
            'regionStats',
            'dailyVisitors',
            'mostVisitedPages',
            'totalRegisteredUsers',
            'activeSubscribedUsers',
            'usersByRole',
            'countries',
            'deviceStats',
            'browserStats',
            'countryFilter',
            'genderFilter',
            'dateFrom',
            'dateTo'
        ));
    }

    /**
     * Export visitors data as CSV.
     */
    public function export(Request $request)
    {
        $visitors = Visitor::with('user')
            ->orderByDesc('created_at')
            ->get();

        $filename = 'visitors_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($visitors) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, [
                'ID', 'IP Address', 'User', 'Gender', 'Country', 'City', 'Region',
                'Page', 'Device', 'Browser', 'OS', 'Referrer', 'Date'
            ]);

            foreach ($visitors as $visitor) {
                fputcsv($file, [
                    $visitor->id,
                    $visitor->ip_address,
                    $visitor->user?->name ?? 'Guest',
                    $visitor->gender,
                    $visitor->country_name,
                    $visitor->city,
                    $visitor->region,
                    $visitor->page_visited,
                    $visitor->device_type,
                    $visitor->browser,
                    $visitor->os,
                    $visitor->referrer,
                    $visitor->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
