<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $uuids = [
            '550e8400-e29b-41d4-a716-446655440001',
            '450e8400-e29b-41d4-a716-446655440000',
            '350e8400-e29b-41d4-a716-446655440002',
            '250e8400-e29b-41d4-a716-446655440004',
            '150e8400-e29b-41d4-a716-446655440005',
        ];

        foreach ($uuids as $uuid) {
            User::factory()->create([
                'id' => $uuid,
                'name' => 'User ' . substr($uuid, 0, 8),
                'email' => 'user' . substr($uuid, 0, 8) . '@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        for ($i = 0; $i < 50; $i++) {
            $book = Book::factory()->create([
                'borrowed_by' => $uuids[array_rand($uuids)], // Randomly select a user as the borrower
                'returned_by' => $uuids[array_rand($uuids)], // Randomly select a user as the returner
            ]);
        }
    }
}
