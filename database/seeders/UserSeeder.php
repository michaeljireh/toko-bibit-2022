<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
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
        $admin = User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'a@a',
            'email_verified_at' => today(),
            'password' => bcrypt('1'),
            'api_token' => Str::random(40),
            'created_at' => today(),
            'updated_at' => today(),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'id' => 2,
            'name' => 'Akun Member',
            'email' => 'member@gmail.com',
            'email_verified_at' => today(),
            'password' => Hash::make('1234qwer'),
            'api_token' => Str::random(40),
            'created_at' => today(),
            'updated_at' => today(),
        ]);

        $user->assignRole('user');

        $user = User::create([
            'id' => 3,
            'name' => 'Sulai',
            'email' => 'sulai@gmail.com',
            'email_verified_at' => today(),
            'password' => Hash::make('1234qwer'),
            'api_token' => Str::random(40),
            'created_at' => today(),
            'updated_at' => today(),
        ]);

        $user->assignRole('user');


        $user = User::create([
            'id' => 4,
            'name' => 'Edo',
            'email' => 'edo@gmail.com',
            'email_verified_at' => today(),
            'password' => Hash::make('1234qwer'),
            'api_token' => Str::random(40),
            'created_at' => today(),
            'updated_at' => today(),
        ]);

        $user->assignRole('user');

        $user = User::create([
            'id' => 5,
            'name' => 'Suhu',
            'email' => 'suhu@gmail.com',
            'email_verified_at' => today(),
            'password' => Hash::make('1234qwer'),
            'api_token' => Str::random(40),
            'created_at' => today(),
            'updated_at' => today(),
        ]);

        $user->assignRole('user');
    }
}
