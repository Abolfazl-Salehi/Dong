<?php

namespace Database\Seeders;

use App\Models\Friend;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        $user2 = User::factory()->create([
            'name' => 'Test User2',
            'email' => 'test2@example.com',
            'password' => Hash::make('password')
        ]);


        Friend::query()->create([
            'user_1' => $user1->id,
            'user_2' => $user2->id,
        ]);
    }
}
