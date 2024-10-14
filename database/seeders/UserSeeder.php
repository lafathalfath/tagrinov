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
                'name' => 'BSIP Penerapan', 
                'email' => 'bsippenerapan@gmail.com', 
                'no_hp' => '08121212',
                'password' => Hash::make('tagrinov2024'),
            ],
        ];

        DB::table('users')->insert($user);
    }
}