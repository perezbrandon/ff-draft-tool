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


$factory->define(App\Team::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->name,
        'full_name' => $faker->name,
    ];
});

$factory->define(App\Game::class, function (Faker\Generator $faker) {
    return [
        'game_id' => $faker->randomDigit(10),
        'game_week' => $faker->randomDigit(10),
        'game_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'away_team' => $faker->name,
        'home_team' => $faker->name,
    ];
});


$factory->define(App\ByeWeek::class, function (Faker\Generator $faker) {
    return [
        'bye_week' => $faker->randomDigit(10),
        'team_code' => $faker->name,
        'team_name' => $faker->name,
    ];
});



$factory->define(App\Player::class, function (Faker\Generator $faker) {
    return [
        'player_id' => $faker->randomDigit(10),
        'active' => true,
        'jersey' => $faker->randomDigit(10),
        'fname' => $faker->name,
        'lname' => $faker->name,
        'display_name' => $faker->name,
        'team' => $faker->name,
        'position' => $faker->name,
        'height' => $faker->name,
        'weight' => $faker->name,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});

$factory->define(App\DraftProjection::class, function (Faker\Generator $faker) {
    return [
        'player_id' => $faker->randomDigit(10),
        'completions' => $faker->randomDigit(10),
        'attempts' => $faker->randomDigit(10),
        'passing_yards' => $faker->randomDigit(10),
        'passing_td' => $faker->randomDigit(10),
        'passing_int' => $faker->randomDigit(10),
        'rush_yards' => $faker->randomDigit(10),
        'rush_td' => $faker->randomDigit(10),
        'fantasy_points' => $faker->randomDigit(10),
        'display_name' => $faker->name,
        'team' => $faker->name
    ];
});
