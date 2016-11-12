<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_admin = Role::where('name','Admin')->first();
        $role_user = Role::where('name','User')->first();

        $user = new \App\Models\User();
        $user->name = "Name";
        $user->surname = "Surname";
        $user->username = "DaAdmin";
        $user->email = "whatever@hotmail.com";
        $user->password = bcrypt('Test12345!');
        $user->activated = true;
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
