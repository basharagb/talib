<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'level',
    ];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subjects')->withPivot('subject_id');
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_grades');
    }

    public function kindergartens()
    {
        return $this->belongsToMany(Kindergarten::class, 'kindergarten_grades');
    }
}
