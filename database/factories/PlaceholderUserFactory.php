<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PlaceholderUser;
use Faker\Generator as Faker;

$factory->define(PlaceholderUser::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'website' => $faker->url,
        'remote_user_id' => $faker->unique()->numberBetween(1, 1000),
        'fetched_at' => $faker->dateTimeBetween('-10 days', '-1 minute'),
    ];
});
