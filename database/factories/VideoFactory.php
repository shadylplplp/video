<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'description'=>$faker->text,
        'video_path'=>env('APP_URL').'/uploads/video/video/202001/12/1320_1578840889.mp4',
        'video_image'=>env('APP_URL').'/uploads/video/video/202001/12/1320_1578840889.jpg',
        'video_type'=>mt_rand(1,7),
        'user_id'=>mt_rand(1,10),
        'is_reprint'=>mt_rand(0,1),
        'state'=>mt_rand(1,3)
    ];
});
