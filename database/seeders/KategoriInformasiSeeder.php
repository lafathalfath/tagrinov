<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriInformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori_informasi = [
            ['id' => 1, 'nama' => 'Pertanian'],
            ['id' => 2, 'nama' => 'Anggaran dan Keuangan'],
            ['id' => 3, 'nama' => 'Kepegawaian'],
            ['id' => 4, 'nama' => 'Hukum dan Perundang-undangan'],
            ['id' => 5, 'nama' => 'Pengadaan Barang dan Jasa'],
            ['id' => 6, 'nama' => 'Lain-lain'],
        ];
        foreach ($kategori_informasi as $item) {
            DB::table('kategori_informasi')->updateOrInsert(
                ['id' => $item['id']], // Cek apakah ID sudah ada
                ['nama' => $item['nama']] // Jika ada, update nama saja
            );
        }
    }
}
