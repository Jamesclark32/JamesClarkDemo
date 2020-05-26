<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PlaceholderComment;
use Faker\Generator as Faker;

$factory->define(PlaceholderComment::class, function (Faker $faker) {
    return [
        'placeholder_post_id' => factory(\App\Models\PlaceholderPost::class)->create()->id,
        'name' => $faker->word,
        'email' => $faker->email,
        'body' => $faker->sentence,
        'remote_comment_id' => $faker->unique()->numberBetween(1, 1000),
        'remote_post_id' => $faker->unique()->numberBetween(1, 1000),
        'fetched_at' => $faker->dateTimeBetween('-10 days', '-1 minute'),
    ];
});
