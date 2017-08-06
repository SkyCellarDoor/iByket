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
    $faker = Faker\Factory::create('ru_RU');

    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'role' => 1,
        'storage_id' => 1,
        'bill' => $faker->numberBetween($min = -10000, $max = 10000),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\CashRoutesModel::class, function (Faker\Generator $faker) {
    static $password;
    $faker = Faker\Factory::create('ru_RU');

    return [
        'user_id' => $faker->numberBetween($min = 100, $max = 200),
        'type' => $faker->numberBetween($min = 1, $max = 2),
        'value' => $faker->numberBetween($min = -10000, $max = 10000),
        'comments' => $faker->text($maxNbChars = 200),
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});