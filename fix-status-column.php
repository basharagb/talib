<?php
// Fix subscription status column
// Upload this file to public_html and run it via browser: https://talib.live/fix-status-column.php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    DB::statement("ALTER TABLE subscriptions MODIFY COLUMN status ENUM('active', 'expired', 'cancelled', 'pending') DEFAULT 'pending'");
    echo "✅ Success! Status column updated to include 'pending'<br>";
    
    // Verify
    $result = DB::select("SHOW COLUMNS FROM subscriptions LIKE 'status'");
    echo "<pre>";
    print_r($result);
    echo "</pre>";
    
    echo "<br>✅ Migration completed successfully!<br>";
    echo "<br><strong>⚠️ IMPORTANT: Delete this file after running!</strong>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
