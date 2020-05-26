<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventGamePivotTable extends Migration
{
    public function up(): void
    {
        Schema::create('event_game', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('player_id');

            $table->dateTime('occurred_at');

            $table->string('details')->nullable();

            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('player_id')->references('id')->on('players');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_game');
    }
}
