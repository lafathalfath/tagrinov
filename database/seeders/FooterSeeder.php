<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FooterSetting;


class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FooterSetting::create([
            'map_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.8860998470195!2d106.7875092695418!3d-6.579033999588393!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5311ad80031%3A0xae42de3ba17aceb7!2sBalai%20Besar%20Penerapan%20Standar%20Instrumen%20Pertanian%20(BBPSIP)!5e0!3m2!1sen!2sid!4v1721834025093!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'phone' => '(0251) 8351277 / WA : 085183071943',
            'fax' => '(0251) 8350928',
            'email' => 'brmp.penerapan@pertanian.go.id',
            'address' => 'Jl. Tentara Pelajar No.10, RT.01/RW.07, Ciwaringin, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16124',
            'website_link' => 'https://penerapan.brmp.pertanian.go.id/',
            'facebook_link' => 'https://www.facebook.com/brmppenerapan/',
            'youtube_link' => 'https://www.youtube.com/@BRMPPENERAPAN',
            'instagram_link' => 'https://instagram.com/brmppenerapan',
            'twitter_link' => 'https://x.com/BRMPPENERAPAN/',
            'tiktok_link' => 'https://tiktok.com/@brmppenerapan',
        ]);
    }
}
