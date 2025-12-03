<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Reset admin password
$newPassword = 'password123';
$hashedPassword = Hash::make($newPassword);

$updated = DB::table('users')
    ->where('email', 'admin@mcorder.com')
    ->update([
        'password' => $hashedPassword,
        'is_approved' => 1
    ]);

echo "Updated admin user: $updated rows\n";
echo "Email: admin@mcorder.com\n";
echo "Password: password123\n";
echo "Is Approved: 1\n\n";

// Verify
$admin = DB::table('users')
    ->where('email', 'admin@mcorder.com')
    ->first(['id', 'name', 'email', 'role', 'is_approved']);

echo "Verifikasi:\n";
echo "ID: {$admin->id}\n";
echo "Name: {$admin->name}\n";
echo "Email: {$admin->email}\n";
echo "Role: {$admin->role}\n";
echo "Is Approved: {$admin->is_approved}\n";
