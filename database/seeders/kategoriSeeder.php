<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            ['id' => 1, 'nama' => 'Tanaman'],
            ['id' => 2, 'nama' => 'Hewan'],
            ['id' => 3, 'nama' => 'Jamur']
        ];
        DB::table('kategori')->insert($kategori);
    }
}