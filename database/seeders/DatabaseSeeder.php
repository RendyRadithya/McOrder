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
        // generate sample products for vendors
        $this->call(ProductSeeder::class);

        // keep a simple test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        // seed order events for example orders (if any exist)
        if (class_exists(\Database\Seeders\OrderEventsSeeder::class)) {
            $this->call(\Database\Seeders\OrderEventsSeeder::class);
        }
    }
}
