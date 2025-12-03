<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$user = App\Models\User::where('email', 'admin@mcorder.com')->first();

if ($user) {
    echo "User ditemukan:\n";
    echo "ID: " . $user->id . "\n";
    echo "Name: " . $user->name . "\n";
    echo "Email: " . $user->email . "\n";
    echo "Role: " . $user->role . "\n";
    echo "Is Approved: " . ($user->is_approved ? 'true' : 'false') . "\n";
    echo "Password Hash: " . substr($user->password, 0, 20) . "...\n";
} else {
    echo "User admin@mcorder.com tidak ditemukan!\n";
}

echo "\n\nSemua users:\n";
$allUsers = App\Models\User::all(['id', 'name', 'email', 'role', 'is_approved']);
foreach ($allUsers as $u) {
    echo "- {$u->name} ({$u->email}) - Role: {$u->role} - Approved: " . ($u->is_approved ? 'Yes' : 'No') . "\n";
}
