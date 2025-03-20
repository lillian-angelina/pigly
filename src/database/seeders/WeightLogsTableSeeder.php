<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\WeightLog;

class WeightLogsTableSeeder extends Seeder
{
    public function run()
    {
        // ユーザーを取得 (ユーザーIDが1と仮定)
        $userId = 1;

        // 開始日と終了日
        $startDate = Carbon::create(2023, 11, 19);
        $endDate = Carbon::create(2023, 11, 26);

        // 期間内の各日付についてシーディング
        while ($startDate <= $endDate) {
            WeightLog::create([
                'user_id' => $userId,
                'date' => $startDate->toDateString(),
                'weight' => 46.5,  // 体重
                'calories' => 1200,  // 食事摂取カロリー
                'exercise_time' => '00:15',  // 運動時間
                'exercise_content' => 'ランニング 15分',  // 運動内容
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 次の日に進む
            $startDate->addDay();
        }
    }
}
