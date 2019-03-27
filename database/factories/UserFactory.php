<?php

use App\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'fullname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => null,
        'password' => bcrypt('12345678'),
        'phone_number' => '0123456565',
        'address' => null,
        'created_at' => Carbon::now(),
        'remember_token' => Str::random(10)
    ];
});
