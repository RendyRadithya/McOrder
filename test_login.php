<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Hash;

$email = 'admin@mcorder.com';
$password = 'password123';

$user = App\Models\User::where('email', $email)->first();

if (!$user) {
    echo "User tidak ditemukan!\n";
    exit;
}

echo "User ditemukan: {$user->name}\n";
echo "Email: {$user->email}\n";
echo "Role: {$user->role}\n";
echo "Is Approved: " . ($user->is_approved ? 'Yes' : 'No') . "\n\n";

// Test password
if (Hash::check($password, $user->password)) {
    echo "✅ Password COCOK!\n";
    echo "Login seharusnya berhasil.\n";
} else {
    echo "❌ Password TIDAK COCOK!\n";
    echo "Ada masalah dengan password hash.\n\n";
    
    // Reset password
    $user->password = Hash::make($password);
    $user->save();
    
    echo "Password telah di-reset ke: password123\n";
    echo "Silakan coba login lagi.\n";
}
