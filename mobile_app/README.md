# Talib Mobile App - منصة طالب

Flutter mobile application for the Talib Educational Platform with Clean Architecture and BLoC state management.

## 🎨 Brand Identity

- **Primary Color**: `#3B82F6` (Blue 500) → `#1D4ED8` (Blue 700)
- **Secondary Color**: `#0EA5E9` (Sky 500) → `#0369A1` (Sky 700)
- **Purple Accent**: `#8B5CF6` (From logo)
- **Logo**: Circular purple design with educational icon
- **Fonts**: Cairo (Arabic), Inter (English)

## 🏗️ Architecture

This app follows **Clean Architecture** principles with **BLoC** state management pattern:

```
lib/
├── core/
│   ├── constants/       # App colors, API endpoints
│   ├── error/          # Failures and exceptions
│   ├── network/        # Network connectivity
│   ├── usecases/       # Base use case
│   └── di/             # Dependency injection
├── features/
│   └── auth/
│       ├── data/
│       │   ├── datasources/    # Remote & local data sources
│       │   ├── models/         # Data models
│       │   └── repositories/   # Repository implementations
│       ├── domain/
│       │   ├── entities/       # Business entities
│       │   ├── repositories/   # Repository interfaces
│       │   └── usecases/       # Business logic
│       └── presentation/
│           ├── bloc/           # BLoC state management
│           ├── pages/          # UI screens
│           └── widgets/        # Reusable widgets
```

## 📦 Dependencies

- **flutter_bloc**: ^8.1.6 - State management
- **equatable**: ^2.0.5 - Value equality
- **get_it**: ^7.7.0 - Dependency injection
- **dio**: ^5.4.3+1 - HTTP client
- **connectivity_plus**: ^6.0.3 - Network status
- **shared_preferences**: ^2.2.3 - Local storage
- **flutter_secure_storage**: ^9.2.2 - Secure token storage
- **dartz**: ^0.10.1 - Functional programming

## 🚀 Getting Started

### Prerequisites

- Flutter SDK 3.10.0 or higher
- Dart SDK 3.10.0 or higher
- iOS: Xcode 14+ / macOS 13+
- Android: Android Studio / SDK 21+

### Installation

1. **Install dependencies:**
   ```bash
   flutter pub get
   ```

2. **Run the app:**
   ```bash
   flutter run
   ```

3. **Build for production:**
   ```bash
   # iOS
   flutter build ios --release
   
   # Android
   flutter build apk --release
   ```

## 🔐 Authentication

The app connects to the Talib API at `https://talib.live/api`

### Login Flow
1. User enters email and password
2. BLoC validates input
3. API call to `/api/login`
4. Token stored securely
5. User cached locally
6. Navigate to home screen

### API Endpoints
- `POST /api/login` - User authentication
- `POST /api/logout` - User logout
- `GET /api/profile` - Get user profile

## 🌍 Localization

The app supports:
- Arabic (ar) - Default
- English (en)

## 🧪 Testing

Run tests:
```bash
flutter test
```

## 📱 Features

### ✅ Implemented Features

- **Authentication**
  - Login with email/password
  - Secure token storage
  - Auto-login on app start
  - Logout functionality

- **Search & Discovery**
  - Search teachers, schools, centers
  - Advanced filters (country, city, subject, stage)
  - Real-time search results
  - Beautiful result cards with ratings

- **Profile Management**
  - View user profile
  - Account status display
  - User information management
  - Profile editing (ready for implementation)

- **UI/UX**
  - Clean Architecture
  - BLoC State Management
  - Smooth animations and transitions
  - Shimmer loading effects
  - RTL Support (Arabic)
  - Material Design 3
  - Custom branding with Talib colors
  - Bottom navigation bar
  - Responsive design

- **Technical**
  - Offline support
  - Network connectivity check
  - Error handling
  - Form validation
  - Secure storage
  - Dependency injection

## 🎯 Upcoming Features

- Subscription management
- Payment processing
- Favorites/Bookmarks
- Reviews and ratings
- Chat/Messaging
- Notifications
- Profile editing with image upload

## 🔧 Configuration

### API Configuration

Update API base URL in `lib/core/constants/api_constants.dart`:
```dart
static const String baseUrl = 'https://talib.live/api';
```

### Test Credentials

Use these credentials to test the app:
- **Email**: admin@talib.com
- **Password**: admin123

## 🏃 Running the App

```bash
# Get dependencies
flutter pub get

# Run on connected device
flutter run

# Run on specific device
flutter run -d <device_id>

# Run in release mode
flutter run --release
```

## 🐛 Troubleshooting

### Common Issues

1. **Package errors**: Run `flutter pub get`
2. **Build errors**: Run `flutter clean` then `flutter pub get`
3. **iOS issues**: Run `cd ios && pod install`
4. **Android issues**: Sync Gradle files in Android Studio

## 📚 Project Structure

```
mobile_app/
├── lib/
│   ├── core/
│   │   ├── constants/       # Colors, API endpoints
│   │   ├── di/             # Dependency injection
│   │   ├── error/          # Error handling
│   │   ├── network/        # Network info
│   │   ├── usecases/       # Base use case
│   │   ├── utils/          # Validators, formatters, animations
│   │   └── widgets/        # Shared widgets
│   ├── features/
│   │   ├── auth/           # Authentication feature
│   │   ├── search/         # Search & discovery feature
│   │   └── profile/        # Profile management feature
│   └── main.dart           # App entry point
├── assets/
│   └── images/             # App images and logo
├── pubspec.yaml            # Dependencies
└── README.md              # This file
```

## 📄 License

Copyright © 2026 Talib Educational Platform. All rights reserved.
