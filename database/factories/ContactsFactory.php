<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Contacts;
use Faker\Generator as Faker;

$factory->define(Contacts::class, function (Faker $faker) {
    return [
        'phone_orange' => $faker->mobileNumber,
        'phone2' => $faker->mobileNumber,
        'phone3' => $faker->mobileNumber,
    ];
});
