<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('city_id');

            $table->string('name');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');

            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
}
