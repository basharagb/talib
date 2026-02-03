#!/bin/bash

# Deployment script for mobile header fix
# Run this on the production server

echo "🚀 Starting deployment..."

# Navigate to project directory
cd ~/public_html || exit 1

# Pull latest changes
echo "📥 Pulling latest changes from Git..."
git pull origin feature/mobile-ui-improvements

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment completed successfully!"
echo "🌐 Visit https://talib.live to see the changes"
