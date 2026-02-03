<?php

/**
 * Test script to verify all admin logins
 * Run with: php test-admin-logins.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "🔐 Testing Admin Login Credentials\n";
echo "==================================\n\n";

$testAccounts = [
    ['email' => 'admin@talib.com', 'name' => 'Admin', 'password' => 'admin123'],
    ['email' => 'shadi_aldabbas@hotmail.com', 'name' => 'Shadi Aldabbas', 'password' => 'admin123'],
    ['email' => 'mrhalzby45@gmail.com', 'name' => 'Admin User', 'password' => 'admin123'],
    ['email' => 'jadallah.neamah@gmail.com', 'name' => 'Jadallah Neamah', 'password' => 'admin123'],
];

$allPassed = true;

foreach ($testAccounts as $account) {
    echo "Testing: {$account['name']} ({$account['email']})\n";
    
    $user = User::where('email', $account['email'])->first();
    
    if (!$user) {
        echo "  ❌ FAIL: User not found in database\n\n";
        $allPassed = false;
        continue;
    }
    
    if ($user->role !== 'admin') {
        echo "  ❌ FAIL: User role is '{$user->role}', expected 'admin'\n\n";
        $allPassed = false;
        continue;
    }
    
    if ($user->status !== 'active') {
        echo "  ❌ FAIL: User status is '{$user->status}', expected 'active'\n\n";
        $allPassed = false;
        continue;
    }
    
    if (!Hash::check($account['password'], $user->password)) {
        echo "  ❌ FAIL: Password does not match\n\n";
        $allPassed = false;
        continue;
    }
    
    echo "  ✅ PASS: All checks passed\n";
    echo "     - Role: {$user->role}\n";
    echo "     - Status: {$user->status}\n";
    echo "     - Email Verified: " . ($user->email_verified_at ? 'Yes' : 'No') . "\n\n";
}

echo "==================================\n";
if ($allPassed) {
    echo "✅ All admin accounts are configured correctly!\n";
    echo "You can now login with:\n";
    echo "  - Email: [any of the above]\n";
    echo "  - Password: admin123\n";
} else {
    echo "❌ Some admin accounts have issues. Please check the output above.\n";
}
