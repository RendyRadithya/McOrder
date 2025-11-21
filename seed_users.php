<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== RESET & SEED USERS ===\n\n";

// Hapus semua user
echo "🗑️  Menghapus semua user...\n";
User::truncate();
echo "✅ Semua user berhasil dihapus!\n\n";

// Data user baru
$users = [
    [
        'name' => 'Manager Stock',
        'email' => 'manager@mcorder.com',
        'password' => 'password123',
        'role' => 'manager_stock',
        'phone' => '081234567890',
        'store_name' => 'McDonald\'s Citra Garden',
    ],
    [
        'name' => 'Vendor Sadikun',
        'email' => 'vendor@mcorder.com',
        'password' => 'password123',
        'role' => 'vendor',
        'phone' => '081234567891',
        'store_name' => 'PT Sadikun Gas',
    ],
    [
        'name' => 'Admin McOrder',
        'email' => 'admin@mcorder.com',
        'password' => 'password123',
        'role' => 'admin',
        'phone' => '081234567892',
        'store_name' => 'McOrder HQ',
    ],
];

// Buat user baru
echo "👤 Membuat 3 akun baru...\n\n";

foreach ($users as $userData) {
    $user = User::create([
        'name' => $userData['name'],
        'email' => $userData['email'],
        'password' => Hash::make($userData['password']),
        'role' => $userData['role'],
        'phone' => $userData['phone'],
        'store_name' => $userData['store_name'],
    ]);
    
    echo "✅ User berhasil dibuat:\n";
    echo "   Nama     : " . $user->name . "\n";
    echo "   Email    : " . $user->email . "\n";
    echo "   Password : " . $userData['password'] . "\n";
    echo "   Role     : " . $user->role . "\n";
    echo "   Phone    : " . $user->phone . "\n";
    echo "   Store    : " . $user->store_name . "\n";
    echo "\n";
}

echo "=================================\n";
echo "✅ SELESAI!\n";
echo "Total users: " . User::count() . "\n\n";
echo "📝 KREDENSIAL LOGIN:\n";
echo "-----------------------------------\n";
echo "1. Manager Stock\n";
echo "   Email: manager@mcorder.com\n";
echo "   Pass : password123\n\n";
echo "2. Vendor\n";
echo "   Email: vendor@mcorder.com\n";
echo "   Pass : password123\n\n";
echo "3. Admin\n";
echo "   Email: admin@mcorder.com\n";
echo "   Pass : password123\n";
echo "=================================\n";
