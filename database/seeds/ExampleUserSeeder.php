<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class ExampleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()->each(function ($user) {
            $user->assignRole('coach');
        });

        factory(App\User::class, 30)->create()->each(function ($user) {
            $user->assignRole('student');
        });
    }
}
