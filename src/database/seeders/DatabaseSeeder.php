<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
    \App\Models\User::factory()->create([
        'name' => 'admin',
        'email' => 'admin@example.com',
    ]);

    $this->call([
        CategoriesTableSeeder::class,
        ContactSeeder::class,
    ]);
    }
}
