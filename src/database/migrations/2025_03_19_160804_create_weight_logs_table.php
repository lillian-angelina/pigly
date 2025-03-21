<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/xxxx_xx_xx_create_weight_logs_table.php
class CreateWeightLogsTable extends Migration
{
    public function up()
    {
        Schema::create('weight_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('date');
            $table->decimal('weight', 4, 1);
            $table->integer('calories')->nullable();
            $table->time('exercise_time')->nullable();
            $table->text('exercise_content')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('weight_logs');

        Schema::table('weight_logs', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}