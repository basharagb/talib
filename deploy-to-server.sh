#!/bin/bash

# Talib Platform - Server Deployment Script
# This script deploys the latest changes to talib.live

echo "🚀 Starting Talib Platform Deployment..."

# Navigate to project directory
cd /home/digit874/talib.live || exit 1

# Backup current .env file
echo "📦 Backing up .env file..."
cp .env .env.backup.$(date +%Y%m%d_%H%M%S)

# Run migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Clear all caches
echo "🧹 Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild optimized caches
echo "⚡ Rebuilding optimized caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Set proper permissions
echo "🔒 Setting proper permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env

# Create storage link if not exists
echo "🔗 Creating storage link..."
php artisan storage:link

echo "✅ Deployment completed successfully!"
echo "🌐 Site: https://talib.live/"
echo ""
echo "📋 Next steps:"
echo "1. Test the website: https://talib.live/"
echo "2. Check error logs if needed: storage/logs/laravel.log"
echo "3. Monitor application performance"
