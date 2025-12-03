<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

// Check if column exists
$columns = DB::select("DESCRIBE users");
echo "Kolom di tabel users:\n";
foreach ($columns as $column) {
    echo "- {$column->Field} ({$column->Type})\n";
}

echo "\n\n";

// Update admin user
$updated = DB::table('users')
    ->where('email', 'admin@mcorder.com')
    ->update(['is_approved' => 1]);

echo "Updated $updated rows\n\n";

// Check admin again
$admin = DB::table('users')
    ->where('email', 'admin@mcorder.com')
    ->first();

echo "Admin user:\n";
echo "Name: {$admin->name}\n";
echo "Email: {$admin->email}\n";
echo "Role: {$admin->role}\n";
echo "Is Approved: {$admin->is_approved}\n";
