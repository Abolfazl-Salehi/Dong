<?php

namespace Database\Seeders;

use App\Models\Friend;
use Illuminate\Database\Seeder;

class FriendSeeder extends Seeder
{
    public function run(): void
    {
        Friend::create([
            'user_1' => 1,
            'user_2' => 2,
        ]);

        Friend::create([
            'user_1' => 2,
            'user_2' => 1,
        ]);
    }
}
