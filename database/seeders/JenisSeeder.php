<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            ['id' => 1, 'nama' => 'Tanaman Obat (TOGA)'],
            ['id' => 2, 'nama' => 'Tanaman Buah'],
            ['id' => 3, 'nama' => 'Tanaman Hias'],
            ['id' => 4, 'nama' => 'Tanaman Liar'],
            ['id' => 5, 'nama' => 'Tanaman Sayur'],
            ['id' => 6, 'nama' => 'Mamalia'],
            ['id' => 7, 'nama' => 'Pisces']
        ];
        foreach ($jenis as $item) {
            DB::table('jenis')->updateOrInsert(
                ['id' => $item['id']], // Cek apakah ID sudah ada
                ['nama' => $item['nama']] // Jika ada, update nama saja
            );
        }
    }
}