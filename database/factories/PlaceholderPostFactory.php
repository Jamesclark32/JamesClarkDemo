<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PlaceholderPost;
use Faker\Generator as Faker;

$factory->define(PlaceholderPost::class, function (Faker $faker) {
    return [
        'placeholder_user_id' => factory(\App\Models\PlaceholderUser::class)->create()->id,
        'title' => $faker->word,
        'body' => $faker->sentence,
        'remote_post_id' => $faker->unique()->numberBetween(1, 1000),
        'remote_user_id' => $faker->unique()->numberBetween(1, 1000),
        'fetched_at' => $faker->dateTimeBetween('-10 days', '-1 minute'),
    ];
});
