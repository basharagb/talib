<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'city_id',
        'district',
        'location',
        'degree',
        'description',
        'profile_image',
        'cv_file',
        'certificates',
        'gender',
        'social_links',
        'experience',
        'subscription_fee',
    ];

    protected $casts = [
        'social_links' => 'array',
        'certificates' => 'array',
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
        return $this->belongsToMany(Subject::class, 'teacher_subjects');
    }
}
