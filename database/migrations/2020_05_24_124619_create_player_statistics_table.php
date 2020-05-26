<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//@TODO: Really need to vet this stats list and their
//possible data range against more expert knowledge

//@TODO: May need to track stats per team stint
//eg career points vs. points at current team
//if needed, refactor this to have two parent
//tables - career stats with player_id only
//and team status with added team_player fk

class CreatePlayerStatisticsTable extends Migration
{
    public function up(): void
    {
        Schema::create('player_statistics', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('player_id');

            $table->unsignedSmallInteger('points');
            $table->unsignedSmallInteger('rebounds');
            $table->unsignedSmallInteger('assists');
            $table->unsignedSmallInteger('blocks');
            $table->unsignedSmallInteger('steals');
            $table->unsignedSmallInteger('turnovers');
            $table->unsignedSmallInteger('three_point_shots');
            $table->unsignedSmallInteger('three_point_made');
            $table->unsignedSmallInteger('free_throw_shots');
            $table->unsignedSmallInteger('free_throw_made');
            $table->unsignedSmallInteger('shots_taken');
            $table->unsignedSmallInteger('shots_made');

            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('players');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_statistics');
    }
}
