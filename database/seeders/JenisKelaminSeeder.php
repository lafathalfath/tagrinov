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
        DB::table('jenis_kelamin')->insert($jenis_kelamin);
    }
}
