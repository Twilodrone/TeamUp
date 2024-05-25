<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() : void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('task_id');
            $table->text('title');
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->timestamps();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->index('task_id');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('tasks');
    }
};