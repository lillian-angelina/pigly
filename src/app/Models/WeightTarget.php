<?php

// app/Models/WeightTarget.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightTarget extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'target_weight'];

    // ユーザーへの逆リレーションを設定
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
