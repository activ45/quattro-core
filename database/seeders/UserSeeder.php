<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'first_name' => 'Batuhan',
            'last_name' => 'ok',
            'email' => 'asd@asd.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now()
        ])->syncRoles('admin');

        User::create([
            'first_name' => 'kaan',
            'last_name' => 'ok',
            'email' => 'asd1@asd.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now()
        ]);
        User::create([
            'first_name' => 'tunahan',
            'last_name' => 'ok',
            'email' => 'asd2@asd.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now()
        ]);
    }
}
