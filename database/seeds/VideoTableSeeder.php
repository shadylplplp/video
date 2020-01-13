<?php

use Illuminate\Database\Seeder;
use App\Video;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $comment=factory(Video::class)
            ->times(1000)
            ->create();
    }
}
