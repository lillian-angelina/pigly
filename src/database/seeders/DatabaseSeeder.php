<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // すでに存在する場合は新たに作成せず取得
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'テストユーザー',
                'password' => bcrypt('password'),
            ]
        );
        
        // WeightLogsTableSeederを実行
        $this->call(WeightLogsTableSeeder::class);

        // ユーザーに紐づくWeightLogsとWeightTargetを作成
        WeightLog::factory(7)->create(['user_id' => $user->id]);
        WeightTarget::factory()->create(['user_id' => $user->id]);
    }
}
