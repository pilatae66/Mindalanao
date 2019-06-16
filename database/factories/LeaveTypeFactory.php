<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\LeaveType;
use Faker\Generator as Faker;

$factory->define(LeaveType::class, function (Faker $faker) {
    return [
        'name' => 'Maternity',
        'days_allowed' => 105
    ];
});
