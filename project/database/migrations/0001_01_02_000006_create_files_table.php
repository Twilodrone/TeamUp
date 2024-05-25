<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('file_id');
            $table->string('file_name', 30);
            $table->text('file_path');
            $table->unsignedBigInteger('team_id');

            $table->foreign('team_id')->references('team_id')->on('teams');
        });

        Schema::table('files', function (Blueprint $table) {
            $table->index('team_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
