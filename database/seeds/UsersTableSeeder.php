<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $user=factory(User::class)
                ->times(10)
                ->create();

            $user=User::find(1);
            $user->assignRole('Founder');

    }
}
