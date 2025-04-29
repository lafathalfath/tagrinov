<?php

namespace Database\Seeders;

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
        $users = [
            [
                'name' => 'BSIP Penerapan',
                'email' => 'bsippenerapan@gmail.com',
                'no_hp' => '081234567890',
                'password' => Hash::make('tagrinov2024'),
                'role' => 'admin',
            ],
            [
                'name' => 'Husni Mubarok',
                'email' => 'husniramadhan@apps.ipb.ac.id',
                'no_hp' => '082299702860',
                'password' => Hash::make('tagrinov2025'),
                'role' => 'tim_kerja',
            ],
        ];

        foreach ($users as $user) {
            // Cek apakah email sudah ada
            if (!DB::table('users')->where('email', $user['email'])->exists()) {
                DB::table('users')->insert($user);
            }
        }
    }
}
