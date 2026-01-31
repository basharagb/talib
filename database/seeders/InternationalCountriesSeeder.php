<?php

/**
 * International Countries and Cities Seeder.
 *
 * This seeder populates the database with USA, Canada, Russia,
 * and European countries with their major cities.
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
 * InternationalCountriesSeeder Class.
 *
 * Seeds international countries with their cities.
 *
 * @category Database
 * @package  Talib
 * @author   Talib Platform <info@talib.com>
 * @license  MIT License
 * @link     https://talib.com
 */
class InternationalCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $countries = [
            // North America
            [
                'name_ar' => 'الولايات المتحدة',
                'name_en' => 'United States',
                'code' => 'US',
                'cities' => [
                    ['name_ar' => 'نيويورك', 'name_en' => 'New York'],
                    ['name_ar' => 'لوس أنجلوس', 'name_en' => 'Los Angeles'],
                    ['name_ar' => 'شيكاغو', 'name_en' => 'Chicago'],
                    ['name_ar' => 'هيوستن', 'name_en' => 'Houston'],
                    ['name_ar' => 'فينيكس', 'name_en' => 'Phoenix'],
                    ['name_ar' => 'فيلادلفيا', 'name_en' => 'Philadelphia'],
                    ['name_ar' => 'سان أنطونيو', 'name_en' => 'San Antonio'],
                    ['name_ar' => 'سان دييغو', 'name_en' => 'San Diego'],
                    ['name_ar' => 'دالاس', 'name_en' => 'Dallas'],
                    ['name_ar' => 'سان خوسيه', 'name_en' => 'San Jose'],
                    ['name_ar' => 'أوستن', 'name_en' => 'Austin'],
                    ['name_ar' => 'جاكسونفيل', 'name_en' => 'Jacksonville'],
                    ['name_ar' => 'سان فرانسيسكو', 'name_en' => 'San Francisco'],
                    ['name_ar' => 'كولومبوس', 'name_en' => 'Columbus'],
                    ['name_ar' => 'إنديانابوليس', 'name_en' => 'Indianapolis'],
                    ['name_ar' => 'فورت وورث', 'name_en' => 'Fort Worth'],
                    ['name_ar' => 'شارلوت', 'name_en' => 'Charlotte'],
                    ['name_ar' => 'سياتل', 'name_en' => 'Seattle'],
                    ['name_ar' => 'دنفر', 'name_en' => 'Denver'],
                    ['name_ar' => 'واشنطن', 'name_en' => 'Washington DC'],
                    ['name_ar' => 'بوسطن', 'name_en' => 'Boston'],
                    ['name_ar' => 'ديترويت', 'name_en' => 'Detroit'],
                    ['name_ar' => 'ناشفيل', 'name_en' => 'Nashville'],
                    ['name_ar' => 'ممفيس', 'name_en' => 'Memphis'],
                    ['name_ar' => 'بورتلاند', 'name_en' => 'Portland'],
                    ['name_ar' => 'لاس فيغاس', 'name_en' => 'Las Vegas'],
                    ['name_ar' => 'ميامي', 'name_en' => 'Miami'],
                    ['name_ar' => 'أتلانتا', 'name_en' => 'Atlanta'],
                ],
            ],
            [
                'name_ar' => 'كندا',
                'name_en' => 'Canada',
                'code' => 'CA',
                'cities' => [
                    ['name_ar' => 'تورونتو', 'name_en' => 'Toronto'],
                    ['name_ar' => 'مونتريال', 'name_en' => 'Montreal'],
                    ['name_ar' => 'فانكوفر', 'name_en' => 'Vancouver'],
                    ['name_ar' => 'كالغاري', 'name_en' => 'Calgary'],
                    ['name_ar' => 'إدمونتون', 'name_en' => 'Edmonton'],
                    ['name_ar' => 'أوتاوا', 'name_en' => 'Ottawa'],
                    ['name_ar' => 'وينيبيغ', 'name_en' => 'Winnipeg'],
                    ['name_ar' => 'كيبيك', 'name_en' => 'Quebec City'],
                    ['name_ar' => 'هاميلتون', 'name_en' => 'Hamilton'],
                    ['name_ar' => 'كيتشنر', 'name_en' => 'Kitchener'],
                    ['name_ar' => 'لندن', 'name_en' => 'London'],
                    ['name_ar' => 'فيكتوريا', 'name_en' => 'Victoria'],
                    ['name_ar' => 'هاليفاكس', 'name_en' => 'Halifax'],
                    ['name_ar' => 'ساسكاتون', 'name_en' => 'Saskatoon'],
                    ['name_ar' => 'ريجاينا', 'name_en' => 'Regina'],
                ],
            ],
            // Russia
            [
                'name_ar' => 'روسيا',
                'name_en' => 'Russia',
                'code' => 'RU',
                'cities' => [
                    ['name_ar' => 'موسكو', 'name_en' => 'Moscow'],
                    ['name_ar' => 'سانت بطرسبرغ', 'name_en' => 'Saint Petersburg'],
                    ['name_ar' => 'نوفوسيبيرسك', 'name_en' => 'Novosibirsk'],
                    ['name_ar' => 'يكاترينبورغ', 'name_en' => 'Yekaterinburg'],
                    ['name_ar' => 'نيجني نوفغورود', 'name_en' => 'Nizhny Novgorod'],
                    ['name_ar' => 'قازان', 'name_en' => 'Kazan'],
                    ['name_ar' => 'تشيليابينسك', 'name_en' => 'Chelyabinsk'],
                    ['name_ar' => 'أومسك', 'name_en' => 'Omsk'],
                    ['name_ar' => 'سامارا', 'name_en' => 'Samara'],
                    ['name_ar' => 'روستوف على الدون', 'name_en' => 'Rostov-on-Don'],
                    ['name_ar' => 'أوفا', 'name_en' => 'Ufa'],
                    ['name_ar' => 'كراسنويارسك', 'name_en' => 'Krasnoyarsk'],
                    ['name_ar' => 'فورونيج', 'name_en' => 'Voronezh'],
                    ['name_ar' => 'بيرم', 'name_en' => 'Perm'],
                    ['name_ar' => 'فولغوغراد', 'name_en' => 'Volgograd'],
                ],
            ],
            // Western Europe
            [
                'name_ar' => 'المملكة المتحدة',
                'name_en' => 'United Kingdom',
                'code' => 'GB',
                'cities' => [
                    ['name_ar' => 'لندن', 'name_en' => 'London'],
                    ['name_ar' => 'برمنغهام', 'name_en' => 'Birmingham'],
                    ['name_ar' => 'مانشستر', 'name_en' => 'Manchester'],
                    ['name_ar' => 'ليدز', 'name_en' => 'Leeds'],
                    ['name_ar' => 'غلاسكو', 'name_en' => 'Glasgow'],
                    ['name_ar' => 'ليفربول', 'name_en' => 'Liverpool'],
                    ['name_ar' => 'إدنبرة', 'name_en' => 'Edinburgh'],
                    ['name_ar' => 'بريستول', 'name_en' => 'Bristol'],
                    ['name_ar' => 'كارديف', 'name_en' => 'Cardiff'],
                    ['name_ar' => 'بلفاست', 'name_en' => 'Belfast'],
                    ['name_ar' => 'نيوكاسل', 'name_en' => 'Newcastle'],
                    ['name_ar' => 'شيفيلد', 'name_en' => 'Sheffield'],
                    ['name_ar' => 'نوتنغهام', 'name_en' => 'Nottingham'],
                    ['name_ar' => 'ليستر', 'name_en' => 'Leicester'],
                ],
            ],
            [
                'name_ar' => 'فرنسا',
                'name_en' => 'France',
                'code' => 'FR',
                'cities' => [
                    ['name_ar' => 'باريس', 'name_en' => 'Paris'],
                    ['name_ar' => 'مرسيليا', 'name_en' => 'Marseille'],
                    ['name_ar' => 'ليون', 'name_en' => 'Lyon'],
                    ['name_ar' => 'تولوز', 'name_en' => 'Toulouse'],
                    ['name_ar' => 'نيس', 'name_en' => 'Nice'],
                    ['name_ar' => 'نانت', 'name_en' => 'Nantes'],
                    ['name_ar' => 'ستراسبورغ', 'name_en' => 'Strasbourg'],
                    ['name_ar' => 'مونبلييه', 'name_en' => 'Montpellier'],
                    ['name_ar' => 'بوردو', 'name_en' => 'Bordeaux'],
                    ['name_ar' => 'ليل', 'name_en' => 'Lille'],
                    ['name_ar' => 'رين', 'name_en' => 'Rennes'],
                    ['name_ar' => 'رينس', 'name_en' => 'Reims'],
                    ['name_ar' => 'تولون', 'name_en' => 'Toulon'],
                ],
            ],
            [
                'name_ar' => 'ألمانيا',
                'name_en' => 'Germany',
                'code' => 'DE',
                'cities' => [
                    ['name_ar' => 'برلين', 'name_en' => 'Berlin'],
                    ['name_ar' => 'هامبورغ', 'name_en' => 'Hamburg'],
                    ['name_ar' => 'ميونخ', 'name_en' => 'Munich'],
                    ['name_ar' => 'كولونيا', 'name_en' => 'Cologne'],
                    ['name_ar' => 'فرانكفورت', 'name_en' => 'Frankfurt'],
                    ['name_ar' => 'شتوتغارت', 'name_en' => 'Stuttgart'],
                    ['name_ar' => 'دوسلدورف', 'name_en' => 'Dusseldorf'],
                    ['name_ar' => 'دورتموند', 'name_en' => 'Dortmund'],
                    ['name_ar' => 'إيسن', 'name_en' => 'Essen'],
                    ['name_ar' => 'لايبزيغ', 'name_en' => 'Leipzig'],
                    ['name_ar' => 'بريمن', 'name_en' => 'Bremen'],
                    ['name_ar' => 'دريسدن', 'name_en' => 'Dresden'],
                    ['name_ar' => 'هانوفر', 'name_en' => 'Hanover'],
                    ['name_ar' => 'نورنبرغ', 'name_en' => 'Nuremberg'],
                ],
            ],
            [
                'name_ar' => 'إيطاليا',
                'name_en' => 'Italy',
                'code' => 'IT',
                'cities' => [
                    ['name_ar' => 'روما', 'name_en' => 'Rome'],
                    ['name_ar' => 'ميلانو', 'name_en' => 'Milan'],
                    ['name_ar' => 'نابولي', 'name_en' => 'Naples'],
                    ['name_ar' => 'تورينو', 'name_en' => 'Turin'],
                    ['name_ar' => 'باليرمو', 'name_en' => 'Palermo'],
                    ['name_ar' => 'جنوة', 'name_en' => 'Genoa'],
                    ['name_ar' => 'بولونيا', 'name_en' => 'Bologna'],
                    ['name_ar' => 'فلورنسا', 'name_en' => 'Florence'],
                    ['name_ar' => 'باري', 'name_en' => 'Bari'],
                    ['name_ar' => 'كاتانيا', 'name_en' => 'Catania'],
                    ['name_ar' => 'فيرونا', 'name_en' => 'Verona'],
                    ['name_ar' => 'فينيسيا', 'name_en' => 'Venice'],
                    ['name_ar' => 'ميسينا', 'name_en' => 'Messina'],
                ],
            ],
            [
                'name_ar' => 'إسبانيا',
                'name_en' => 'Spain',
                'code' => 'ES',
                'cities' => [
                    ['name_ar' => 'مدريد', 'name_en' => 'Madrid'],
                    ['name_ar' => 'برشلونة', 'name_en' => 'Barcelona'],
                    ['name_ar' => 'فالنسيا', 'name_en' => 'Valencia'],
                    ['name_ar' => 'إشبيلية', 'name_en' => 'Seville'],
                    ['name_ar' => 'سرقسطة', 'name_en' => 'Zaragoza'],
                    ['name_ar' => 'ملقة', 'name_en' => 'Malaga'],
                    ['name_ar' => 'مورسيا', 'name_en' => 'Murcia'],
                    ['name_ar' => 'بلباو', 'name_en' => 'Bilbao'],
                    ['name_ar' => 'غرناطة', 'name_en' => 'Granada'],
                    ['name_ar' => 'أليكانتي', 'name_en' => 'Alicante'],
                    ['name_ar' => 'قرطبة', 'name_en' => 'Cordoba'],
                    ['name_ar' => 'بلد الوليد', 'name_en' => 'Valladolid'],
                ],
            ],
            // Northern Europe
            [
                'name_ar' => 'السويد',
                'name_en' => 'Sweden',
                'code' => 'SE',
                'cities' => [
                    ['name_ar' => 'ستوكهولم', 'name_en' => 'Stockholm'],
                    ['name_ar' => 'غوتنبرغ', 'name_en' => 'Gothenburg'],
                    ['name_ar' => 'مالمو', 'name_en' => 'Malmo'],
                    ['name_ar' => 'أوبسالا', 'name_en' => 'Uppsala'],
                    ['name_ar' => 'لينشوبينغ', 'name_en' => 'Linkoping'],
                    ['name_ar' => 'أوريبرو', 'name_en' => 'Orebro'],
                ],
            ],
            [
                'name_ar' => 'النرويج',
                'name_en' => 'Norway',
                'code' => 'NO',
                'cities' => [
                    ['name_ar' => 'أوسلو', 'name_en' => 'Oslo'],
                    ['name_ar' => 'بيرغن', 'name_en' => 'Bergen'],
                    ['name_ar' => 'تروندهايم', 'name_en' => 'Trondheim'],
                    ['name_ar' => 'ستافنجر', 'name_en' => 'Stavanger'],
                    ['name_ar' => 'كريستيانساند', 'name_en' => 'Kristiansand'],
                ],
            ],
            [
                'name_ar' => 'الدنمارك',
                'name_en' => 'Denmark',
                'code' => 'DK',
                'cities' => [
                    ['name_ar' => 'كوبنهاغن', 'name_en' => 'Copenhagen'],
                    ['name_ar' => 'آرهوس', 'name_en' => 'Aarhus'],
                    ['name_ar' => 'أودنسه', 'name_en' => 'Odense'],
                    ['name_ar' => 'آلبورغ', 'name_en' => 'Aalborg'],
                    ['name_ar' => 'إسبيرغ', 'name_en' => 'Esbjerg'],
                ],
            ],
            [
                'name_ar' => 'فنلندا',
                'name_en' => 'Finland',
                'code' => 'FI',
                'cities' => [
                    ['name_ar' => 'هلسنكي', 'name_en' => 'Helsinki'],
                    ['name_ar' => 'إسبو', 'name_en' => 'Espoo'],
                    ['name_ar' => 'تامبيري', 'name_en' => 'Tampere'],
                    ['name_ar' => 'فانتا', 'name_en' => 'Vantaa'],
                    ['name_ar' => 'أولو', 'name_en' => 'Oulu'],
                    ['name_ar' => 'توركو', 'name_en' => 'Turku'],
                ],
            ],
            // Eastern Europe
            [
                'name_ar' => 'بولندا',
                'name_en' => 'Poland',
                'code' => 'PL',
                'cities' => [
                    ['name_ar' => 'وارسو', 'name_en' => 'Warsaw'],
                    ['name_ar' => 'كراكوف', 'name_en' => 'Krakow'],
                    ['name_ar' => 'لودز', 'name_en' => 'Lodz'],
                    ['name_ar' => 'فروتسواف', 'name_en' => 'Wroclaw'],
                    ['name_ar' => 'بوزنان', 'name_en' => 'Poznan'],
                    ['name_ar' => 'غدانسك', 'name_en' => 'Gdansk'],
                    ['name_ar' => 'شتشيتسين', 'name_en' => 'Szczecin'],
                ],
            ],
            [
                'name_ar' => 'أوكرانيا',
                'name_en' => 'Ukraine',
                'code' => 'UA',
                'cities' => [
                    ['name_ar' => 'كييف', 'name_en' => 'Kyiv'],
                    ['name_ar' => 'خاركيف', 'name_en' => 'Kharkiv'],
                    ['name_ar' => 'أوديسا', 'name_en' => 'Odesa'],
                    ['name_ar' => 'دنيبرو', 'name_en' => 'Dnipro'],
                    ['name_ar' => 'دونيتسك', 'name_en' => 'Donetsk'],
                    ['name_ar' => 'لفيف', 'name_en' => 'Lviv'],
                ],
            ],
            [
                'name_ar' => 'رومانيا',
                'name_en' => 'Romania',
                'code' => 'RO',
                'cities' => [
                    ['name_ar' => 'بوخارست', 'name_en' => 'Bucharest'],
                    ['name_ar' => 'كلوج نابوكا', 'name_en' => 'Cluj-Napoca'],
                    ['name_ar' => 'تيميشوارا', 'name_en' => 'Timisoara'],
                    ['name_ar' => 'ياش', 'name_en' => 'Iasi'],
                    ['name_ar' => 'كونستانتا', 'name_en' => 'Constanta'],
                    ['name_ar' => 'كرايوفا', 'name_en' => 'Craiova'],
                ],
            ],
            [
                'name_ar' => 'التشيك',
                'name_en' => 'Czech Republic',
                'code' => 'CZ',
                'cities' => [
                    ['name_ar' => 'براغ', 'name_en' => 'Prague'],
                    ['name_ar' => 'برنو', 'name_en' => 'Brno'],
                    ['name_ar' => 'أوسترافا', 'name_en' => 'Ostrava'],
                    ['name_ar' => 'بلزن', 'name_en' => 'Plzen'],
                    ['name_ar' => 'ليبيريتس', 'name_en' => 'Liberec'],
                ],
            ],
            [
                'name_ar' => 'المجر',
                'name_en' => 'Hungary',
                'code' => 'HU',
                'cities' => [
                    ['name_ar' => 'بودابست', 'name_en' => 'Budapest'],
                    ['name_ar' => 'ديبريتسن', 'name_en' => 'Debrecen'],
                    ['name_ar' => 'سيجد', 'name_en' => 'Szeged'],
                    ['name_ar' => 'ميشكولتس', 'name_en' => 'Miskolc'],
                    ['name_ar' => 'بيتش', 'name_en' => 'Pecs'],
                ],
            ],
            // Southern Europe
            [
                'name_ar' => 'اليونان',
                'name_en' => 'Greece',
                'code' => 'GR',
                'cities' => [
                    ['name_ar' => 'أثينا', 'name_en' => 'Athens'],
                    ['name_ar' => 'سالونيك', 'name_en' => 'Thessaloniki'],
                    ['name_ar' => 'باتراس', 'name_en' => 'Patras'],
                    ['name_ar' => 'هيراكليون', 'name_en' => 'Heraklion'],
                    ['name_ar' => 'لاريسا', 'name_en' => 'Larissa'],
                ],
            ],
            [
                'name_ar' => 'البرتغال',
                'name_en' => 'Portugal',
                'code' => 'PT',
                'cities' => [
                    ['name_ar' => 'لشبونة', 'name_en' => 'Lisbon'],
                    ['name_ar' => 'بورتو', 'name_en' => 'Porto'],
                    ['name_ar' => 'براغا', 'name_en' => 'Braga'],
                    ['name_ar' => 'كويمبرا', 'name_en' => 'Coimbra'],
                    ['name_ar' => 'فونشال', 'name_en' => 'Funchal'],
                ],
            ],
            // Other European Countries
            [
                'name_ar' => 'هولندا',
                'name_en' => 'Netherlands',
                'code' => 'NL',
                'cities' => [
                    ['name_ar' => 'أمستردام', 'name_en' => 'Amsterdam'],
                    ['name_ar' => 'روتردام', 'name_en' => 'Rotterdam'],
                    ['name_ar' => 'لاهاي', 'name_en' => 'The Hague'],
                    ['name_ar' => 'أوترخت', 'name_en' => 'Utrecht'],
                    ['name_ar' => 'آيندهوفن', 'name_en' => 'Eindhoven'],
                ],
            ],
            [
                'name_ar' => 'بلجيكا',
                'name_en' => 'Belgium',
                'code' => 'BE',
                'cities' => [
                    ['name_ar' => 'بروكسل', 'name_en' => 'Brussels'],
                    ['name_ar' => 'أنتويرب', 'name_en' => 'Antwerp'],
                    ['name_ar' => 'غنت', 'name_en' => 'Ghent'],
                    ['name_ar' => 'شارلروا', 'name_en' => 'Charleroi'],
                    ['name_ar' => 'لييج', 'name_en' => 'Liege'],
                    ['name_ar' => 'بروج', 'name_en' => 'Bruges'],
                ],
            ],
            [
                'name_ar' => 'سويسرا',
                'name_en' => 'Switzerland',
                'code' => 'CH',
                'cities' => [
                    ['name_ar' => 'زيورخ', 'name_en' => 'Zurich'],
                    ['name_ar' => 'جنيف', 'name_en' => 'Geneva'],
                    ['name_ar' => 'بازل', 'name_en' => 'Basel'],
                    ['name_ar' => 'برن', 'name_en' => 'Bern'],
                    ['name_ar' => 'لوزان', 'name_en' => 'Lausanne'],
                    ['name_ar' => 'لوسيرن', 'name_en' => 'Lucerne'],
                ],
            ],
            [
                'name_ar' => 'النمسا',
                'name_en' => 'Austria',
                'code' => 'AT',
                'cities' => [
                    ['name_ar' => 'فيينا', 'name_en' => 'Vienna'],
                    ['name_ar' => 'غراتس', 'name_en' => 'Graz'],
                    ['name_ar' => 'لينتس', 'name_en' => 'Linz'],
                    ['name_ar' => 'سالزبورغ', 'name_en' => 'Salzburg'],
                    ['name_ar' => 'إنسبروك', 'name_en' => 'Innsbruck'],
                ],
            ],
            [
                'name_ar' => 'أيرلندا',
                'name_en' => 'Ireland',
                'code' => 'IE',
                'cities' => [
                    ['name_ar' => 'دبلن', 'name_en' => 'Dublin'],
                    ['name_ar' => 'كورك', 'name_en' => 'Cork'],
                    ['name_ar' => 'ليمريك', 'name_en' => 'Limerick'],
                    ['name_ar' => 'غالواي', 'name_en' => 'Galway'],
                    ['name_ar' => 'ووترفورد', 'name_en' => 'Waterford'],
                ],
            ],
        ];

        foreach ($countries as $countryData) {
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
