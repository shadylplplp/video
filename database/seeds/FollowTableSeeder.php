<?php

use Illuminate\Database\Seeder;
use App\Followers;

class FollowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $follower=factory(Followers::class)
            ->times(15)
            ->create();
    }
}
