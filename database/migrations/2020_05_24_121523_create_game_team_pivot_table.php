<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTeamPivotTable extends Migration
{

    public function up(): void
    {
        Schema::create('game_team', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('team_id');

            $table->boolean('is_home_venue')->nullable();
            $table->boolean('is_winner')->nullable();
            $table->unsignedTinyInteger('points');

            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_team');
    }
}
