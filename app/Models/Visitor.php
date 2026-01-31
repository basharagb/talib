<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'device_type',
        'browser',
        'os',
        'country_code',
        'country_name',
        'city',
        'region',
        'page_visited',
        'referrer',
        'user_id',
        'gender',
    ];

    /**
     * Get the user that owns the visitor record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for filtering by country.
     */
    public function scopeByCountry($query, $countryCode)
    {
        return $query->where('country_code', $countryCode);
    }

    /**
     * Scope for filtering by gender.
     */
    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    /**
     * Scope for filtering by date range.
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Get unique visitors count.
     */
    public static function uniqueVisitorsCount($startDate = null, $endDate = null)
    {
        $query = self::query();
        
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->distinct('ip_address')->count('ip_address');
    }

    /**
     * Get visitors by country statistics.
     */
    public static function getByCountryStats($limit = 10)
    {
        return self::selectRaw('country_name, country_code, COUNT(*) as visits, COUNT(DISTINCT ip_address) as unique_visitors')
            ->whereNotNull('country_name')
            ->groupBy('country_name', 'country_code')
            ->orderByDesc('visits')
            ->limit($limit)
            ->get();
    }

    /**
     * Get visitors by gender statistics.
     */
    public static function getByGenderStats()
    {
        return self::selectRaw('gender, COUNT(*) as count')
            ->groupBy('gender')
            ->get()
            ->pluck('count', 'gender')
            ->toArray();
    }

    /**
     * Get most visited pages.
     */
    public static function getMostVisitedPages($limit = 10)
    {
        return self::selectRaw('page_visited, COUNT(*) as visits')
            ->whereNotNull('page_visited')
            ->groupBy('page_visited')
            ->orderByDesc('visits')
            ->limit($limit)
            ->get();
    }

    /**
     * Get visitors by region statistics.
     */
    public static function getByRegionStats($limit = 10)
    {
        return self::selectRaw('region, country_name, COUNT(*) as visits')
            ->whereNotNull('region')
            ->groupBy('region', 'country_name')
            ->orderByDesc('visits')
            ->limit($limit)
            ->get();
    }

    /**
     * Get daily visitors for chart.
     */
    public static function getDailyVisitors($days = 30)
    {
        return self::selectRaw('DATE(created_at) as date, COUNT(*) as visits, COUNT(DISTINCT ip_address) as unique_visitors')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }
}
