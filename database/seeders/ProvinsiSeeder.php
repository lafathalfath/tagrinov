<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinsi = [
            ['nama' => 'Aceh'],
            ['nama' => 'Sumatera Utara'],
            ['nama' => 'Sumatera Selatan'],
            ['nama' => 'Sumatera Barat'],
            ['nama' => 'Bengkulu'],
            ['nama' => 'Riau'],
            ['nama' => 'Kepulauan Riau'],
            ['nama' => 'Jambi'],
            ['nama' => 'Lampung'],
            ['nama' => 'Bangka Belitung'],
            ['nama' => 'Kalimantan Barat'],
            ['nama' => 'Kalimantan Timur'],
            ['nama' => 'Kalimantan Selatan'],
            ['nama' => 'Kalimantan Tengah'],
            ['nama' => 'Kalimantan Utara'],
            ['nama' => 'Banten'],
            ['nama' => 'DKI Jakarta'],
            ['nama' => 'Jawa Barat'],
            ['nama' => 'Jawa Tengah'],
            ['nama' => 'Daerah Istimewa Yogyakarta'],
            ['nama' => 'Jawa Timur'],
            ['nama' => 'Bali'],
            ['nama' => 'Nusa Tenggara Timur'],
            ['nama' => 'Nusa Tenggara Barat'],
            ['nama' => 'Gorontalo'],
            ['nama' => 'Sulawesi Barat'],
            ['nama' => 'Sulawesi Tengah'],
            ['nama' => 'Sulawesi Utara'],
            ['nama' => 'Sulawesi Tenggara'],
            ['nama' => 'Sulawesi Selatan'],
            ['nama' => 'Maluku Utara'],
            ['nama' => 'Maluku'],
            ['nama' => 'Papua Barat'],
            ['nama' => 'Papua'],
            ['nama' => 'Papua Tengah'],
            ['nama' => 'Papua Pegunungan'],
            ['nama' => 'Papua Selatan'],
            ['nama' => 'Papua Barat Daya'],
        ];

        DB::table('provinsi')->insert($provinsi);
    }
}
