<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id'=>mt_rand(1,10),
        'video_id'=>mt_rand(1,100),
        'is_delete'=>0,
        'content'=>$faker->text,
    ];
});
