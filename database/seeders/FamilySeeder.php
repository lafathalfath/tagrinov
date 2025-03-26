<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $family = [
            ['id' => 1, 'nama' => 'Acanthaceae'],
            ['id' => 2, 'nama' => 'Amaranthaceae'],
            ['id' => 3, 'nama' => 'Amaryllidaceae'],
            ['id' => 4, 'nama' => 'Anacardiaceae'],
            ['id' => 5, 'nama' => 'Annonaceae'],
            ['id' => 6, 'nama' => 'Apocynaceae'],
            ['id' => 7, 'nama' => 'Asteraceae'],
            ['id' => 8, 'nama' => 'Basellaceae'],
            ['id' => 9, 'nama' => 'Bombacaceae'],
            ['id' => 10, 'nama' => 'Brassicaceae'],
            ['id' => 11, 'nama' => 'Cannaceae'],
            ['id' => 12, 'nama' => 'Caricaceae'],
            ['id' => 13, 'nama' => 'Chiclidae'],
            ['id' => 14, 'nama' => 'Compositae'],
            ['id' => 15, 'nama' => 'Convolvulaceae'],
            ['id' => 16, 'nama' => 'Crassulaceae'],
            ['id' => 17, 'nama' => 'Cucurbitaceae'],
            ['id' => 18, 'nama' => 'Cyprinidae'],
            ['id' => 19, 'nama' => 'Euphorbiaceae'],
            ['id' => 20, 'nama' => 'Fabaceae'],
            ['id' => 21, 'nama' => 'Graminae'],
            ['id' => 22, 'nama' => 'Iridaceae'],
            ['id' => 23, 'nama' => 'Labiatae'],
            ['id' => 24, 'nama' => 'Lamiaceae'],
            ['id' => 25, 'nama' => 'Lauraceae'],
            ['id' => 26, 'nama' => 'Leguminaceae'],
            ['id' => 27, 'nama' => 'Leporidae'],
            ['id' => 28, 'nama' => 'Liliaceae'],
            ['id' => 29, 'nama' => 'Malvaceaea'],
            ['id' => 30, 'nama' => 'Meliaceae'],
            ['id' => 31, 'nama' => 'Mimesaceae'],
            ['id' => 32, 'nama' => 'Moringaceae'],
            ['id' => 33, 'nama' => 'Myrtaceae'],
            ['id' => 34, 'nama' => 'Nyctagynaceae'],
            ['id' => 35, 'nama' => 'Oleaceae'],
            ['id' => 36, 'nama' => 'Orchidaceae'],
            ['id' => 37, 'nama' => 'Orchidaceae Juss.'],
            ['id' => 38, 'nama' => 'Oxalidaceae'],
            ['id' => 39, 'nama' => 'Palmaceae'],
            ['id' => 40, 'nama' => 'Piperaceae'],
            ['id' => 41, 'nama' => 'Poaceae'],
            ['id' => 42, 'nama' => 'Polysonaceae'],
            ['id' => 43, 'nama' => 'Ranunculaceae'],
            ['id' => 44, 'nama' => 'Rosaceae'],
            ['id' => 45, 'nama' => 'Rubiaceae'],
            ['id' => 46, 'nama' => 'Rutaceae'],
            ['id' => 47, 'nama' => 'Sapindaceae'],
            ['id' => 48, 'nama' => 'Sapotaceae'],
            ['id' => 49, 'nama' => 'Simaroubaceae'],
            ['id' => 50, 'nama' => 'Solanaceae'],
            ['id' => 51, 'nama' => 'Sterculiaceae'],
            ['id' => 52, 'nama' => 'Thymelaeaceae'],
            ['id' => 53, 'nama' => 'Umbelliferae'],
            ['id' => 54, 'nama' => 'Urticaceae'],
            ['id' => 55, 'nama' => 'Verbanaceae'],
            ['id' => 56, 'nama' => 'Verbenaceae'],
            ['id' => 57, 'nama' => 'Vitaceae'],
            ['id' => 58, 'nama' => 'Zingiberaceae']
        ];
        foreach ($family as $item) {
            DB::table('family')->updateOrInsert(
                ['id' => $item['id']], // Cek apakah ID sudah ada
                ['nama' => $item['nama']] // Jika ada, update nama saja
            );
        }
    }
}