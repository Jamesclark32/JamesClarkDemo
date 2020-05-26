<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceholderPostsTable extends Migration
{
    public function up(): void
    {
        Schema::create('placeholder_posts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('placeholder_user_id')->nullable();

            $table->string('title')->nullable();
            $table->longText('body')->nullable();

            $table->unsignedBigInteger('remote_post_id');
            $table->unsignedBigInteger('remote_user_id');

            $table->dateTime('fetched_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('title');

            $table->unique('remote_post_id');

            $table->foreign('placeholder_user_id')->references('id')->on('placeholder_users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('placeholder_posts');
    }
}
