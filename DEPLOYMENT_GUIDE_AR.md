# 📚 دليل نشر منصة طالب على cPanel

## 🎯 المتطلبات الأساسية

قبل البدء، تأكد من توفر:
- حساب استضافة cPanel مع دعم PHP 8.1 أو أعلى
- قاعدة بيانات MySQL
- وصول SSH (اختياري لكن مفضل)
- دومين أو نطاق فرعي

---

## 📁 الخطوة 1: تحضير الملفات

### 1.1 ضغط المشروع
```bash
# من مجلد المشروع على جهازك
zip -r talib.zip . -x "node_modules/*" -x "vendor/*" -x ".git/*"
```

### 1.2 الملفات المطلوبة
تأكد من وجود:
- ✅ جميع ملفات Laravel
- ✅ ملف `.htaccess` في مجلد `public`
- ✅ ملف `robots.txt`
- ✅ ملف `.env.example`

---

## 🌐 الخطوة 2: رفع الملفات على cPanel

### 2.1 استخدام File Manager
1. ادخل إلى **cPanel** → **File Manager**
2. انتقل إلى مجلد `public_html` (أو المجلد الفرعي للنطاق)
3. ارفع ملف `talib.zip`
4. استخرج الملفات (Extract)

### 2.2 هيكل الملفات الصحيح
```
public_html/
├── app/
├── bootstrap/
├── config/
├── database/
├── lang/
├── public/
│   ├── index.php      ← نقل للجذر
│   ├── .htaccess      ← نقل للجذر
│   └── ...
├── resources/
├── routes/
├── storage/
├── vendor/
└── .env
```

### 2.3 نقل محتويات public للجذر
1. انقل جميع محتويات مجلد `public/` إلى `public_html/`
2. أو استخدم symlink إذا كان متاحاً

### 2.4 تعديل index.php
عدّل ملف `index.php` في الجذر:

```php
<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// تعديل المسارات لتشير للمجلد الصحيح
require __DIR__.'/../vendor/autoload.php';
// أو إذا كانت الملفات في نفس المستوى:
// require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
// أو:
// $app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
```

---

## 🗄️ الخطوة 3: إعداد قاعدة البيانات

### 3.1 إنشاء قاعدة البيانات
1. ادخل إلى **cPanel** → **MySQL Databases**
2. أنشئ قاعدة بيانات جديدة: `talib_db`
3. أنشئ مستخدم جديد: `talib_user`
4. اربط المستخدم بقاعدة البيانات مع **ALL PRIVILEGES**

### 3.2 استيراد البيانات (اختياري)
1. ادخل إلى **phpMyAdmin**
2. اختر قاعدة البيانات
3. استورد ملف SQL إذا كان لديك نسخة احتياطية

---

## ⚙️ الخطوة 4: إعداد ملف .env

### 4.1 إنشاء ملف .env
```bash
cp .env.example .env
```

### 4.2 تعديل الإعدادات
```env
APP_NAME="طالب"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpaneluser_talib_db
DB_USERNAME=cpaneluser_talib_user
DB_PASSWORD=your_secure_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# الأهم: تفعيل HTTPS
FORCE_HTTPS=true
```

### 4.3 توليد مفتاح التطبيق
```bash
php artisan key:generate
```

---

## 📦 الخطوة 5: تثبيت الاعتماديات

### 5.1 عبر SSH (الطريقة المفضلة)
```bash
cd ~/public_html
composer install --optimize-autoloader --no-dev
```

### 5.2 عبر cPanel Terminal
إذا لم يكن SSH متاحاً:
1. ادخل إلى **cPanel** → **Terminal**
2. نفذ الأوامر أعلاه

### 5.3 بدون SSH
ارفع مجلد `vendor/` من جهازك المحلي بعد تشغيل:
```bash
composer install --optimize-autoloader --no-dev
```

---

## 🔄 الخطوة 6: تشغيل الترحيلات

```bash
php artisan migrate --force
php artisan db:seed --force
```

---

## 📂 الخطوة 7: إعداد الصلاحيات

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env
```

### التأكد من كتابة Storage
```bash
php artisan storage:link
```

---

## 🚀 الخطوة 8: تحسين الأداء

```bash
# مسح جميع الكاش
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# إعادة بناء الكاش للإنتاج
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## 🔍 الخطوة 9: إضافة SEO على Google

### 9.1 إنشاء حساب Google Search Console
1. اذهب إلى: https://search.google.com/search-console
2. سجل دخول بحساب Google
3. اضغط **Add Property**

### 9.2 إثبات ملكية الموقع
اختر إحدى الطرق:

**الطريقة 1: ملف HTML**
1. حمّل ملف التحقق من Google
2. ارفعه إلى `public_html/`
3. اضغط **Verify**

**الطريقة 2: DNS Record**
1. انسخ TXT Record من Google
2. أضفه في **cPanel** → **Zone Editor** → **Add Record**
3. اختر Type: TXT
4. الصق القيمة واحفظ
5. انتظر 24-48 ساعة للتفعيل

### 9.3 إرسال خريطة الموقع (Sitemap)
1. في Search Console، اذهب إلى **Sitemaps**
2. أضف: `https://yourdomain.com/sitemap.xml`
3. اضغط **Submit**

### 9.4 إضافة موقعك لـ Google Analytics (اختياري)
1. اذهب إلى: https://analytics.google.com
2. أنشئ Property جديد
3. احصل على Tracking ID
4. أضفه في head الموقع:
```html
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XXXXXXXXXX');
</script>
```

---

## ✅ الخطوة 10: التحقق النهائي

### 10.1 قائمة التحقق
- [ ] الموقع يعمل بدون أخطاء
- [ ] صفحة تسجيل الدخول تعمل
- [ ] لوحة التحكم تظهر بشكل صحيح
- [ ] التحليلات تعمل (`/admin/analytics`)
- [ ] التبديل بين العربية والإنجليزية يعمل
- [ ] robots.txt متاح (`/robots.txt`)
- [ ] sitemap.xml متاح (`/sitemap.xml`)
- [ ] شهادة SSL مفعلة (HTTPS)

### 10.2 اختبار SEO
استخدم أدوات مجانية للتحقق:
- https://developers.google.com/speed/pagespeed/insights/
- https://search.google.com/test/mobile-friendly
- https://www.seobility.net/en/seocheck/

---

## 🔧 حل المشاكل الشائعة

### خطأ 500 Internal Server Error
```bash
# تحقق من صلاحيات الملفات
chmod -R 755 storage bootstrap/cache

# تحقق من ملف .env
php artisan config:clear

# شاهد الأخطاء
tail -f storage/logs/laravel.log
```

### صفحة بيضاء فارغة
```bash
# فعّل debug مؤقتاً
# في .env: APP_DEBUG=true
# ثم أعد تحميل الصفحة لرؤية الخطأ
```

### خطأ في قاعدة البيانات
```bash
# تأكد من إعدادات الاتصال في .env
php artisan migrate:status
```

### الصور لا تظهر
```bash
php artisan storage:link
# إذا لم يعمل، أنشئ رابط رمزي يدوياً
ln -s ../storage/app/public public/storage
```

---

## 📞 الدعم

للمساعدة، تواصل معنا:
- البريد: info@talib.com
- الهاتف: +962 6 123 4567

---

## 🎉 تهانينا!

تم نشر منصة طالب بنجاح! 🚀

الآن يمكنك:
- مراقبة الزوار من `/admin/analytics`
- إدارة المستخدمين من `/admin/users`
- مراجعة طلبات التسجيل من `/admin/registrations`

---

*آخر تحديث: يناير 2026*
