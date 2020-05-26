<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameStatusesTable extends Migration
{
    public function up(): void
    {
        Schema::create('game_statuses', function (Blueprint $table) {
            $table->id();

            $table->string('name');//e.g. pending, underway, completed
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_statuses');
    }
}
