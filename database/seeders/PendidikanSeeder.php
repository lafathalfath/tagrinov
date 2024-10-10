<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendidikan = [
            ['id' => 1, 'nama' => 'SD'],
            ['id' => 2, 'nama' => 'SMP'],
            ['id' => 3, 'nama' => 'SMA'],
            ['id' => 4, 'nama' => 'D3'],
            ['id' => 5, 'nama' => 'D4'],
            ['id' => 6, 'nama' => 'S1'],
            ['id' => 7, 'nama' => 'S2'],
            ['id' => 8, 'nama' => 'S3'],
        ];
        DB::table('pendidikan')->insert($pendidikan);
    }
}
