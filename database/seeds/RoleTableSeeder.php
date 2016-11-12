<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $role_user = new Role();
        $role_user->name = "Admin";
        $role_user->description = "Admin";
        $role_user->save();

        $role_user = new Role();
        $role_user->name = "User";
        $role_user->description = "Normal user";
        $role_user->save();
    }
}
