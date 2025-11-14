# Talib Educational Platform - Project Scratchpad

## Current Task: 🚧 تحسين واجهات ui (front_ui + dashboard_ui)
العمل الحالي يركز على تحسين جميع الواجهات داخل مجلد ui (واجهة الزوار front_ui ولوحة التحكم dashboard_ui)، مع توحيد الألوان والخطوط وتحسين التجاوب والرسوم المتحركة.

## Project Description
Educational platform "Talib" with payment gateway for connecting students with educational providers across different countries. The platform supports Arabic and English languages.

## User Categories & Subscription Fees
1. **Teachers** - 10 JD/year
2. **Educational Centers/Academies** - 25 JD/year  
3. **Private Schools** - 50 JD/year
4. **Kindergartens** - 50 JD/year
5. **Nurseries** - 40 JD/year
6. **Students/Parents** - Free (can browse without registration)

## Detailed Registration Requirements

### 1. Teachers Registration (10 JD/year)
- Country (required)
- City (required) 
- District/Area (optional)
- Location (optional)
- Academic Degree (diploma, bachelor, master, high diploma, doctorate)
- Full description about teacher
- Profile photo
- Contact methods (phone + social media links)
- Gender (male/female)
- Subjects taught (multi-select dropdown with grades)
- Work experience

### 2. Educational Centers/Academies (25 JD/year)
- Country (required)
- City (required)
- District/Area (required)
- Location (required)
- Full description about center/academy
- Logo
- Contact methods (phone + social media links)
- Subjects taught (multi-select dropdown with grades)

### 3. Private Schools (50 JD/year)
- Country (required)
- City (required)
- District/Area (required)
- Location (required)
- Full description about school
- Logo
- Contact methods (phone + social media links)
- Grades taught (multi-select dropdown)
- **NEW:** Educational stages (ابتدائي، أساسي، ثانوي)
- **NEW:** Student type (ذكور، إناث، مختلط)

### 4. Kindergartens (50 JD/year)
- Country (required)
- City (required)
- District/Area (required)
- Location (required)
- Full description about kindergarten
- Logo
- Contact methods (phone + social media links)
- Grades taught (multi-select dropdown)

### 5. Nurseries (40 JD/year)
- Country (required)
- City (required)
- District/Area (required)
- Location (required)
- Full description about nursery
- Logo
- Contact methods (phone + social media links)
- Ages accepted (multi-select from 1 day to 5 years)

## Task Progress
- [x] Create Laravel 10 project
- [x] Set up MySQL database connection
- [x] Create database migrations for all entities
- [x] Set up multilingual support (Arabic/English)
- [x] Create authentication system with role-based access
- [x] Create new branch for registration forms
- [x] Create all missing models (EducationalCenter, School, Kindergarten, Nursery, Grade)
- [x] Create organized controllers for each registration type
- [x] Create form request classes for validation
- [x] Create comprehensive registration routes
- [x] Implement payment gateway integration controller
- [x] Create registration blade templates with responsive design
- [x] Create payment views (show, success, cancel)
- [x] Add comprehensive multilingual language files (Arabic/English)
- [x] Create search functionality with advanced filters
- [x] Create all registration forms (teacher, center, school, kindergarten, nursery)
- [x] Add age ranges for nurseries (1 day to 5 years)
- [x] Design responsive UI
- [x] Add unit tests (29 tests passing)
- [x] Create git repository and commit changes
- [x] إضافة المراحل الدراسية للمدارس (ابتدائي، أساسي، ثانوي)
- [x] إضافة نوع الطلاب للمدارس (ذكور، إناث، مختلط)
- [x] تحديث قاعدة البيانات والنماذج
- [x] تحديث واجهة تسجيل المدارس
- [x] إضافة الترجمات الجديدة
- [ ] تحسين نظام البحث ليشمل جميع المستخدمين
- [ ] إضافة إمكانية البحث بدون تسجيل للطلاب
- [ ] تحسين واجهة البحث والفلترة
- [ ] إضافة صفحة عرض النتائج المحسنة
- [ ] اختبار جميع التدفقات من البداية للنهاية
- [ ] إنشاء اختبارات إضافية للميزات الجديدة
- [ ] الالتزام النهائي وطلب السحب

## UI Work Plan (داخل مجلد ui)

### 1. واجهة الزوار front_ui
- [ ] مراجعة هيكل المشروع داخل ui/front_ui (الصفحات، المكونات، الموارد)
- [ ] توحيد نظام الألوان بما يتناسب مع هوية Talib (تدرجات تعليمية حديثة)
- [ ] توحيد الخطوط (Cairo للعربي، Inter للإنجليزي) في جميع الصفحات
- [ ] تحسين الصفحة الرئيسية والـ Hero Section مع animations بسيطة واحترافية
- [ ] تحسين صفحات البحث ونتائج البحث لتكون واضحة وسهلة الاستخدام
- [ ] التأكد من التجاوب الكامل على الجوال والأجهزة اللوحية

### 2. لوحة التحكم dashboard_ui
- [ ] مراجعة القالب الحالي داخل ui/dashboard_ui (index, cards, tables, login)
- [ ] توحيد الألوان والخطوط مع الواجهة الرئيسية
- [ ] تحسين الـ sidebar والـ navbar لتكون واضحة وسهلة التنقل
- [ ] تحسين بطاقات الإحصائيات والجداول لعرض البيانات بشكل أوضح
- [ ] إضافة لمسات Animations بسيطة للتفاعلات (hover, active, transitions)
- [ ] اختبار الواجهة على أحجام شاشات مختلفة

### 3. التكامل مع المشروع الأساسي
- [ ] التأكد من توافق التصميم في ui مع التصميم العام في resources/views
- [ ] تحديث أي روابط أو assets ضرورية بين ui وباقي المشروع
- [ ] تشغيل الواجهات محليًا والتحقق يدويًا من جميع الشاشات المهمة
- [ ] إضافة ملاحظات نهائية في هذا scratchpad عن التحسينات التي تم تنفيذها

## Database Schema Planning
### Core Tables Needed:
- users (base user table)
- teachers
- educational_centers
- schools
- kindergartens
- nurseries
- countries
- cities
- subjects
- grades
- subscriptions
- payments

## خطة العمل الاحترافية - المرحلة التالية

### المرحلة 1: إضافة المتطلبات الجديدة للمدارس ⏳
- [ ] إضافة جدول educational_stages (ابتدائي، أساسي، ثانوي)
- [ ] إضافة جدول student_types (ذكور، إناث، مختلط)
- [ ] تحديث نموذج School وعلاقاته
- [ ] تحديث نماذج التسجيل للمدارس
- [ ] تحديث واجهة تسجيل المدارس

### المرحلة 2: تحسين نظام البحث 🔍
- [ ] تحسين صفحة البحث الرئيسية
- [ ] إضافة فلاتر متقدمة (المرحلة، نوع الطلاب، إلخ)
- [ ] تحسين عرض النتائج
- [ ] إضافة البحث بدون تسجيل
- [ ] تحسين الأداء والسرعة

### المرحلة 3: تحسين تجربة المستخدم 🎨
- [ ] تحسين التصميم العام
- [ ] إضافة رسوم متحركة وتفاعلات
- [ ] تحسين الاستجابة على الهواتف
- [ ] إضافة إشعارات المستخدم
- [ ] تحسين رسائل الخطأ والنجاح

### المرحلة 4: الاختبار والنشر 🚀
- [ ] اختبار شامل لجميع الوظائف
- [ ] اختبارات الأمان
- [ ] اختبارات الأداء
- [ ] توثيق شامل
- [ ] إعداد الإنتاج

## Lessons
- استخدام Laravel 10 مع MySQL
- تطبيق نمط MVC بشكل صحيح
- استخدام Form Requests للتحقق من صحة البيانات
- تطبيق العلاقات المعقدة في قاعدة البيانات
- استخدام TailwindCSS للتصميم المتجاوب
