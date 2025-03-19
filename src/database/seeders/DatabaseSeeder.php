<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = \App\Models\User::factory()->create(['email' => 'test@example.com']);
        \App\Models\WeightLog::factory(35)->create(['user_id' => $user->id]);
        \App\Models\WeightTarget::factory()->create(['user_id' => $user->id]);
    }
}
