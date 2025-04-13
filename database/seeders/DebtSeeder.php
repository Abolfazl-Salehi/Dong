<?php

namespace Database\Seeders;

use App\Models\DebtRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DebtRequest::create([

            'from_user_id' => 1,
            'to_user_id' => 2,
            'amount' => 100,
            'status' => 'pending'

        ]);
    }
}
