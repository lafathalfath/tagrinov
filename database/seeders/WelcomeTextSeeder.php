<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WelcomeTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $welcome_text = [
            [
                'title1' => 'Selamat Datang di',
                'title2' => 'Taman Agro Standar',
                'description' => 'Nikmati keindahan alam dan belajar lebih banyak tentang berbagai jenis tanaman yang ada di taman kami. Dengan berbagai fitur interaktif, Anda bisa memindai barcode pada setiap tanaman untuk mendapatkan informasi lebih detail, serta memantau stok benih yang tersedia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('welcome_text')->insert($welcome_text);
    }
}
