<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/xxxx_xx_xx_create_weight_targets_table.php
class CreateWeightTargetsTable extends Migration
{
    public function up()
    {
        Schema::create('weight_targets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('target_weight', 4, 1);  // 目標体重 (nullableにしたければ、nullable()を追加)
            $table->timestamps();

            // 外部キー制約: user_id は users テーブルの id に紐付く
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');  // ユーザーが削除された場合、対応する目標体重も削除
        });
    }

    public function down()
    {
        // もしテーブルを削除する必要があれば
        Schema::dropIfExists('weight_targets');
    }
}