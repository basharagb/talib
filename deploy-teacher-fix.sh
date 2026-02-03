#!/bin/bash

# Deploy teacher registration validation fix to server

SERVER="digit874@66.198.240.7"
REMOTE_PATH="public_html"

echo "=== Deploying Teacher Registration Fix ==="

# Create backup of current file on server
echo "1. Creating backup..."
ssh $SERVER "cd $REMOTE_PATH && cp app/Http/Requests/TeacherRegistrationRequest.php app/Http/Requests/TeacherRegistrationRequest.php.backup"

# Upload the fixed file
echo "2. Uploading fixed TeacherRegistrationRequest.php..."
scp app/Http/Requests/TeacherRegistrationRequest.php $SERVER:~/$REMOTE_PATH/app/Http/Requests/

# Run migration to add 'pending' status
echo "3. Running migration to add 'pending' status..."
ssh $SERVER "cd $REMOTE_PATH && php artisan migrate --path=database/migrations/2026_02_03_104727_add_pending_status_to_subscriptions_table.php"

# Clear cache
echo "4. Clearing cache..."
ssh $SERVER "cd $REMOTE_PATH && php artisan config:clear && php artisan cache:clear && php artisan view:clear"

echo "=== Deployment Complete ==="
echo ""
echo "Please test at: https://talib.live/register/teacher"
