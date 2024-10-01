<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Primary Admin', 
                'email' => 'admin@gmail.com', 
                'no_hp' => '08121212',
                'password' => Hash::make('password'),
            ],
        ];

        DB::table('users')->insert($user);
    }
}