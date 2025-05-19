<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Check if this is initial seeding
        try {
            $hasUsers = DB::table('users')->exists();
        } catch (\Exception $e) {
            $hasUsers = false;
        }

        // Only seed if tables don't exist or are empty
        if (!$hasUsers) {
            // Run seeders in correct order
            $this->call([
                UserSeeder::class,
                CategorySeeder::class,
                ProductSeeder::class,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
