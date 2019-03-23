<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'akmalzamel@gmail.com',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now()
        ]);

        /* 
        $user = DB::table('users')->where('name', 'Super Admin')->first();
        $role = DB::table('roles')->where('name', 'admin')->first();

        DB::table('model_has_roles')->insert([
            'role_id' => $role->id,
            'model_type' => 'APP/user',
            'model_id' => $user->id,
        ]); */

        /* $user = User::create([
            'name' => 'Super Admin',
            'email' => 'akmalzamel@gmail.com',
            'password' => bcrypt('12345678'),
        ]);*/

        $user = User::where('name','Super Admin') -> first();
        $user->assignRole('admin'); 
    }
}
