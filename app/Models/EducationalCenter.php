<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'city_id',
        'district',
        'location',
        'description',
        'logo',
        'social_links',
        'subscription_fee',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'center_subjects');
    }
}
