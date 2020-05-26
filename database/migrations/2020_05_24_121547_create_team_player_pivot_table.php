<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamPlayerPivotTable extends Migration
{

    public function up(): void
    {
        Schema::create('team_player', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('player_id');

            $table->unsignedTinyInteger('number');

            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();

            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('player_id')->references('id')->on('players');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_player');
    }
}
