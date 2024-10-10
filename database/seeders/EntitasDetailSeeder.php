<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntitasDetailSeeder extends Seeder
{
    public function run()
    {
        $csvFile = storage_path('app/data/entitas_detail.csv');

        if (($handle = fopen($csvFile, 'r')) !== false) {
            fgetcsv($handle);

            while (($data = fgetcsv($handle, 0, ',')) !== false) {
                if (!empty($data)) {
                    DB::table('entitas_detail')->updateOrInsert(
                        ['id' => $data[0]],
                        [
                            'entitas_id' => $data[1],
                            'deskripsi' => $data[2],
                            'varietas' => $data[3],
                            'potensi_hasil' => $data[4],
                            'keunggulan' => $data[5],
                            'manfaat' => $data[6],
                            'agroekosistem' => $data[7],
                            'kandungan' => $data[8],
                            'syarat_tumbuh' => $data[9],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }
            fclose($handle);
        }
    }
}
