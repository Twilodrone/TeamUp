<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks_to_team_employees', function (Blueprint $table) {
            $table->bigIncrements('team_tasks_id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('employee_id');
            $table->boolean('completed');
            $table->timestamps();

            $table->foreign('task_id')->references('task_id')->on('tasks');
            $table->foreign('team_id')->references('team_id')->on('teams');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
        });

        Schema::table('tasks_to_team_employees', function (Blueprint $table) {
            $table->index('task_id');
            $table->index('team_id');
            $table->index('employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks_to_team_employees');
    }
};
