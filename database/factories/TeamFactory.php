<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->state . ' Team',
        'description' => $faker->text(500),
    ];
});
