<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Followers;
use Faker\Generator as Faker;

$factory->define(Followers::class, function (Faker $faker) {
    return [
        'followed_id'=>mt_rand(1,10),
        'follower_id'=>mt_rand(1,10),
    ];
});
