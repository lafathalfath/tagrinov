<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            FamilySeeder::class,
            JenisSeeder::class,
            kategoriSeeder::class,
            EntitasSeeder::class,
            EntitasDetailSeeder::class,
            ProvinsiSeeder::class,
            WelcomeTextSeeder::class,
            UsiaSeeder::class,
            JenisKelaminSeeder::class,
            PekerjaanSeeder::class,
            KategoriInformasiSeeder::class,
            PilihanPertanianSeeder::class,
            PendidikanSeeder::class,
            JenisPengunjungSeeder::class,
        ]);
    }
}
