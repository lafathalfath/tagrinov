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
        DB::table('pilihan_pertanian')->insert($pilihan_pertanian);
    }
}
