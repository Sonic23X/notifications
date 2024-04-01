<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\V1\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $sports = Category::factory()->create([
            'name' => 'Deportes'
        ]);

        $finances = Category::factory()->create([
            'name' => 'Finanzas'
        ]);

        $movies = Category::factory()->create([
            'name' => 'Peliculas'
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'suscribed_to' => json_encode([$sports->id, $finances->id]),
        ]);
    }
}
