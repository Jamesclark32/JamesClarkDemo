<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceholderUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('placeholder_users', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();

            $table->unsignedBigInteger('remote_user_id');

            $table->dateTime('fetched_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
            $table->index('username');
            $table->index('email');

            $table->unique('remote_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('placeholder_users');
    }
}
