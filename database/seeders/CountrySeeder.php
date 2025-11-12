<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name_ar' => 'الأردن', 'name_en' => 'Jordan', 'code' => 'JO'],
            ['name_ar' => 'السعودية', 'name_en' => 'Saudi Arabia', 'code' => 'SA'],
            ['name_ar' => 'الإمارات', 'name_en' => 'UAE', 'code' => 'AE'],
            ['name_ar' => 'الكويت', 'name_en' => 'Kuwait', 'code' => 'KW'],
            ['name_ar' => 'قطر', 'name_en' => 'Qatar', 'code' => 'QA'],
            ['name_ar' => 'البحرين', 'name_en' => 'Bahrain', 'code' => 'BH'],
            ['name_ar' => 'عمان', 'name_en' => 'Oman', 'code' => 'OM'],
            ['name_ar' => 'لبنان', 'name_en' => 'Lebanon', 'code' => 'LB'],
            ['name_ar' => 'سوريا', 'name_en' => 'Syria', 'code' => 'SY'],
            ['name_ar' => 'العراق', 'name_en' => 'Iraq', 'code' => 'IQ'],
            ['name_ar' => 'مصر', 'name_en' => 'Egypt', 'code' => 'EG'],
            ['name_ar' => 'فلسطين', 'name_en' => 'Palestine', 'code' => 'PS'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
