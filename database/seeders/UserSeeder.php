<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'کاربر تست',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        User::factory()->count(10)->create(); 
    }
}

