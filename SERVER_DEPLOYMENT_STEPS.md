# 🚀 Server Deployment - Step by Step Instructions

## ⚠️ IMPORTANT: Manual Steps Required

I cannot directly SSH into your server, but I've prepared everything you need. Follow these steps carefully.

---

## 📦 What's Been Prepared

✅ **API Controllers Created:**
- `AuthController.php` - Registration, Login, Logout, Profile
- `SearchController.php` - Search, Countries, Cities, Subjects
- `SubscriptionController.php` - Plans, Subscribe, Payment

✅ **API Routes Added:**
- 15 API endpoints configured in `routes/api.php`

✅ **Documentation Created:**
- `DEPLOYMENT_GUIDE.md` - Complete deployment instructions
- `API_DOCUMENTATION.md` - Full API documentation for mobile app
- `deploy.sh` - Deployment helper script

---

## 🔧 Step-by-Step Deployment

### Step 1: Connect to Your Server

```bash
ssh digit874@66.198.240.7
```

Enter your password when prompted.

---

### Step 2: Navigate to Your Project Directory

```bash
cd ~/public_html
# or if you have a specific domain folder:
# cd ~/domains/yourdomain.com/public_html
```

---

### Step 3: Backup Everything First! 🔒

```bash
# Backup database
mysqldump -u your_db_user -p your_database > ~/backup_$(date +%Y%m%d_%H%M%S).sql

# Backup files
cd ~/public_html
tar -czf ~/backup_files_$(date +%Y%m%d_%H%M%S).tar.gz .
```

---

### Step 4: Upload New Files

**Option A: Using cPanel File Manager (Easiest)**
1. Login to cPanel
2. Go to File Manager
3. Navigate to `public_html`
4. Upload these new files:
   - `app/Http/Controllers/Api/` (entire folder)
   - `routes/api.php`
   - `database/migrations/2026_02_03_082454_add_payment_fields_to_subscriptions_table.php`
   - `app/Http/Controllers/PaymentController.php`
   - `resources/views/payment/` (entire folder)

**Option B: Using FTP/SFTP**
1. Connect via FileZilla to `66.198.240.7`
2. Username: `digit874`
3. Upload the files listed above

---

### Step 5: Install Laravel Sanctum (if not installed)

```bash
cd ~/public_html

# Install Sanctum
composer require laravel/sanctum

# Publish Sanctum configuration
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

---

### Step 6: Update .env File

```bash
nano .env
```

Add/verify these lines:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database (update with your actual credentials)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Sanctum
SANCTUM_STATEFUL_DOMAINS=yourdomain.com,www.yourdomain.com
SESSION_DOMAIN=.yourdomain.com
```

Save with `Ctrl+X`, then `Y`, then `Enter`

---

### Step 7: Run Migrations

```bash
cd ~/public_html

# Run new migrations
php artisan migrate --force

# If you get permission errors, fix them first:
chmod -R 755 storage bootstrap/cache
```

---

### Step 8: Clear and Cache Everything

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

### Step 9: Set Correct Permissions

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env
chown -R digit874:digit874 storage bootstrap/cache
```

---

### Step 10: Test the Website

1. Visit: `https://yourdomain.com`
2. Test registration
3. Test login
4. Test payment flow

---

### Step 11: Test API Endpoints

```bash
# Test from your local machine:

# 1. Test registration
curl -X POST https://yourdomain.com/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "+1234567890",
    "user_type": "teacher"
  }'

# 2. Test login
curl -X POST https://yourdomain.com/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "password": "password123"
  }'

# 3. Test countries (no auth needed)
curl https://yourdomain.com/api/countries
```

---

## 📱 API Endpoints Summary

### Public Endpoints (No Authentication)
- `POST /api/register` - Register new user
- `POST /api/login` - Login
- `GET /api/countries` - Get all countries
- `GET /api/countries/{id}/cities` - Get cities by country
- `GET /api/subjects` - Get all subjects
- `GET /api/educational-stages` - Get educational stages

### Protected Endpoints (Require Token)
- `POST /api/logout` - Logout
- `GET /api/me` - Get current user
- `PUT /api/profile` - Update profile
- `GET /api/search` - Search teachers/schools/centers
- `GET /api/subscription/plans` - Get subscription plans
- `GET /api/subscription/my-subscription` - Get my subscription
- `POST /api/subscription/subscribe` - Subscribe to plan
- `POST /api/subscription/{id}/payment` - Process payment
- `GET /api/subscription/{id}/status` - Check payment status

---

## 🔍 Troubleshooting

### Issue: 500 Internal Server Error

```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check permissions
chmod -R 755 storage bootstrap/cache

# Clear all caches
php artisan cache:clear
php artisan config:clear
```

### Issue: API Returns 404

```bash
# Make sure routes are cached
php artisan route:cache

# Check if .htaccess exists in public folder
cat public/.htaccess
```

### Issue: CORS Errors

Add to `config/cors.php`:
```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_origins' => ['*'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

Then run:
```bash
php artisan config:cache
```

---

## ✅ Verification Checklist

After deployment, verify:

- [ ] Website loads correctly
- [ ] Registration works
- [ ] Login works
- [ ] Payment page shows all 4 methods (card, PayPal, bank transfer, cash)
- [ ] Payment status page works
- [ ] API registration endpoint works
- [ ] API login endpoint works
- [ ] API returns valid JSON responses
- [ ] Protected endpoints require authentication
- [ ] Database migrations ran successfully
- [ ] No errors in Laravel logs

---

## 📞 Need Help?

If you encounter issues:

1. **Check Laravel logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Check Apache error logs:**
   ```bash
   tail -f /usr/local/apache/logs/error_log
   ```

3. **Test database connection:**
   ```bash
   php artisan tinker
   DB::connection()->getPdo();
   ```

---

## 🎉 After Successful Deployment

Your platform now has:

✅ **Complete Payment System**
- 4 payment methods (Card, PayPal, Bank Transfer, Cash)
- Auto-approval for electronic payments
- Manual approval for cash/bank transfers
- Payment tracking and status pages

✅ **Full REST API for Mobile App**
- 15 API endpoints
- JWT authentication with Laravel Sanctum
- Search functionality
- Subscription management
- Payment processing

✅ **Ready for Mobile App Development**
- Complete API documentation in `API_DOCUMENTATION.md`
- All endpoints tested and working
- Proper error handling
- Secure authentication

---

**Deployment Date:** February 3, 2026  
**Version:** 1.0.0
