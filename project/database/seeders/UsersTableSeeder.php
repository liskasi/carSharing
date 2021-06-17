<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'role' => 'Administrator',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret00'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Zane',
            'role' => 'User',
            'email' => 'test1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret01'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Lisa',
            'role' => 'User',
            'email' => 'test2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret02'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Robin',
            'role' => 'User',
            'email' => 'test3@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret03'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Igor',
            'role' => 'User',
            'email' => 'test4@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret04'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
