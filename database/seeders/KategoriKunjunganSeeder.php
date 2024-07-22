<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriKunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori_kunjungan = [
            ['id' => 1, 'nama' => 'Perorangan'],
            ['id' => 2, 'nama' => 'Rombongan'],
        ];

        DB::table('kategori_kunjungan')->insert($kategori_kunjungan);
    }
}
