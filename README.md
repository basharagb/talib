# Talib Educational Platform

## About Talib

Talib is a comprehensive educational platform built with Laravel 10 that connects students with teachers and educational institutions across different countries. The platform supports both Arabic and English languages and provides a subscription-based model for educational service providers.

## Features

### User Categories & Subscription Fees
- **Teachers** - 10 JD annually
- **Educational Centers/Academies** - 25 JD annually  
- **Private Schools** - 50 JD annually
- **Kindergartens** - 50 JD annually
- **Nurseries** - 40 JD annually
- **Students/Parents** - Free (can browse without registration)

### Key Features
- ✅ Multilingual support (Arabic/English)
- ✅ Role-based authentication system
- ✅ Comprehensive database schema for educational entities
- ✅ Responsive UI with TailwindCSS
- ✅ Payment gateway integration ready
- ✅ Search functionality for finding educators
- ✅ Profile management for all user types

## Technical Stack

- **Framework**: Laravel 10
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Frontend**: Blade Templates + TailwindCSS
- **Testing**: PHPUnit

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Configure database in `.env` file
5. Run migrations and seeders:
   ```bash
   php artisan migrate
   php artisan db:seed --class=CountrySeeder
   ```
6. Build assets:
   ```bash
   npm run build
   ```
7. Start the development server:
   ```bash
   php artisan serve
   ```

## Database Schema

The platform includes comprehensive database tables for:
- Users with role-based access
- Countries and cities
- Educational subjects and grades
- Teachers, educational centers, schools, kindergartens, nurseries
- Subscriptions and payments system
- Many-to-many relationships for subjects and grades

## Testing

Run the test suite:
```bash
php artisan test
```

Current test coverage includes:
- User role functionality tests
- Authentication tests (via Laravel Breeze)

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
