<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default users (Admin, Manager Stock, Vendor)
        $this->call(UserSeeder::class);
        
        // generate sample products for vendors
        $this->call(ProductSeeder::class);

        // seed order events for example orders (if any exist)
        if (class_exists(\Database\Seeders\OrderEventsSeeder::class)) {
            $this->call(\Database\Seeders\OrderEventsSeeder::class);
        }
    }
}
