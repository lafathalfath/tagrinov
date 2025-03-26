<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PilihanPertanianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pilihan_pertanian = [
            ['id' => 1, 'nama' => 'Konsultasi'],
            ['id' => 2, 'nama' => 'Agroeduwisata'],
            ['id' => 3, 'nama' => 'Pelatihan/Bimbingan Teknis'],
            ['id' => 4, 'nama' => 'Magang'],
        ];
        foreach ($pilihan_pertanian as $item) {
            DB::table('pilihan_pertanian')->updateOrInsert(
                ['id' => $item['id']], // Cek apakah ID sudah ada
                ['nama' => $item['nama']] // Jika ada, update nama saja
            );
        }
    }
}