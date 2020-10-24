<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        //user
        factory(User::class, 5)->create();
        //profile
        User::all()->each(function ($user)
        {
            // $user->profile->save(factory(Profile::class)->make());
        });
        

    }
}
