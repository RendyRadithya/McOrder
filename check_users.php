<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "=== DAFTAR AKUN TERDAFTAR ===\n\n";
echo "Total Users: " . User::count() . "\n\n";

$users = User::all();

if ($users->isEmpty()) {
    echo "Belum ada akun yang terdaftar.\n";
} else {
    foreach ($users as $user) {
        echo "-----------------------------------\n";
        echo "ID         : " . $user->id . "\n";
        echo "Nama       : " . $user->name . "\n";
        echo "Email      : " . $user->email . "\n";
        echo "Role       : " . ($user->role ?? '-') . "\n";
        echo "Telepon    : " . ($user->phone ?? '-') . "\n";
        echo "Store      : " . ($user->store_name ?? '-') . "\n";
        echo "Terdaftar  : " . $user->created_at->format('d-m-Y H:i:s') . "\n";
        echo "\n";
    }
}
