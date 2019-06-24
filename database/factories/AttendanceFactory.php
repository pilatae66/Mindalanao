<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Attendance;
use Faker\Generator as Faker;
use App\User;

$factory->define(Attendance::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first(),
        'type' => array_random(['In', 'Out']),
        'created_at' => $faker->dateTimeThisMonth($max = 'now', $timezone = 'Asia/Manila')
    ];
});
