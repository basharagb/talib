# Talib Platform - API Documentation

## 📱 Base URL

```
Production: https://yourdomain.com/api
Local: http://127.0.0.1:8000/api
```

## 🔐 Authentication

All protected endpoints require a Bearer token in the Authorization header:

```
Authorization: Bearer {your_token_here}
```

---

## 📋 API Endpoints

### 1. Authentication

#### 1.1 Register User

**Endpoint:** `POST /api/register`

**Description:** Register a new user account

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "+1234567890",
    "user_type": "teacher"
}
```

**User Types:**
- `teacher`
- `school`
- `educational_center`
- `kindergarten`
- `nursery`

**Success Response (201):**
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "phone": "+1234567890",
            "user_type": "teacher",
            "is_active": false,
            "created_at": "2026-02-03T12:00:00.000000Z"
        },
        "token": "1|abc123xyz456..."
    }
}
```

**Error Response (422):**
```json
{
    "success": false,
    "message": "Validation error",
    "errors": {
        "email": ["The email has already been taken."]
    }
}
```

---

#### 1.2 Login

**Endpoint:** `POST /api/login`

**Description:** Login with email and password

**Request Body:**
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Success Response (200):**
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "user_type": "teacher",
            "is_active": true
        },
        "token": "2|def456ghi789..."
    }
}
```

**Error Response (401):**
```json
{
    "success": false,
    "message": "Invalid credentials"
}
```

---

#### 1.3 Logout

**Endpoint:** `POST /api/logout`

**Authentication:** Required

**Success Response (200):**
```json
{
    "success": true,
    "message": "Logged out successfully"
}
```

---

#### 1.4 Get Current User

**Endpoint:** `GET /api/me`

**Authentication:** Required

**Success Response (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+1234567890",
        "user_type": "teacher",
        "is_active": true,
        "created_at": "2026-02-03T12:00:00.000000Z"
    }
}
```

---

#### 1.5 Update Profile

**Endpoint:** `PUT /api/profile`

**Authentication:** Required

**Request Body:**
```json
{
    "name": "John Updated",
    "phone": "+9876543210",
    "password": "newpassword123",
    "password_confirmation": "newpassword123"
}
```

**Note:** All fields are optional

**Success Response (200):**
```json
{
    "success": true,
    "message": "Profile updated successfully",
    "data": {
        "id": 1,
        "name": "John Updated",
        "email": "john@example.com",
        "phone": "+9876543210"
    }
}
```

---

### 2. Search & Discovery

#### 2.1 Search

**Endpoint:** `GET /api/search`

**Authentication:** Required

**Query Parameters:**
- `query` (optional): Search term
- `type` (optional): Filter by type
  - Values: `teacher`, `school`, `educational_center`, `kindergarten`, `nursery`, `all`
  - Default: `all`
- `country_id` (optional): Filter by country ID
- `city_id` (optional): Filter by city ID
- `subject_id` (optional): Filter by subject ID
- `educational_stage_id` (optional): Filter by educational stage ID
- `per_page` (optional): Results per page (default: 15)

**Example Request:**
```
GET /api/search?query=math&type=teacher&country_id=1&city_id=5&per_page=20
```

**Success Response (200):**
```json
{
    "success": true,
    "data": {
        "teachers": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "full_name": "Ahmed Mohamed",
                    "bio": "Math teacher with 10 years experience",
                    "country": {
                        "id": 1,
                        "name_ar": "مصر",
                        "name_en": "Egypt"
                    },
                    "city": {
                        "id": 5,
                        "name_ar": "القاهرة",
                        "name_en": "Cairo"
                    },
                    "subjects": [
                        {
                            "id": 1,
                            "name_ar": "رياضيات",
                            "name_en": "Mathematics"
                        }
                    ]
                }
            ],
            "per_page": 20,
            "total": 45
        },
        "schools": {...},
        "educational_centers": {...}
    }
}
```

---

#### 2.2 Get Countries

**Endpoint:** `GET /api/countries`

**Authentication:** Not required

**Success Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name_ar": "مصر",
            "name_en": "Egypt",
            "code": "EG"
        },
        {
            "id": 2,
            "name_ar": "السعودية",
            "name_en": "Saudi Arabia",
            "code": "SA"
        }
    ]
}
```

---

#### 2.3 Get Cities by Country

**Endpoint:** `GET /api/countries/{countryId}/cities`

**Authentication:** Not required

**Example:** `GET /api/countries/1/cities`

**Success Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "country_id": 1,
            "name_ar": "القاهرة",
            "name_en": "Cairo"
        },
        {
            "id": 2,
            "country_id": 1,
            "name_ar": "الإسكندرية",
            "name_en": "Alexandria"
        }
    ]
}
```

---

#### 2.4 Get Subjects

**Endpoint:** `GET /api/subjects`

**Authentication:** Not required

**Success Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name_ar": "رياضيات",
            "name_en": "Mathematics"
        },
        {
            "id": 2,
            "name_ar": "علوم",
            "name_en": "Science"
        }
    ]
}
```

---

#### 2.5 Get Educational Stages

**Endpoint:** `GET /api/educational-stages`

**Authentication:** Not required

**Success Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name_ar": "ابتدائي",
            "name_en": "Primary"
        },
        {
            "id": 2,
            "name_ar": "إعدادي",
            "name_en": "Middle School"
        }
    ]
}
```

---

### 3. Subscriptions & Payments

#### 3.1 Get Subscription Plans

**Endpoint:** `GET /api/subscription/plans`

**Authentication:** Not required

**Success Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Basic Plan",
            "description": "Basic features for 30 days",
            "price": 99.99,
            "duration_days": 30,
            "features": ["Feature 1", "Feature 2"],
            "is_active": true
        },
        {
            "id": 2,
            "name": "Premium Plan",
            "description": "All features for 90 days",
            "price": 249.99,
            "duration_days": 90,
            "features": ["All Basic", "Feature 3", "Feature 4"],
            "is_active": true
        }
    ]
}
```

---

#### 3.2 Get My Subscription

**Endpoint:** `GET /api/subscription/my-subscription`

**Authentication:** Required

**Success Response (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "user_id": 1,
        "plan_id": 1,
        "start_date": "2026-02-03",
        "end_date": "2026-03-05",
        "status": "active",
        "amount": 99.99,
        "payment_method": "card",
        "payment_status": "paid",
        "payment_reference": "TXN123456",
        "paid_at": "2026-02-03T12:00:00.000000Z",
        "auto_approved": true,
        "plan": {
            "id": 1,
            "name": "Basic Plan",
            "price": 99.99
        }
    }
}
```

---

#### 3.3 Subscribe to Plan

**Endpoint:** `POST /api/subscription/subscribe`

**Authentication:** Required

**Request Body:**
```json
{
    "plan_id": 1
}
```

**Success Response (201):**
```json
{
    "success": true,
    "message": "Subscription created successfully. Please proceed to payment.",
    "data": {
        "id": 1,
        "user_id": 1,
        "plan_id": 1,
        "start_date": "2026-02-03",
        "end_date": "2026-03-05",
        "status": "pending",
        "amount": 99.99,
        "payment_status": "pending"
    }
}
```

**Error Response (400):**
```json
{
    "success": false,
    "message": "You already have an active subscription"
}
```

---

#### 3.4 Process Payment

**Endpoint:** `POST /api/subscription/{subscriptionId}/payment`

**Authentication:** Required

**Request Body:**
```json
{
    "payment_method": "card",
    "payment_reference": "TXN123456",
    "payment_notes": "Payment via Visa card"
}
```

**Payment Methods:**
- `card` - Credit/Debit Card (Auto-approved ✅)
- `paypal` - PayPal (Auto-approved ✅)
- `bank_transfer` - Bank Transfer (Manual approval ⏳)
- `cash` - Cash Payment (Manual approval ⏳)

**Success Response - Auto-approved (200):**
```json
{
    "success": true,
    "message": "Payment processed successfully. Your account is now active.",
    "data": {
        "id": 1,
        "payment_method": "card",
        "payment_status": "paid",
        "status": "active",
        "auto_approved": true,
        "paid_at": "2026-02-03T12:00:00.000000Z"
    }
}
```

**Success Response - Manual approval (200):**
```json
{
    "success": true,
    "message": "Payment submitted. Waiting for admin approval.",
    "data": {
        "id": 1,
        "payment_method": "cash",
        "payment_status": "pending",
        "status": "pending",
        "auto_approved": false
    }
}
```

**Error Response (400):**
```json
{
    "success": false,
    "message": "This subscription has already been paid"
}
```

---

#### 3.5 Check Payment Status

**Endpoint:** `GET /api/subscription/{subscriptionId}/status`

**Authentication:** Required

**Success Response (200):**
```json
{
    "success": true,
    "data": {
        "subscription": {
            "id": 1,
            "status": "active",
            "payment_status": "paid",
            "payment_method": "card",
            "amount": 99.99,
            "paid_at": "2026-02-03T12:00:00.000000Z"
        },
        "user_active": true,
        "payment_status": "paid",
        "subscription_status": "active",
        "auto_approved": true
    }
}
```

---

## 🔄 Payment Flow

### For Electronic Payments (Card/PayPal):

1. User registers → `POST /api/register`
2. User subscribes to plan → `POST /api/subscription/subscribe`
3. User processes payment → `POST /api/subscription/{id}/payment` with `payment_method: "card"`
4. ✅ **Account activated immediately**
5. User can access all features

### For Manual Payments (Cash/Bank Transfer):

1. User registers → `POST /api/register`
2. User subscribes to plan → `POST /api/subscription/subscribe`
3. User submits payment → `POST /api/subscription/{id}/payment` with `payment_method: "cash"`
4. ⏳ **Waiting for admin approval**
5. User checks status → `GET /api/subscription/{id}/status`
6. Admin approves payment (via admin panel)
7. ✅ **Account activated**

---

## 🧪 Testing with cURL

### Register
```bash
curl -X POST http://127.0.0.1:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "+1234567890",
    "user_type": "teacher"
  }'
```

### Login
```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "password": "password123"
  }'
```

### Search (with token)
```bash
curl -X GET "http://127.0.0.1:8000/api/search?query=math&type=teacher" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Subscribe
```bash
curl -X POST http://127.0.0.1:8000/api/subscription/subscribe \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{"plan_id": 1}'
```

### Process Payment
```bash
curl -X POST http://127.0.0.1:8000/api/subscription/1/payment \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "payment_method": "card",
    "payment_reference": "TXN123456"
  }'
```

---

## 📱 Mobile App Integration

### Setup

1. **Base URL Configuration:**
```dart
// Flutter example
const String baseUrl = 'https://yourdomain.com/api';
```

2. **Token Storage:**
Store the authentication token securely using:
- Flutter: `flutter_secure_storage`
- React Native: `@react-native-async-storage/async-storage`
- Native: Keychain (iOS) / KeyStore (Android)

3. **HTTP Headers:**
```dart
final headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer $token',
};
```

### Error Handling

All API responses follow this structure:

**Success:**
```json
{
    "success": true,
    "message": "Operation successful",
    "data": {...}
}
```

**Error:**
```json
{
    "success": false,
    "message": "Error message",
    "errors": {...}
}
```

### HTTP Status Codes

- `200` - Success
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

---

## 🔒 Security Notes

1. **Always use HTTPS in production**
2. **Store tokens securely** (never in plain text)
3. **Implement token refresh** mechanism
4. **Validate all user inputs**
5. **Handle expired tokens** gracefully
6. **Implement rate limiting** on sensitive endpoints

---

**Version:** 1.0.0  
**Last Updated:** February 3, 2026
