<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    public function weightLogs()
    {
        return $this->hasMany(WeightLog::class);
    }

    public function weightTargets()
    {
        return $this->hasOne(WeightTarget::class); // 1対1のリレーション
    }
}
