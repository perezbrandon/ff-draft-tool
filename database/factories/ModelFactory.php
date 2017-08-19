<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\PprDraftRanking::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'position' => $faker->name,
        'display_name' => $faker->name,
        'fname' => $faker->name,
        'lname' => $faker->name,
        'position' => $faker->name,
        'team' => $faker->name,
        'bye_week' => $faker->randomDigit(10),
        'nerd_rank' => $faker->randomDigit(10),
        'position_rank' => $faker->randomDigit(10),
        'overall_rank' => $faker->randomDigit(10),
        'player_id' => $faker->randomDigit(10),
    ];
});
