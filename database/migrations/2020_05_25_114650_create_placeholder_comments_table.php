<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceholderCommentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('placeholder_comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('placeholder_post_id')->nullable();

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->longText('body')->nullable();

            $table->unsignedBigInteger('remote_comment_id');
            $table->unsignedBigInteger('remote_post_id');

            $table->dateTime('fetched_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
            $table->index('email');

            $table->unique('remote_comment_id');

            $table->foreign('placeholder_post_id')->references('id')->on('placeholder_posts');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('placeholder_comments');
    }
}
