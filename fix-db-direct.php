<?php
// Direct database fix without Laravel bootstrap
// Upload and run via: ssh digit874@66.198.240.7 "cd public_html && php fix-db-direct.php"

// Read .env file
$envFile = __DIR__ . '/.env';
$envVars = [];

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($key, $value) = explode('=', $line, 2);
        $envVars[trim($key)] = trim($value);
    }
}

$host = $envVars['DB_HOST'] ?? 'localhost';
$database = $envVars['DB_DATABASE'] ?? '';
$username = $envVars['DB_USERNAME'] ?? '';
$password = $envVars['DB_PASSWORD'] ?? '';

echo "Connecting to database: $database@$host\n";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connected successfully!\n\n";
    
    // Run the ALTER TABLE command
    $sql = "ALTER TABLE subscriptions MODIFY COLUMN status ENUM('active', 'expired', 'cancelled', 'pending') DEFAULT 'pending'";
    
    echo "Executing: $sql\n";
    $pdo->exec($sql);
    
    echo "✅ Status column updated successfully!\n\n";
    
    // Verify the change
    $stmt = $pdo->query("SHOW COLUMNS FROM subscriptions LIKE 'status'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "Column details:\n";
    print_r($result);
    
    echo "\n✅ Migration completed successfully!\n";
    echo "⚠️  IMPORTANT: Delete this file after running!\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
