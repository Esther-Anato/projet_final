<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CollectionSeeder::class,
            ProduitSeeder::class,
            FaqSeeder::class,
        ]);

        \App\Models\User::firstOrCreate(
            ['email' => 'admin@blacjoyaux.com'],
            ['name' => 'Admin Blac Joyaux', 'password' => bcrypt('Admin2026')]
        );
    }
}
