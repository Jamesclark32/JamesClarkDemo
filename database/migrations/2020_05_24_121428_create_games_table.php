<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('game_status_id');

            $table->dateTime('started_at')->nullable();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('game_status_id')->references('id')->on('game_statuses');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
}
