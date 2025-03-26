<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_pengunjung = [
            ['id' => 1, 'nama' => 'Perorangan'],
            ['id' => 2, 'nama' => 'Perkelompok'],
        ];
        foreach ($jenis_pengunjung as $item) {
            DB::table('jenis_pengunjung')->updateOrInsert(
                ['id' => $item['id']], // Cek apakah ID sudah ada
                ['nama' => $item['nama']] // Jika ada, update nama saja
            );
        }
    }
}