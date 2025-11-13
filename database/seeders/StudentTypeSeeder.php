<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StudentType;

class StudentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name_ar' => 'ذكور',
                'name_en' => 'Boys',
                'slug' => 'boys',
                'is_active' => true,
            ],
            [
                'name_ar' => 'إناث',
                'name_en' => 'Girls',
                'slug' => 'girls',
                'is_active' => true,
            ],
            [
                'name_ar' => 'مختلط',
                'name_en' => 'Mixed',
                'slug' => 'mixed',
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            StudentType::firstOrCreate(
                ['slug' => $type['slug']],
                $type
            );
        }
    }
}
