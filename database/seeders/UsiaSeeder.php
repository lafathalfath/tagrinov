<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usia = [
            ['id' => 1, 'nama' => '<20'],
            ['id' => 2, 'nama' => '20-29'],
            ['id' => 3, 'nama' => '30-39'],
            ['id' => 4, 'nama' => '40-49'],
            ['id' => 5, 'nama' => '>50'],
        ];
        DB::table('usia')->insert($usia);
    }
}
