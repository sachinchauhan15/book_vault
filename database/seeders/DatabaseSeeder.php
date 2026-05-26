<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'API Demo User',
            'email' => 'demo@example.com',
            'password' => 'Password123',
        ]);

        Book::factory()->count(25)->create();
    }
}
