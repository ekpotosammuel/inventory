<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Adminstrator', 'User'];

        foreach ($roles as $key => $value) {
            $already_exist = Role::where('name', $value)->first();
            if($already_exist == null){
                $role = new Role();
                $role->name = $value;
                $role->save();
            }
        }
    }
}
