<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Semua Users di Database ===\n\n";

$users = App\Models\User::all();

if ($users->count() === 0) {
    echo "Tidak ada user di database!\n";
} else {
    foreach ($users as $user) {
        echo "ID: {$user->id}\n";
        echo "Name: {$user->name}\n";
        echo "Email: {$user->email}\n";
        echo "Role: {$user->role}\n";
        echo "Is Approved: " . ($user->is_approved ? 'Yes' : 'No') . "\n";
        echo "---\n";
    }
}

echo "\nTotal: " . $users->count() . " users\n";
