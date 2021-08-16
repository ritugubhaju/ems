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
        $user=User::create([
            'name'=>'Admin',
            'email'=>'admin@ems.com',
            'password'=>Hash::make('admin@ems'),
            'role'=>'admin'
        ]);

        $user=User::create([
            'name'=>'Student',
            'email'=>'student@ems.com',
            'password'=>Hash::make('student@ems'),
        ]);
    }
}
