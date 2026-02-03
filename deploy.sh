#!/bin/bash

# Talib Platform Deployment Script
# Usage: ./deploy.sh

set -e

echo "🚀 Starting Talib Platform Deployment..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
SERVER_USER="digit874"
SERVER_HOST="66.198.240.7"
SERVER_PATH="/home/digit874/public_html"
LOCAL_PATH="."

echo -e "${YELLOW}📦 Step 1: Installing dependencies...${NC}"
composer install --no-dev --optimize-autoloader
npm install
npm run build

echo -e "${YELLOW}🔧 Step 2: Running migrations...${NC}"
php artisan migrate --force

echo -e "${YELLOW}🗄️ Step 3: Clearing and caching...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

echo -e "${YELLOW}📤 Step 4: Uploading files to server...${NC}"
echo "Please run the following commands manually:"
echo ""
echo "# 1. Upload files via FTP/SFTP to: $SERVER_PATH"
echo "# 2. Or use rsync:"
echo "rsync -avz --exclude 'node_modules' --exclude '.git' --exclude 'storage/logs/*' $LOCAL_PATH/ $SERVER_USER@$SERVER_HOST:$SERVER_PATH/"
echo ""

echo -e "${YELLOW}🔐 Step 5: Set permissions on server...${NC}"
echo "Run these commands on the server:"
echo ""
echo "chmod -R 755 $SERVER_PATH/storage"
echo "chmod -R 755 $SERVER_PATH/bootstrap/cache"
echo "chmod 644 $SERVER_PATH/.env"
echo ""

echo -e "${YELLOW}🗄️ Step 6: Run migrations on server...${NC}"
echo "SSH to server and run:"
echo ""
echo "cd $SERVER_PATH"
echo "php artisan migrate --force"
echo "php artisan config:cache"
echo "php artisan route:cache"
echo "php artisan view:cache"
echo "php artisan storage:link"
echo ""

echo -e "${GREEN}✅ Local preparation complete!${NC}"
echo -e "${YELLOW}⚠️  Please complete the manual steps above to finish deployment.${NC}"
