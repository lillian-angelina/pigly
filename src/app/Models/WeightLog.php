<?php

// app/Models/WeightLog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'weight', 'calories', 'exercise_time', 'exercise_content'];

    public function user()
    {
        WeightLog::create([
            'user_id' => auth()->id(), // ログイン中のユーザーIDをセット
            'date' => now(),
            'weight' => 70.5,
            'calories' => 2000,
            'exercise_time' => '01:00:00',
            'exercise_content' => 'Jogging',
        ]);
        
        return $this->belongsTo(User::class);
    }
}