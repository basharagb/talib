<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'phone',
        'locale',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function educationalCenter()
    {
        return $this->hasOne(EducationalCenter::class);
    }

    public function school()
    {
        return $this->hasOne(School::class);
    }

    public function kindergarten()
    {
        return $this->hasOne(Kindergarten::class);
    }

    public function nursery()
    {
        return $this->hasOne(Nursery::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class)->latest();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isEducationalCenter()
    {
        return $this->role === 'educational_center';
    }

    public function isSchool()
    {
        return $this->role === 'school';
    }

    public function isKindergarten()
    {
        return $this->role === 'kindergarten';
    }

    public function isNursery()
    {
        return $this->role === 'nursery';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}
