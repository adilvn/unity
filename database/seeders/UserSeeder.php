<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'fname' => 'Unity',
            'lname' => 'Admin',
            'email' => 'admin@unity.com',
            'password' => Hash::make('12345678'),
            'user_type' => 0,
            'status' => 1,
            'profile_pic' => asset('images/profile.png')
        ]);
    }
}
