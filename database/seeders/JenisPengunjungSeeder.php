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
            ['id' => 1, 'nama' => 'Pelajar'],
            ['id' => 2, 'nama' => 'Umum'],
            ['id' => 3, 'nama' => 'Peneliti'],
        ];

        DB::table('jenis_pengunjung')->insert($jenis_pengunjung);
    }
}