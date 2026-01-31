<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\EducationalCenter;
use App\Models\EducationalStage;
use App\Models\Grade;
use App\Models\Kindergarten;
use App\Models\Nursery;
use App\Models\School;
use App\Models\StudentType;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create cities for Jordan
        $jordan = Country::where('code', 'JO')->first();
        if (!$jordan) {
            $jordan = Country::create([
                'name_ar' => 'الأردن',
                'name_en' => 'Jordan',
                'code' => 'JO',
                'is_active' => true,
            ]);
        }

        $cities = [
            ['name_ar' => 'عمان', 'name_en' => 'Amman', 'country_id' => $jordan->id],
            ['name_ar' => 'إربد', 'name_en' => 'Irbid', 'country_id' => $jordan->id],
            ['name_ar' => 'الزرقاء', 'name_en' => 'Zarqa', 'country_id' => $jordan->id],
            ['name_ar' => 'العقبة', 'name_en' => 'Aqaba', 'country_id' => $jordan->id],
            ['name_ar' => 'السلط', 'name_en' => 'Salt', 'country_id' => $jordan->id],
        ];

        foreach ($cities as $cityData) {
            City::firstOrCreate(
                ['name_en' => $cityData['name_en'], 'country_id' => $cityData['country_id']],
                $cityData
            );
        }

        $amman = City::where('name_en', 'Amman')->first();
        $irbid = City::where('name_en', 'Irbid')->first();
        $zarqa = City::where('name_en', 'Zarqa')->first();

        // Create Subjects
        $subjects = [
            ['name_ar' => 'الرياضيات', 'name_en' => 'Mathematics'],
            ['name_ar' => 'اللغة العربية', 'name_en' => 'Arabic Language'],
            ['name_ar' => 'اللغة الإنجليزية', 'name_en' => 'English Language'],
            ['name_ar' => 'العلوم', 'name_en' => 'Science'],
            ['name_ar' => 'الفيزياء', 'name_en' => 'Physics'],
            ['name_ar' => 'الكيمياء', 'name_en' => 'Chemistry'],
            ['name_ar' => 'الأحياء', 'name_en' => 'Biology'],
            ['name_ar' => 'التاريخ', 'name_en' => 'History'],
            ['name_ar' => 'الجغرافيا', 'name_en' => 'Geography'],
            ['name_ar' => 'التربية الإسلامية', 'name_en' => 'Islamic Education'],
            ['name_ar' => 'الحاسوب', 'name_en' => 'Computer Science'],
            ['name_ar' => 'الفن', 'name_en' => 'Art'],
        ];

        foreach ($subjects as $subjectData) {
            Subject::firstOrCreate(
                ['name_en' => $subjectData['name_en']],
                $subjectData
            );
        }

        // Create Grades
        $grades = [
            // School grades
            ['name_ar' => 'الصف الأول', 'name_en' => 'Grade 1', 'level' => 1, 'type' => 'school'],
            ['name_ar' => 'الصف الثاني', 'name_en' => 'Grade 2', 'level' => 2, 'type' => 'school'],
            ['name_ar' => 'الصف الثالث', 'name_en' => 'Grade 3', 'level' => 3, 'type' => 'school'],
            ['name_ar' => 'الصف الرابع', 'name_en' => 'Grade 4', 'level' => 4, 'type' => 'school'],
            ['name_ar' => 'الصف الخامس', 'name_en' => 'Grade 5', 'level' => 5, 'type' => 'school'],
            ['name_ar' => 'الصف السادس', 'name_en' => 'Grade 6', 'level' => 6, 'type' => 'school'],
            ['name_ar' => 'الصف السابع', 'name_en' => 'Grade 7', 'level' => 7, 'type' => 'school'],
            ['name_ar' => 'الصف الثامن', 'name_en' => 'Grade 8', 'level' => 8, 'type' => 'school'],
            ['name_ar' => 'الصف التاسع', 'name_en' => 'Grade 9', 'level' => 9, 'type' => 'school'],
            ['name_ar' => 'الصف العاشر', 'name_en' => 'Grade 10', 'level' => 10, 'type' => 'school'],
            ['name_ar' => 'الصف الحادي عشر', 'name_en' => 'Grade 11', 'level' => 11, 'type' => 'school'],
            ['name_ar' => 'الصف الثاني عشر', 'name_en' => 'Grade 12', 'level' => 12, 'type' => 'school'],
            // Kindergarten grades
            ['name_ar' => 'KG1', 'name_en' => 'KG1', 'level' => 1, 'type' => 'kindergarten'],
            ['name_ar' => 'KG2', 'name_en' => 'KG2', 'level' => 2, 'type' => 'kindergarten'],
            ['name_ar' => 'تمهيدي', 'name_en' => 'Pre-K', 'level' => 0, 'type' => 'kindergarten'],
        ];

        foreach ($grades as $gradeData) {
            Grade::firstOrCreate(
                ['name_en' => $gradeData['name_en'], 'type' => $gradeData['type']],
                $gradeData
            );
        }

        // Create Demo Teachers
        $teachers = [
            [
                'name' => 'أحمد محمد الخطيب',
                'email' => 'ahmed.teacher@demo.com',
                'degree' => 'master',
                'gender' => 'male',
                'description' => 'معلم رياضيات ذو خبرة 10 سنوات في التدريس. متخصص في تبسيط المفاهيم الرياضية المعقدة.',
                'experience' => '10 سنوات خبرة في تدريس الرياضيات للمرحلة الثانوية',
                'district' => 'الصويفية',
                'city_id' => $amman->id,
            ],
            [
                'name' => 'فاطمة أحمد السعيد',
                'email' => 'fatima.teacher@demo.com',
                'degree' => 'bachelor',
                'gender' => 'female',
                'description' => 'معلمة لغة عربية متميزة. أساعد الطلاب على تحسين مهاراتهم في القراءة والكتابة.',
                'experience' => '7 سنوات في تدريس اللغة العربية',
                'district' => 'الجبيهة',
                'city_id' => $amman->id,
            ],
            [
                'name' => 'محمد علي الحسن',
                'email' => 'mohammad.teacher@demo.com',
                'degree' => 'phd',
                'gender' => 'male',
                'description' => 'دكتور في الفيزياء. أقدم دروس خصوصية للتوجيهي والجامعات.',
                'experience' => '15 سنة في التدريس الجامعي والخصوصي',
                'district' => 'الياسمين',
                'city_id' => $irbid->id,
            ],
            [
                'name' => 'سارة خالد العمري',
                'email' => 'sara.teacher@demo.com',
                'degree' => 'bachelor',
                'gender' => 'female',
                'description' => 'معلمة لغة إنجليزية. متخصصة في تحضير الطلاب لامتحانات IELTS و TOEFL.',
                'experience' => '5 سنوات في تدريس اللغة الإنجليزية',
                'district' => 'الرابية',
                'city_id' => $amman->id,
            ],
        ];

        $mathSubject = Subject::where('name_en', 'Mathematics')->first();
        $arabicSubject = Subject::where('name_en', 'Arabic Language')->first();
        $physicsSubject = Subject::where('name_en', 'Physics')->first();
        $englishSubject = Subject::where('name_en', 'English Language')->first();

        foreach ($teachers as $index => $teacherData) {
            $user = User::firstOrCreate(
                ['email' => $teacherData['email']],
                [
                    'name' => $teacherData['name'],
                    'email' => $teacherData['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'teacher',
                    'status' => 'active',
                    'phone' => '079' . rand(1000000, 9999999),
                ]
            );

            $teacher = Teacher::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'country_id' => $jordan->id,
                    'city_id' => $teacherData['city_id'],
                    'district' => $teacherData['district'],
                    'degree' => $teacherData['degree'],
                    'gender' => $teacherData['gender'],
                    'description' => $teacherData['description'],
                    'experience' => $teacherData['experience'],
                    'social_links' => json_encode([
                        'facebook' => 'https://facebook.com/teacher' . ($index + 1),
                        'whatsapp' => '079' . rand(1000000, 9999999),
                    ]),
                ]
            );

            // Attach subjects
            $subjectToAttach = match ($index) {
                0 => $mathSubject,
                1 => $arabicSubject,
                2 => $physicsSubject,
                3 => $englishSubject,
                default => $mathSubject,
            };

            if ($subjectToAttach && !$teacher->subjects()->where('subject_id', $subjectToAttach->id)->exists()) {
                $teacher->subjects()->attach($subjectToAttach->id);
            }
        }

        // Create Demo Educational Centers
        $centers = [
            [
                'name' => 'مركز النخبة التعليمي',
                'email' => 'elite.center@demo.com',
                'description' => 'مركز تعليمي متميز يقدم دورات في جميع المواد للمراحل الأساسية والثانوية. نستخدم أحدث الأساليب التعليمية.',
                'district' => 'الشميساني',
                'location' => 'شارع الملكة رانيا، بناية رقم 15',
                'city_id' => $amman->id,
            ],
            [
                'name' => 'أكاديمية المستقبل',
                'email' => 'future.academy@demo.com',
                'description' => 'أكاديمية متخصصة في تدريس اللغات والحاسوب. نقدم برامج تأهيلية للسوق العمل.',
                'district' => 'الجامعة',
                'location' => 'مقابل الجامعة الأردنية',
                'city_id' => $amman->id,
            ],
            [
                'name' => 'مركز الإبداع للتعليم',
                'email' => 'creative.center@demo.com',
                'description' => 'نركز على تنمية مهارات التفكير الإبداعي والنقدي لدى الطلاب.',
                'district' => 'الحي الشرقي',
                'location' => 'شارع الجامعة، إربد',
                'city_id' => $irbid->id,
            ],
        ];

        foreach ($centers as $index => $centerData) {
            $user = User::firstOrCreate(
                ['email' => $centerData['email']],
                [
                    'name' => $centerData['name'],
                    'email' => $centerData['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'educational_center',
                    'status' => 'active',
                    'phone' => '06' . rand(1000000, 9999999),
                ]
            );

            $center = EducationalCenter::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'country_id' => $jordan->id,
                    'city_id' => $centerData['city_id'],
                    'district' => $centerData['district'],
                    'location' => $centerData['location'],
                    'description' => $centerData['description'],
                    'social_links' => json_encode([
                        'facebook' => 'https://facebook.com/center' . ($index + 1),
                        'instagram' => 'https://instagram.com/center' . ($index + 1),
                    ]),
                ]
            );

            // Attach subjects
            $subjectsToAttach = Subject::inRandomOrder()->limit(4)->pluck('id')->toArray();
            $center->subjects()->syncWithoutDetaching($subjectsToAttach);
        }

        // Create Demo Schools
        $schools = [
            [
                'name' => 'مدرسة الرواد الخاصة',
                'email' => 'rawad.school@demo.com',
                'description' => 'مدرسة خاصة تقدم تعليماً متميزاً من الصف الأول حتى التوجيهي. نهتم بالتعليم الأكاديمي والأنشطة اللامنهجية.',
                'district' => 'خلدا',
                'location' => 'شارع الأمير حسن',
                'city_id' => $amman->id,
            ],
            [
                'name' => 'مدرسة النور الدولية',
                'email' => 'noor.school@demo.com',
                'description' => 'مدرسة دولية تتبع المنهاج البريطاني. بيئة تعليمية حديثة ومرافق متطورة.',
                'district' => 'عبدون',
                'location' => 'دوار عبدون',
                'city_id' => $amman->id,
            ],
            [
                'name' => 'مدرسة الأمل الخاصة',
                'email' => 'amal.school@demo.com',
                'description' => 'مدرسة خاصة للبنات تركز على التميز الأكاديمي والقيم الإسلامية.',
                'district' => 'الزرقاء الجديدة',
                'location' => 'شارع الملك عبدالله',
                'city_id' => $zarqa->id,
            ],
        ];

        // Create educational stages if they don't exist
        $elementary = EducationalStage::firstOrCreate(
            ['slug' => 'elementary'],
            ['name_ar' => 'ابتدائي', 'name_en' => 'Elementary', 'is_active' => true]
        );
        $basic = EducationalStage::firstOrCreate(
            ['slug' => 'basic'],
            ['name_ar' => 'أساسي', 'name_en' => 'Basic', 'is_active' => true]
        );
        $secondary = EducationalStage::firstOrCreate(
            ['slug' => 'secondary'],
            ['name_ar' => 'ثانوي', 'name_en' => 'Secondary', 'is_active' => true]
        );

        // Create student types if they don't exist
        $mixed = StudentType::firstOrCreate(
            ['slug' => 'mixed'],
            ['name_ar' => 'مختلط', 'name_en' => 'Mixed', 'is_active' => true]
        );
        $girls = StudentType::firstOrCreate(
            ['slug' => 'girls'],
            ['name_ar' => 'إناث', 'name_en' => 'Girls', 'is_active' => true]
        );

        foreach ($schools as $index => $schoolData) {
            $user = User::firstOrCreate(
                ['email' => $schoolData['email']],
                [
                    'name' => $schoolData['name'],
                    'email' => $schoolData['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'school',
                    'status' => 'active',
                    'phone' => '06' . rand(1000000, 9999999),
                ]
            );

            $school = School::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'country_id' => $jordan->id,
                    'city_id' => $schoolData['city_id'],
                    'district' => $schoolData['district'],
                    'location' => $schoolData['location'],
                    'description' => $schoolData['description'],
                ]
            );

            // Attach grades
            $gradesToAttach = Grade::where('type', 'school')->pluck('id')->toArray();
            $school->grades()->syncWithoutDetaching($gradesToAttach);

            // Attach educational stages and student types if columns exist
            if (method_exists($school, 'educationalStages')) {
                $school->educationalStages()->syncWithoutDetaching([$elementary->id, $basic->id, $secondary->id]);
            }
            if (method_exists($school, 'studentTypes')) {
                $studentType = $index === 2 ? $girls : $mixed;
                $school->studentTypes()->syncWithoutDetaching([$studentType->id]);
            }
        }

        // Create Demo Kindergartens
        $kindergartens = [
            [
                'name' => 'روضة براعم المستقبل',
                'email' => 'baraem.kg@demo.com',
                'description' => 'روضة أطفال متميزة تهتم بتنمية مهارات الطفل الإبداعية والاجتماعية في بيئة آمنة ومحفزة.',
                'phone' => '0791234567',
                'address' => 'شارع المدينة المنورة، عمان',
                'city_id' => $amman->id,
            ],
            [
                'name' => 'روضة الزهور',
                'email' => 'zohour.kg@demo.com',
                'description' => 'نقدم برامج تعليمية متطورة للأطفال من عمر 3-6 سنوات مع التركيز على اللغتين العربية والإنجليزية.',
                'phone' => '0797654321',
                'address' => 'الجبيهة، عمان',
                'city_id' => $amman->id,
            ],
            [
                'name' => 'روضة النجوم الصغيرة',
                'email' => 'stars.kg@demo.com',
                'description' => 'روضة حديثة بمرافق متطورة وكادر تعليمي مؤهل.',
                'phone' => '0781112233',
                'address' => 'إربد، الحي الشرقي',
                'city_id' => $irbid->id,
            ],
        ];

        foreach ($kindergartens as $kgData) {
            $user = User::firstOrCreate(
                ['email' => $kgData['email']],
                [
                    'name' => $kgData['name'],
                    'email' => $kgData['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'kindergarten',
                    'status' => 'active',
                    'phone' => $kgData['phone'],
                ]
            );

            Kindergarten::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'country_id' => $jordan->id,
                    'city_id' => $kgData['city_id'],
                    'name' => $kgData['name'],
                    'description' => $kgData['description'],
                    'phone' => $kgData['phone'],
                    'email' => $kgData['email'],
                    'address' => $kgData['address'],
                    'is_active' => true,
                ]
            );
        }

        // Create Demo Nurseries
        $nurseries = [
            [
                'name' => 'حضانة الأمان',
                'email' => 'aman.nursery@demo.com',
                'description' => 'حضانة متخصصة في رعاية الأطفال من عمر شهر إلى 4 سنوات. نوفر بيئة آمنة ورعاية متكاملة.',
                'phone' => '0791111111',
                'address' => 'تلاع العلي، عمان',
                'city_id' => $amman->id,
                'min_age_months' => 1,
                'max_age_months' => 48,
            ],
            [
                'name' => 'حضانة الحنان',
                'email' => 'hanan.nursery@demo.com',
                'description' => 'نقدم رعاية شاملة للأطفال مع برامج تنمية مبكرة ووجبات صحية.',
                'phone' => '0792222222',
                'address' => 'الصويفية، عمان',
                'city_id' => $amman->id,
                'min_age_months' => 3,
                'max_age_months' => 36,
            ],
            [
                'name' => 'حضانة السعادة',
                'email' => 'saada.nursery@demo.com',
                'description' => 'حضانة نهارية مع إمكانية الرعاية المسائية. كادر مؤهل ومرافق حديثة.',
                'phone' => '0793333333',
                'address' => 'الزرقاء، شارع الملك حسين',
                'city_id' => $zarqa->id,
                'min_age_months' => 6,
                'max_age_months' => 60,
            ],
        ];

        foreach ($nurseries as $nurseryData) {
            $user = User::firstOrCreate(
                ['email' => $nurseryData['email']],
                [
                    'name' => $nurseryData['name'],
                    'email' => $nurseryData['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'nursery',
                    'status' => 'active',
                    'phone' => $nurseryData['phone'],
                ]
            );

            Nursery::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'country_id' => $jordan->id,
                    'city_id' => $nurseryData['city_id'],
                    'name' => $nurseryData['name'],
                    'description' => $nurseryData['description'],
                    'phone' => $nurseryData['phone'],
                    'email' => $nurseryData['email'],
                    'address' => $nurseryData['address'],
                    'is_active' => true,
                    'min_age_months' => $nurseryData['min_age_months'],
                    'max_age_months' => $nurseryData['max_age_months'],
                ]
            );
        }

        // Create a demo admin user
        User::firstOrCreate(
            ['email' => 'admin@talib.com'],
            [
                'name' => 'مدير النظام',
                'email' => 'admin@talib.com',
                'password' => Hash::make('admin123'),
                'role' => 'teacher', // Using teacher role as admin
                'status' => 'active',
                'phone' => '0790000000',
            ]
        );

        // Create a demo student user
        User::firstOrCreate(
            ['email' => 'student@demo.com'],
            [
                'name' => 'طالب تجريبي',
                'email' => 'student@demo.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'active',
                'phone' => '0799999999',
            ]
        );

        $this->command->info('Demo data seeded successfully!');
        $this->command->info('');
        $this->command->info('Demo Accounts:');
        $this->command->info('- Admin: admin@talib.com / admin123');
        $this->command->info('- Teacher: ahmed.teacher@demo.com / password123');
        $this->command->info('- Center: elite.center@demo.com / password123');
        $this->command->info('- School: rawad.school@demo.com / password123');
        $this->command->info('- Kindergarten: baraem.kg@demo.com / password123');
        $this->command->info('- Nursery: aman.nursery@demo.com / password123');
        $this->command->info('- Student: student@demo.com / password123');
    }
}
