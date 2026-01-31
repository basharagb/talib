<?php

/**
 * Arab Countries and Cities Seeder.
 *
 * This seeder populates the database with all Arab countries
 * and their major cities for the Talib educational platform.
 *
 * PHP version 8.4
 *
 * @category Database
 * @package  Talib
 * @author   Talib Platform <info@talib.com>
 * @license  MIT License
 * @version  GIT: <git_id>
 * @link     https://talib.com
 * @since    1.0.0
 */

namespace Database\Seeders;

use App\Models\Country;
use App\Models\City;
use Illuminate\Database\Seeder;

/**
 * ArabCountriesSeeder Class.
 *
 * Seeds all Arab countries with their cities.
 *
 * @category Database
 * @package  Talib
 * @author   Talib Platform <info@talib.com>
 * @license  MIT License
 * @link     https://talib.com
 */
class ArabCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $arabCountries = [
            [
                'name_ar' => 'الأردن',
                'name_en' => 'Jordan',
                'code' => 'JO',
                'cities' => [
                    ['name_ar' => 'عمان', 'name_en' => 'Amman'],
                    ['name_ar' => 'إربد', 'name_en' => 'Irbid'],
                    ['name_ar' => 'الزرقاء', 'name_en' => 'Zarqa'],
                    ['name_ar' => 'العقبة', 'name_en' => 'Aqaba'],
                    ['name_ar' => 'السلط', 'name_en' => 'Salt'],
                    ['name_ar' => 'المفرق', 'name_en' => 'Mafraq'],
                    ['name_ar' => 'جرش', 'name_en' => 'Jerash'],
                    ['name_ar' => 'عجلون', 'name_en' => 'Ajloun'],
                    ['name_ar' => 'الكرك', 'name_en' => 'Karak'],
                    ['name_ar' => 'معان', 'name_en' => 'Maan'],
                    ['name_ar' => 'الطفيلة', 'name_en' => 'Tafilah'],
                    ['name_ar' => 'مادبا', 'name_en' => 'Madaba'],
                ],
            ],
            [
                'name_ar' => 'السعودية',
                'name_en' => 'Saudi Arabia',
                'code' => 'SA',
                'cities' => [
                    ['name_ar' => 'الرياض', 'name_en' => 'Riyadh'],
                    ['name_ar' => 'جدة', 'name_en' => 'Jeddah'],
                    ['name_ar' => 'مكة المكرمة', 'name_en' => 'Mecca'],
                    ['name_ar' => 'المدينة المنورة', 'name_en' => 'Medina'],
                    ['name_ar' => 'الدمام', 'name_en' => 'Dammam'],
                    ['name_ar' => 'الخبر', 'name_en' => 'Khobar'],
                    ['name_ar' => 'الطائف', 'name_en' => 'Taif'],
                    ['name_ar' => 'تبوك', 'name_en' => 'Tabuk'],
                    ['name_ar' => 'بريدة', 'name_en' => 'Buraidah'],
                    ['name_ar' => 'خميس مشيط', 'name_en' => 'Khamis Mushait'],
                    ['name_ar' => 'أبها', 'name_en' => 'Abha'],
                    ['name_ar' => 'نجران', 'name_en' => 'Najran'],
                    ['name_ar' => 'جازان', 'name_en' => 'Jazan'],
                    ['name_ar' => 'ينبع', 'name_en' => 'Yanbu'],
                    ['name_ar' => 'حائل', 'name_en' => 'Hail'],
                ],
            ],
            [
                'name_ar' => 'الإمارات',
                'name_en' => 'UAE',
                'code' => 'AE',
                'cities' => [
                    ['name_ar' => 'أبوظبي', 'name_en' => 'Abu Dhabi'],
                    ['name_ar' => 'دبي', 'name_en' => 'Dubai'],
                    ['name_ar' => 'الشارقة', 'name_en' => 'Sharjah'],
                    ['name_ar' => 'عجمان', 'name_en' => 'Ajman'],
                    ['name_ar' => 'رأس الخيمة', 'name_en' => 'Ras Al Khaimah'],
                    ['name_ar' => 'الفجيرة', 'name_en' => 'Fujairah'],
                    ['name_ar' => 'أم القيوين', 'name_en' => 'Umm Al Quwain'],
                    ['name_ar' => 'العين', 'name_en' => 'Al Ain'],
                ],
            ],
            [
                'name_ar' => 'الكويت',
                'name_en' => 'Kuwait',
                'code' => 'KW',
                'cities' => [
                    ['name_ar' => 'مدينة الكويت', 'name_en' => 'Kuwait City'],
                    ['name_ar' => 'حولي', 'name_en' => 'Hawalli'],
                    ['name_ar' => 'السالمية', 'name_en' => 'Salmiya'],
                    ['name_ar' => 'الفروانية', 'name_en' => 'Farwaniya'],
                    ['name_ar' => 'الجهراء', 'name_en' => 'Jahra'],
                    ['name_ar' => 'الأحمدي', 'name_en' => 'Ahmadi'],
                    ['name_ar' => 'مبارك الكبير', 'name_en' => 'Mubarak Al-Kabeer'],
                ],
            ],
            [
                'name_ar' => 'قطر',
                'name_en' => 'Qatar',
                'code' => 'QA',
                'cities' => [
                    ['name_ar' => 'الدوحة', 'name_en' => 'Doha'],
                    ['name_ar' => 'الوكرة', 'name_en' => 'Al Wakrah'],
                    ['name_ar' => 'الخور', 'name_en' => 'Al Khor'],
                    ['name_ar' => 'الريان', 'name_en' => 'Al Rayyan'],
                    ['name_ar' => 'أم صلال', 'name_en' => 'Umm Salal'],
                    ['name_ar' => 'الشمال', 'name_en' => 'Al Shamal'],
                ],
            ],
            [
                'name_ar' => 'البحرين',
                'name_en' => 'Bahrain',
                'code' => 'BH',
                'cities' => [
                    ['name_ar' => 'المنامة', 'name_en' => 'Manama'],
                    ['name_ar' => 'المحرق', 'name_en' => 'Muharraq'],
                    ['name_ar' => 'الرفاع', 'name_en' => 'Riffa'],
                    ['name_ar' => 'مدينة عيسى', 'name_en' => 'Isa Town'],
                    ['name_ar' => 'مدينة حمد', 'name_en' => 'Hamad Town'],
                    ['name_ar' => 'سترة', 'name_en' => 'Sitra'],
                ],
            ],
            [
                'name_ar' => 'عمان',
                'name_en' => 'Oman',
                'code' => 'OM',
                'cities' => [
                    ['name_ar' => 'مسقط', 'name_en' => 'Muscat'],
                    ['name_ar' => 'صلالة', 'name_en' => 'Salalah'],
                    ['name_ar' => 'صحار', 'name_en' => 'Sohar'],
                    ['name_ar' => 'نزوى', 'name_en' => 'Nizwa'],
                    ['name_ar' => 'صور', 'name_en' => 'Sur'],
                    ['name_ar' => 'البريمي', 'name_en' => 'Buraimi'],
                    ['name_ar' => 'عبري', 'name_en' => 'Ibri'],
                    ['name_ar' => 'الرستاق', 'name_en' => 'Rustaq'],
                ],
            ],
            [
                'name_ar' => 'لبنان',
                'name_en' => 'Lebanon',
                'code' => 'LB',
                'cities' => [
                    ['name_ar' => 'بيروت', 'name_en' => 'Beirut'],
                    ['name_ar' => 'طرابلس', 'name_en' => 'Tripoli'],
                    ['name_ar' => 'صيدا', 'name_en' => 'Sidon'],
                    ['name_ar' => 'صور', 'name_en' => 'Tyre'],
                    ['name_ar' => 'جونية', 'name_en' => 'Jounieh'],
                    ['name_ar' => 'زحلة', 'name_en' => 'Zahle'],
                    ['name_ar' => 'بعلبك', 'name_en' => 'Baalbek'],
                    ['name_ar' => 'النبطية', 'name_en' => 'Nabatieh'],
                ],
            ],
            [
                'name_ar' => 'سوريا',
                'name_en' => 'Syria',
                'code' => 'SY',
                'cities' => [
                    ['name_ar' => 'دمشق', 'name_en' => 'Damascus'],
                    ['name_ar' => 'حلب', 'name_en' => 'Aleppo'],
                    ['name_ar' => 'حمص', 'name_en' => 'Homs'],
                    ['name_ar' => 'اللاذقية', 'name_en' => 'Latakia'],
                    ['name_ar' => 'حماة', 'name_en' => 'Hama'],
                    ['name_ar' => 'طرطوس', 'name_en' => 'Tartus'],
                    ['name_ar' => 'دير الزور', 'name_en' => 'Deir ez-Zor'],
                    ['name_ar' => 'الرقة', 'name_en' => 'Raqqa'],
                    ['name_ar' => 'إدلب', 'name_en' => 'Idlib'],
                ],
            ],
            [
                'name_ar' => 'العراق',
                'name_en' => 'Iraq',
                'code' => 'IQ',
                'cities' => [
                    ['name_ar' => 'بغداد', 'name_en' => 'Baghdad'],
                    ['name_ar' => 'البصرة', 'name_en' => 'Basra'],
                    ['name_ar' => 'الموصل', 'name_en' => 'Mosul'],
                    ['name_ar' => 'أربيل', 'name_en' => 'Erbil'],
                    ['name_ar' => 'كركوك', 'name_en' => 'Kirkuk'],
                    ['name_ar' => 'النجف', 'name_en' => 'Najaf'],
                    ['name_ar' => 'كربلاء', 'name_en' => 'Karbala'],
                    ['name_ar' => 'السليمانية', 'name_en' => 'Sulaymaniyah'],
                    ['name_ar' => 'الناصرية', 'name_en' => 'Nasiriyah'],
                    ['name_ar' => 'الحلة', 'name_en' => 'Hillah'],
                ],
            ],
            [
                'name_ar' => 'مصر',
                'name_en' => 'Egypt',
                'code' => 'EG',
                'cities' => [
                    ['name_ar' => 'القاهرة', 'name_en' => 'Cairo'],
                    ['name_ar' => 'الإسكندرية', 'name_en' => 'Alexandria'],
                    ['name_ar' => 'الجيزة', 'name_en' => 'Giza'],
                    ['name_ar' => 'شرم الشيخ', 'name_en' => 'Sharm El Sheikh'],
                    ['name_ar' => 'الأقصر', 'name_en' => 'Luxor'],
                    ['name_ar' => 'أسوان', 'name_en' => 'Aswan'],
                    ['name_ar' => 'بورسعيد', 'name_en' => 'Port Said'],
                    ['name_ar' => 'السويس', 'name_en' => 'Suez'],
                    ['name_ar' => 'المنصورة', 'name_en' => 'Mansoura'],
                    ['name_ar' => 'طنطا', 'name_en' => 'Tanta'],
                    ['name_ar' => 'الزقازيق', 'name_en' => 'Zagazig'],
                    ['name_ar' => 'أسيوط', 'name_en' => 'Asyut'],
                    ['name_ar' => 'الفيوم', 'name_en' => 'Fayoum'],
                    ['name_ar' => 'دمياط', 'name_en' => 'Damietta'],
                    ['name_ar' => 'الإسماعيلية', 'name_en' => 'Ismailia'],
                ],
            ],
            [
                'name_ar' => 'فلسطين',
                'name_en' => 'Palestine',
                'code' => 'PS',
                'cities' => [
                    ['name_ar' => 'القدس', 'name_en' => 'Jerusalem'],
                    ['name_ar' => 'غزة', 'name_en' => 'Gaza'],
                    ['name_ar' => 'رام الله', 'name_en' => 'Ramallah'],
                    ['name_ar' => 'نابلس', 'name_en' => 'Nablus'],
                    ['name_ar' => 'الخليل', 'name_en' => 'Hebron'],
                    ['name_ar' => 'بيت لحم', 'name_en' => 'Bethlehem'],
                    ['name_ar' => 'جنين', 'name_en' => 'Jenin'],
                    ['name_ar' => 'طولكرم', 'name_en' => 'Tulkarm'],
                    ['name_ar' => 'قلقيلية', 'name_en' => 'Qalqilya'],
                    ['name_ar' => 'أريحا', 'name_en' => 'Jericho'],
                ],
            ],
            [
                'name_ar' => 'اليمن',
                'name_en' => 'Yemen',
                'code' => 'YE',
                'cities' => [
                    ['name_ar' => 'صنعاء', 'name_en' => 'Sanaa'],
                    ['name_ar' => 'عدن', 'name_en' => 'Aden'],
                    ['name_ar' => 'تعز', 'name_en' => 'Taiz'],
                    ['name_ar' => 'الحديدة', 'name_en' => 'Hodeidah'],
                    ['name_ar' => 'المكلا', 'name_en' => 'Mukalla'],
                    ['name_ar' => 'إب', 'name_en' => 'Ibb'],
                    ['name_ar' => 'ذمار', 'name_en' => 'Dhamar'],
                    ['name_ar' => 'سيئون', 'name_en' => 'Sayun'],
                ],
            ],
            [
                'name_ar' => 'ليبيا',
                'name_en' => 'Libya',
                'code' => 'LY',
                'cities' => [
                    ['name_ar' => 'طرابلس', 'name_en' => 'Tripoli'],
                    ['name_ar' => 'بنغازي', 'name_en' => 'Benghazi'],
                    ['name_ar' => 'مصراتة', 'name_en' => 'Misrata'],
                    ['name_ar' => 'البيضاء', 'name_en' => 'Bayda'],
                    ['name_ar' => 'الزاوية', 'name_en' => 'Zawiya'],
                    ['name_ar' => 'طبرق', 'name_en' => 'Tobruk'],
                    ['name_ar' => 'سبها', 'name_en' => 'Sabha'],
                ],
            ],
            [
                'name_ar' => 'تونس',
                'name_en' => 'Tunisia',
                'code' => 'TN',
                'cities' => [
                    ['name_ar' => 'تونس', 'name_en' => 'Tunis'],
                    ['name_ar' => 'صفاقس', 'name_en' => 'Sfax'],
                    ['name_ar' => 'سوسة', 'name_en' => 'Sousse'],
                    ['name_ar' => 'القيروان', 'name_en' => 'Kairouan'],
                    ['name_ar' => 'بنزرت', 'name_en' => 'Bizerte'],
                    ['name_ar' => 'قابس', 'name_en' => 'Gabes'],
                    ['name_ar' => 'المنستير', 'name_en' => 'Monastir'],
                    ['name_ar' => 'نابل', 'name_en' => 'Nabeul'],
                ],
            ],
            [
                'name_ar' => 'الجزائر',
                'name_en' => 'Algeria',
                'code' => 'DZ',
                'cities' => [
                    ['name_ar' => 'الجزائر', 'name_en' => 'Algiers'],
                    ['name_ar' => 'وهران', 'name_en' => 'Oran'],
                    ['name_ar' => 'قسنطينة', 'name_en' => 'Constantine'],
                    ['name_ar' => 'عنابة', 'name_en' => 'Annaba'],
                    ['name_ar' => 'باتنة', 'name_en' => 'Batna'],
                    ['name_ar' => 'سطيف', 'name_en' => 'Setif'],
                    ['name_ar' => 'بجاية', 'name_en' => 'Bejaia'],
                    ['name_ar' => 'تلمسان', 'name_en' => 'Tlemcen'],
                    ['name_ar' => 'البليدة', 'name_en' => 'Blida'],
                    ['name_ar' => 'سكيكدة', 'name_en' => 'Skikda'],
                ],
            ],
            [
                'name_ar' => 'المغرب',
                'name_en' => 'Morocco',
                'code' => 'MA',
                'cities' => [
                    ['name_ar' => 'الرباط', 'name_en' => 'Rabat'],
                    ['name_ar' => 'الدار البيضاء', 'name_en' => 'Casablanca'],
                    ['name_ar' => 'فاس', 'name_en' => 'Fes'],
                    ['name_ar' => 'مراكش', 'name_en' => 'Marrakech'],
                    ['name_ar' => 'طنجة', 'name_en' => 'Tangier'],
                    ['name_ar' => 'أكادير', 'name_en' => 'Agadir'],
                    ['name_ar' => 'مكناس', 'name_en' => 'Meknes'],
                    ['name_ar' => 'وجدة', 'name_en' => 'Oujda'],
                    ['name_ar' => 'القنيطرة', 'name_en' => 'Kenitra'],
                    ['name_ar' => 'تطوان', 'name_en' => 'Tetouan'],
                ],
            ],
            [
                'name_ar' => 'موريتانيا',
                'name_en' => 'Mauritania',
                'code' => 'MR',
                'cities' => [
                    ['name_ar' => 'نواكشوط', 'name_en' => 'Nouakchott'],
                    ['name_ar' => 'نواذيبو', 'name_en' => 'Nouadhibou'],
                    ['name_ar' => 'كيفة', 'name_en' => 'Kiffa'],
                    ['name_ar' => 'روصو', 'name_en' => 'Rosso'],
                    ['name_ar' => 'أطار', 'name_en' => 'Atar'],
                ],
            ],
            [
                'name_ar' => 'السودان',
                'name_en' => 'Sudan',
                'code' => 'SD',
                'cities' => [
                    ['name_ar' => 'الخرطوم', 'name_en' => 'Khartoum'],
                    ['name_ar' => 'أم درمان', 'name_en' => 'Omdurman'],
                    ['name_ar' => 'بورتسودان', 'name_en' => 'Port Sudan'],
                    ['name_ar' => 'كسلا', 'name_en' => 'Kassala'],
                    ['name_ar' => 'الأبيض', 'name_en' => 'El Obeid'],
                    ['name_ar' => 'ود مدني', 'name_en' => 'Wad Madani'],
                    ['name_ar' => 'عطبرة', 'name_en' => 'Atbara'],
                ],
            ],
            [
                'name_ar' => 'الصومال',
                'name_en' => 'Somalia',
                'code' => 'SO',
                'cities' => [
                    ['name_ar' => 'مقديشو', 'name_en' => 'Mogadishu'],
                    ['name_ar' => 'هرجيسا', 'name_en' => 'Hargeisa'],
                    ['name_ar' => 'كيسمايو', 'name_en' => 'Kismayo'],
                    ['name_ar' => 'بوصاصو', 'name_en' => 'Bosaso'],
                    ['name_ar' => 'بربرة', 'name_en' => 'Berbera'],
                ],
            ],
            [
                'name_ar' => 'جيبوتي',
                'name_en' => 'Djibouti',
                'code' => 'DJ',
                'cities' => [
                    ['name_ar' => 'جيبوتي', 'name_en' => 'Djibouti City'],
                    ['name_ar' => 'علي صبيح', 'name_en' => 'Ali Sabieh'],
                    ['name_ar' => 'تاجورة', 'name_en' => 'Tadjoura'],
                    ['name_ar' => 'أوبوك', 'name_en' => 'Obock'],
                ],
            ],
            [
                'name_ar' => 'جزر القمر',
                'name_en' => 'Comoros',
                'code' => 'KM',
                'cities' => [
                    ['name_ar' => 'موروني', 'name_en' => 'Moroni'],
                    ['name_ar' => 'موتسامودو', 'name_en' => 'Mutsamudu'],
                    ['name_ar' => 'فومبوني', 'name_en' => 'Fomboni'],
                ],
            ],
        ];

        foreach ($arabCountries as $countryData) {
            $cities = $countryData['cities'];
            unset($countryData['cities']);

            $country = Country::updateOrCreate(
                ['code' => $countryData['code']],
                $countryData
            );

            foreach ($cities as $cityData) {
                City::updateOrCreate(
                    [
                        'country_id' => $country->id,
                        'name_en' => $cityData['name_en']
                    ],
                    [
                        'name_ar' => $cityData['name_ar'],
                        'name_en' => $cityData['name_en'],
                        'country_id' => $country->id,
                    ]
                );
            }
        }
    }
}
