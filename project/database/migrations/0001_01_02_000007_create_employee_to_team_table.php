<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_to_team', function (Blueprint $table) {
            $table->bigIncrements('employee_to_team_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('team_id')->references('team_id')->on('teams');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->foreign('role_id')->references('role_id')->on('roles');
        });

        Schema::table('employee_to_team', function (Blueprint $table) {
            $table->index('team_id');
            $table->index('employee_id');
            $table->index('role_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_to_team');
    }
};
