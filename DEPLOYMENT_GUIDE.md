# Talib Platform - Deployment Guide

## 📋 Pre-Deployment Checklist

### 1. Local Environment Setup
- ✅ All code changes committed to Git
- ✅ Database migrations created and tested
- ✅ `.env.example` updated with new variables
- ✅ Dependencies installed (`composer install`, `npm install`)
- ✅ Assets compiled (`npm run build`)

### 2. Server Requirements
- PHP >= 8.1
- MySQL >= 5.7 or MariaDB >= 10.3
- Composer
- Node.js & NPM (for asset compilation)
- Apache/Nginx web server

---

## 🚀 Deployment Steps

### Step 1: Prepare Local Files

```bash
# Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Clear and cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Step 2: Connect to Server

```bash
ssh digit874@66.198.240.7
```

**Password:** (Your server password)

### Step 3: Navigate to Project Directory

```bash
cd ~/public_html
# or
cd ~/domains/yourdomain.com/public_html
```

### Step 4: Backup Current Installation

```bash
# Backup database
mysqldump -u your_db_user -p your_database > backup_$(date +%Y%m%d_%H%M%S).sql

# Backup files
tar -czf backup_files_$(date +%Y%m%d_%H%M%S).tar.gz .
```

### Step 5: Upload Files

**Option A: Using FTP/SFTP (Recommended for A2 Hosting)**
1. Open FileZilla or your preferred FTP client
2. Connect to: `66.198.240.7`
3. Username: `digit874`
4. Upload all files EXCEPT:
   - `node_modules/`
   - `.git/`
   - `storage/logs/*`
   - `.env` (configure separately)

**Option B: Using rsync (if available)**
```bash
# From your local machine
rsync -avz --exclude 'node_modules' \
           --exclude '.git' \
           --exclude 'storage/logs/*' \
           --exclude '.env' \
           ./ digit874@66.198.240.7:~/public_html/
```

### Step 6: Configure Environment

```bash
# On the server
cd ~/public_html

# Copy and edit .env file
cp .env.example .env
nano .env
```

**Update these values in `.env`:**
```env
APP_NAME="Talib"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Generate new key
APP_KEY=
```

### Step 7: Install Dependencies on Server

```bash
# Install Composer dependencies
composer install --no-dev --optimize-autoloader

# If Node.js is available, compile assets
npm install
npm run build
```

### Step 8: Set Permissions

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env
chown -R digit874:digit874 storage bootstrap/cache
```

### Step 9: Run Migrations

```bash
# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Step 10: Verify Deployment

1. Visit your website: `https://yourdomain.com`
2. Test registration flow
3. Test login functionality
4. Test search functionality
5. Test payment flow
6. Test API endpoints

---

## 🔧 Post-Deployment Configuration

### Configure Web Server

**For Apache (A2 Hosting uses Apache):**

Create/Update `.htaccess` in public folder:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

**Document Root:** Should point to `/public` folder

### Configure Cron Jobs (Optional)

Add to crontab:
```bash
* * * * * cd /home/digit874/public_html && php artisan schedule:run >> /dev/null 2>&1
```

### Configure Queue Worker (Optional)

```bash
php artisan queue:work --daemon
```

---

## 📱 API Endpoints for Mobile App

### Base URL
```
https://yourdomain.com/api
```

### Authentication Endpoints

#### 1. Register
```http
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "+1234567890",
    "user_type": "teacher"
}
```

**Response:**
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "user": {...},
        "token": "1|abc123..."
    }
}
```

#### 2. Login
```http
POST /api/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123"
}
```

#### 3. Logout
```http
POST /api/logout
Authorization: Bearer {token}
```

#### 4. Get Current User
```http
GET /api/me
Authorization: Bearer {token}
```

#### 5. Update Profile
```http
PUT /api/profile
Authorization: Bearer {token}
Content-Type: application/json

{
    "name": "John Updated",
    "phone": "+9876543210"
}
```

### Search Endpoints

#### 6. Search
```http
GET /api/search?query=math&type=teacher&country_id=1&city_id=5
Authorization: Bearer {token}
```

**Parameters:**
- `query` (optional): Search term
- `type` (optional): teacher, school, educational_center, kindergarten, nursery, all
- `country_id` (optional): Filter by country
- `city_id` (optional): Filter by city
- `subject_id` (optional): Filter by subject
- `educational_stage_id` (optional): Filter by educational stage
- `per_page` (optional): Results per page (default: 15)

#### 7. Get Countries
```http
GET /api/countries
```

#### 8. Get Cities by Country
```http
GET /api/countries/{countryId}/cities
```

#### 9. Get Subjects
```http
GET /api/subjects
```

#### 10. Get Educational Stages
```http
GET /api/educational-stages
```

### Subscription Endpoints

#### 11. Get Subscription Plans
```http
GET /api/subscription/plans
```

#### 12. Get My Subscription
```http
GET /api/subscription/my-subscription
Authorization: Bearer {token}
```

#### 13. Subscribe to Plan
```http
POST /api/subscription/subscribe
Authorization: Bearer {token}
Content-Type: application/json

{
    "plan_id": 1
}
```

#### 14. Process Payment
```http
POST /api/subscription/{subscriptionId}/payment
Authorization: Bearer {token}
Content-Type: application/json

{
    "payment_method": "card",
    "payment_reference": "TXN123456",
    "payment_notes": "Payment via Visa"
}
```

**Payment Methods:**
- `card` - Auto-approved ✅
- `paypal` - Auto-approved ✅
- `bank_transfer` - Manual approval ⏳
- `cash` - Manual approval ⏳

#### 15. Check Payment Status
```http
GET /api/subscription/{subscriptionId}/status
Authorization: Bearer {token}
```

---

## 🧪 Testing API Endpoints

### Using cURL

```bash
# Register
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

# Login
curl -X POST https://yourdomain.com/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "password": "password123"
  }'

# Search (with token)
curl -X GET "https://yourdomain.com/api/search?query=math&type=teacher" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Using Postman

1. Import the API collection
2. Set base URL: `https://yourdomain.com/api`
3. Add Authorization header: `Bearer {token}`
4. Test all endpoints

---

## 🔍 Troubleshooting

### Issue: 500 Internal Server Error

**Solution:**
```bash
# Check logs
tail -f storage/logs/laravel.log

# Check permissions
chmod -R 755 storage bootstrap/cache

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Issue: Database Connection Error

**Solution:**
1. Verify database credentials in `.env`
2. Check if database exists
3. Test connection: `php artisan tinker` then `DB::connection()->getPdo();`

### Issue: 404 Not Found

**Solution:**
1. Check `.htaccess` file exists in public folder
2. Verify mod_rewrite is enabled
3. Check document root points to `/public`

### Issue: CORS Errors (API)

**Solution:**
Add to `config/cors.php`:
```php
'paths' => ['api/*'],
'allowed_origins' => ['*'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

---

## 📞 Support

If you encounter any issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check server error logs
3. Verify all environment variables
4. Test database connection
5. Verify file permissions

---

## ✅ Deployment Checklist

- [ ] Backup database and files
- [ ] Upload files to server
- [ ] Configure `.env` file
- [ ] Install dependencies
- [ ] Set correct permissions
- [ ] Run migrations
- [ ] Generate application key
- [ ] Create storage link
- [ ] Cache configuration
- [ ] Test website functionality
- [ ] Test API endpoints
- [ ] Configure SSL certificate
- [ ] Set up cron jobs (if needed)
- [ ] Configure queue workers (if needed)
- [ ] Monitor error logs

---

**Last Updated:** February 3, 2026
**Version:** 1.0.0
