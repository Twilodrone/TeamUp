<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('employee_id');
            $table->string('name', 50);
            $table->string('login', 20);
            $table->string('password', 20);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
