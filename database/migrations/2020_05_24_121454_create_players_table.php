<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');

            $table->unsignedTinyInteger('height');//Store in centimeters
            $table->unsignedTinyInteger('weight');//Store in kilograms
            $table->unsignedTinyInteger('number');

            //Likely other stats to record. born_at? home_city_id? etc.

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
}
