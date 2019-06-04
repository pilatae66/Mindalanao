<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Position;
use Faker\Generator as Faker;

$factory->define(Position::class, function (Faker $faker) {
    return [
        'position' => $faker->jobTitle,
        'salary' => '1'
    ];
});
