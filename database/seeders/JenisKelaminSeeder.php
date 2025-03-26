<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_kelamin = [
            ['id' => 1, 'nama' => 'Laki-laki'],
            ['id' => 2, 'nama' => 'Perempuan'],
        ];
        foreach ($jenis_kelamin as $item) {
            DB::table('jenis_kelamin')->updateOrInsert(
                ['id' => $item['id']], // Cek apakah ID sudah ada
                ['nama' => $item['nama']] // Jika ada, update nama saja
            );
        }
    }
}