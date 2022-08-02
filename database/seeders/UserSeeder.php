<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'firstname' => "System",
                'lastname' => "Adminstrator",
                'email' => "admin@favour.com",
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
                'phone'=> "080127160258",
            ],
            [
                'firstname' => "John",
                'lastname' => "Doe",
                'email' => "johndoe@gmail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
                'phone'=> "080427160258",
            ],
            [
                'firstname' => "samuel",
                'lastname' => "bernard",
                'email' => "samuelbernard@gmail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
                'phone'=> "09024592013",
            ],
        ];

        foreach ($users as $key => $value) {
            $already_exist = User::where("email", $value['email'])->first();
            if($already_exist == null){
                $user = new User();
                $user->firstname = $value['firstname'];
                $user->lastname = $value['lastname'];
                $user->email = $value['email'];
                $user->email_verified_at = $value['email_verified_at'];
                $user->password = $value['password'];
                $user->remember_token = $value['remember_token'];
                $user->phone = $value['phone'];
                $user->save();
            }
        }

    }
}
