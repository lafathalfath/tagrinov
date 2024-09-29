<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pekerjaan = [
            ['nama' => 'PNS'],
            ['nama' => 'TNI'],
            ['nama' => 'POLRI'],
            ['nama' => 'Swasta'],
            ['nama' => 'Wirausaha'],
            ['nama' => 'Guru'],
            ['nama' => 'Siswa'],
            ['nama' => 'Mahasiswa'],
            ['nama' => 'Lainnya'],
        ];
        DB::table('pekerjaan')->insert($pekerjaan);
    }
}
