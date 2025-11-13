<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EducationalStage;

class EducationalStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stages = [
            [
                'name_ar' => 'ابتدائي',
                'name_en' => 'Elementary',
                'slug' => 'elementary',
                'is_active' => true,
            ],
            [
                'name_ar' => 'أساسي',
                'name_en' => 'Basic',
                'slug' => 'basic',
                'is_active' => true,
            ],
            [
                'name_ar' => 'ثانوي',
                'name_en' => 'Secondary',
                'slug' => 'secondary',
                'is_active' => true,
            ],
        ];

        foreach ($stages as $stage) {
            EducationalStage::firstOrCreate(
                ['slug' => $stage['slug']],
                $stage
            );
        }
    }
}
