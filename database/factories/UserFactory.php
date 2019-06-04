<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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
        'firstname' => 'Liezel',
        'middlename' => 'Andrade',
        'lastname' => 'Ortega',
        'username' => 'liezelortega39',
        'email' => 'liezelortega39@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$C8NSqP3mKUjTPVtKKlpZReIPdcrwRbPAe6IsC3TSt8MLrRjGyVrdS', // babynakoh
        'remember_token' => Str::random(10),
    ];
});
