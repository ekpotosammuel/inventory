<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_roles = [
            [
                "user_id" => 1, // admin or system adminstrator
                "role_id" => 2 // user role
            ],
            [
                "user_id" => 3, // user
                "role_id" => 1 // adminstrator
            ],
            [
                "user_id" => 4, // user
                "role_id" => 2 // user role
            ],
            [
                "user_id" => 5, // user
                "role_id" => 2 // user role
            ]
        ];

        foreach ($user_roles as $key => $value) {
            # code...
            $user_id = $value['user_id'];
            $role_id = $value['role_id'];

            $already_exist = UserRole::where([['user_id', $user_id], ['role_id', $role_id]])->first();
            if($already_exist == null){
                $user_role = new UserRole();
                $user_role->user_id = $user_id;
                $user_role->role_id = $role_id;
                $user_role->save();
            }
        }
    }
}
