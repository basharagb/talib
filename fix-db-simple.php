<?php
// Simple database fix with correct credentials
// Run via: ssh digit874@66.198.240.7 "cd public_html && php fix-db-simple.php"

$host = '127.0.0.1';
$database = 'digit874_talib';
$username = 'digit874_talib';
$password = ''; // Empty password as per .env

echo "Connecting to database: $database@$host\n";
echo "Username: $username\n";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connected successfully!\n\n";
    
    // Check current status column
    echo "Current status column:\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM subscriptions LIKE 'status'");
    $before = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($before);
    echo "\n";
    
    // Run the ALTER TABLE command
    $sql = "ALTER TABLE subscriptions MODIFY COLUMN status ENUM('active', 'expired', 'cancelled', 'pending') DEFAULT 'pending'";
    
    echo "Executing: $sql\n";
    $pdo->exec($sql);
    
    echo "✅ Status column updated successfully!\n\n";
    
    // Verify the change
    echo "Updated status column:\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM subscriptions LIKE 'status'");
    $after = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($after);
    
    echo "\n✅ Migration completed successfully!\n";
    echo "⚠️  IMPORTANT: Delete this file after running!\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    
    // Try to get more details
    if ($e->getCode() == 1045) {
        echo "\n⚠️  Access denied. The password might be incorrect.\n";
        echo "Please check the database credentials in .env file.\n";
    }
    
    exit(1);
}
