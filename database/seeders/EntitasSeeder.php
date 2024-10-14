<?php

namespace Database\Seeders;

use App\Models\EntitasDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EntitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entitas = [
            ['id' => 1, 'nama' => 'Saga Manis', 'nama_latin' => 'Abrus precatorius', 'nama_daerah' => 'Saga Manis', 'family_id' => 42, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 2, 'nama' => 'Bunga Tasbih', 'nama_latin' => 'Canna indica', 'nama_daerah' => 'Bunga Tasbih', 'family_id' => 11, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 3, 'nama' => 'Lidah Buaya', 'nama_latin' => 'Aloe vera', 'nama_daerah' => 'Lidah Buaya', 'family_id' => 28, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 4, 'nama' => 'Lengkuas', 'nama_latin' => 'Alpina Galanga (Langua G)', 'nama_daerah' => 'Laos', 'family_id' => 58, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 5, 'nama' => 'Sambiloto', 'nama_latin' => 'Andrographys paniculata', 'nama_daerah' => 'Sambiloto', 'family_id' => 1, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 6, 'nama' => 'Seraiwangi', 'nama_latin' => 'Andropogons nardus', 'nama_daerah' => 'Sereh Wangi', 'family_id' => 21, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 7, 'nama' => 'Pinang', 'nama_latin' => 'Areca catechu', 'nama_daerah' => 'Pinang', 'family_id' => 39, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 8, 'nama' => 'Belimbing Wuluh', 'nama_latin' => 'Averrhoe bilimbi', 'nama_daerah' => 'Belimbing Wuluh', 'family_id' => 38, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 9, 'nama' => 'Mimba', 'nama_latin' => 'Azadirachta indica', 'nama_daerah' => 'Mimba', 'family_id' => 30, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 10, 'nama' => 'Sembung', 'nama_latin' => 'Blumea balsamifera', 'nama_daerah' => 'Sembung', 'family_id' => 7, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 11, 'nama' => 'Secang', 'nama_latin' => 'Caesalpinia sappan', 'nama_daerah' => 'Secang', 'family_id' => 26, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 12, 'nama' => 'Pepaya', 'nama_latin' => 'Carica papaya', 'nama_daerah' => 'Pepaya', 'family_id' => 12, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 13, 'nama' => 'Cengkeh', 'nama_latin' => 'Caryphyllus aromaticus', 'nama_daerah' => 'Cengkeh', 'family_id' => 33, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 14, 'nama' => 'Kayu Manis', 'nama_latin' => 'Cinramomum zaylanicum', 'nama_daerah' => 'Kayu Manis', 'family_id' => 25, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 15, 'nama' => 'Senggugu', 'nama_latin' => 'Clerodendron serratum', 'nama_daerah' => 'Senggugu', 'family_id' => 56, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 16, 'nama' => 'Kitajam', 'nama_latin' => 'Clinacanthus nutans', 'nama_daerah' => 'Kitajam', 'family_id' => 1, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 17, 'nama' => 'Bakung', 'nama_latin' => 'Crinum asiaticum', 'nama_daerah' => 'Bakung', 'family_id' => 3, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 18, 'nama' => 'Temu Hitam', 'nama_latin' => 'Curcuma aerogynosa', 'nama_daerah' => 'Temu Hitam', 'family_id' => 58, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 19, 'nama' => 'Kunyit', 'nama_latin' => 'Curcuma domestica', 'nama_daerah' => 'Kunyit', 'family_id' => 58, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 20, 'nama' => 'Temu Giring', 'nama_latin' => 'Curcuma heyneana', 'nama_daerah' => 'Temu Giring', 'family_id' => 58, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 21, 'nama' => 'Serai Dapur', 'nama_latin' => 'Cymbopogon serratus', 'nama_daerah' => 'Sereh Dapur', 'family_id' => 41, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 22, 'nama' => 'Temulawak', 'nama_latin' => 'Curcuma xanthorrhiza', 'nama_daerah' => 'Temu Lawak', 'family_id' => 58, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 23, 'nama' => 'Cincau Rambat', 'nama_latin' => 'Cyclea barbata', 'nama_daerah' => 'Cincau Rambat', 'family_id' => 56, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 24, 'nama' => 'Kecubung', 'nama_latin' => 'Datura fastuosa', 'nama_daerah' => 'Kecubung', 'family_id' => 50, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 25, 'nama' => 'Sambung Nyawa', 'nama_latin' => 'Gynura procumbents', 'nama_daerah' => 'Sambung Nyawa', 'family_id' => 14, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 26, 'nama' => 'Kembang Sepatu', 'nama_latin' => 'Hibiscus rosasinensi', 'nama_daerah' => 'Kembang Sepatu', 'family_id' => 29, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 27, 'nama' => 'Cocor Bebek', 'nama_latin' => 'Kalanchoe pinnata', 'nama_daerah' => 'Cocor Bebek', 'family_id' => 16, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 28, 'nama' => 'Bunga Pukul Empat', 'nama_latin' => 'Mirabilis jalapa', 'nama_daerah' => 'Bunga Pukul Empat', 'family_id' => 34, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 29, 'nama' => 'Mengkudu', 'nama_latin' => 'Morinda citrifolia', 'nama_daerah' => 'Mengkudu', 'family_id' => 45, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 30, 'nama' => 'Jambu Biji Merah', 'nama_latin' => 'Psidium guajava', 'nama_daerah' => 'Jambu Biji Merah', 'family_id' => 33, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 31, 'nama' => 'Kuciat / Awar-Awar', 'nama_latin' => 'Ficus septica', 'nama_daerah' => 'Kuciat / Awar-awar', 'family_id' => 54, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 32, 'nama' => 'Mahkota Dewa', 'nama_latin' => 'Phaleria macrocarpa', 'nama_daerah' => 'Mahkota Dewa', 'family_id' => 52, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 33, 'nama' => 'Tapak Dara', 'nama_latin' => 'Vinca rosea', 'nama_daerah' => 'Tapak Dara', 'family_id' => 6, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 34, 'nama' => 'Babadotan', 'nama_latin' => 'Ageratum conyzoides', 'nama_daerah' => 'Babadotan', 'family_id' => 7, 'jenis_id' => 4, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 35, 'nama' => 'Anting-Anting', 'nama_latin' => 'Acalypha australis L.', 'nama_daerah' => 'Anting-anting', 'family_id' => 19, 'jenis_id' => 4, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 36, 'nama' => 'Pegagan', 'nama_latin' => 'Centella asiatica', 'nama_daerah' => 'Pegagan', 'family_id' => 53, 'jenis_id' => 4, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 37, 'nama' => 'Alang-Alang', 'nama_latin' => 'Imperata cylindrica', 'nama_daerah' => 'Alang-alang', 'family_id' => 41, 'jenis_id' => 4, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 38, 'nama' => 'Tempuyung', 'nama_latin' => 'Sonchus arvensis', 'nama_daerah' => 'Tempuyung', 'family_id' => 14, 'jenis_id' => 4, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 39, 'nama' => 'Jati Belanda', 'nama_latin' => 'Guazuma ulmifolia', 'nama_daerah' => 'Jati Belanda', 'family_id' => 51, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 40, 'nama' => 'Tapak Liman', 'nama_latin' => 'Ellephanthopus scaber', 'nama_daerah' => 'Tapak Liman', 'family_id' => 14, 'jenis_id' => 4, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 41, 'nama' => 'Kumis Kucing', 'nama_latin' => 'Orthosiphon aristatus', 'nama_daerah' => 'Kumis Kucing', 'family_id' => 23, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 42, 'nama' => 'Kwalot', 'nama_latin' => 'Brucea amarissima', 'nama_daerah' => 'Kwalot', 'family_id' => 49, 'jenis_id' => 4, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 43, 'nama' => 'Pecut Kuda', 'nama_latin' => 'Stachytarphea jamaicensis', 'nama_daerah' => 'Pecut Kuda', 'family_id' => 55, 'jenis_id' => 4, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 44, 'nama' => 'Sirih', 'nama_latin' => 'Piper betle', 'nama_daerah' => 'Sirih', 'family_id' => 40, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 45, 'nama' => 'Brojo Lintang', 'nama_latin' => 'Belacanda chinensis', 'nama_daerah' => 'Brojo Lintang', 'family_id' => 22, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 46, 'nama' => 'Jago Ungu', 'nama_latin' => 'Stachytarpea mutabilis', 'nama_daerah' => 'Jarong Ungu', 'family_id' => 55, 'jenis_id' => 4, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 47, 'nama' => 'Putri Malu', 'nama_latin' => 'Mimoa pudica L.', 'nama_daerah' => 'Putri Malu', 'family_id' => 31, 'jenis_id' => 4, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 48, 'nama' => 'Petai Cina', 'nama_latin' => 'Laucaena glauca', 'nama_daerah' => 'Petai Cina', 'family_id' => 26, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 49, 'nama' => 'Tembelekan', 'nama_latin' => 'Lantana camara', 'nama_daerah' => 'Tembelekan', 'family_id' => 56, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 50, 'nama' => 'Gendola', 'nama_latin' => 'Basella rubhalinn', 'nama_daerah' => 'Gendola', 'family_id' => 8, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 51, 'nama' => 'Melati', 'nama_latin' => 'Jasminum sambac', 'nama_daerah' => 'Melati', 'family_id' => 35, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 52, 'nama' => 'Bayam', 'nama_latin' => 'Amaranthus sp.', 'nama_daerah' => 'Bayam', 'family_id' => 2, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 53, 'nama' => 'Pakchoy', 'nama_latin' => 'Brassica rapa', 'nama_daerah' => 'Pakchoy', 'family_id' => 10, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 54, 'nama' => 'Caisin', 'nama_latin' => 'Brassica rapa cv. caisin', 'nama_daerah' => 'Caisin', 'family_id' => 10, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 55, 'nama' => 'Selada Keriting', 'nama_latin' => 'Lactuca sativa', 'nama_daerah' => 'Selada Keriting', 'family_id' => 7, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 56, 'nama' => 'Kangkung', 'nama_latin' => 'Ipomoea reptans P.', 'nama_daerah' => 'Kangkung', 'family_id' => 15, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 57, 'nama' => 'Cabai', 'nama_latin' => 'Capsicum annum', 'nama_daerah' => 'Cabai', 'family_id' => 50, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 58, 'nama' => 'Tomat', 'nama_latin' => 'Solanum Lycopersicum', 'nama_daerah' => 'Tomat', 'family_id' => 50, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 59, 'nama' => 'Bawang Daun', 'nama_latin' => 'Allium fistulosum L.', 'nama_daerah' => 'Bawang Daun', 'family_id' => 28, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 60, 'nama' => 'Bawang Merah', 'nama_latin' => 'Allium cepa', 'nama_daerah' => 'Bawang Merah', 'family_id' => 28, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 61, 'nama' => 'Anggrek Genta Bandung', 'nama_latin' => 'Vanda Douglas', 'nama_daerah' => 'Anggrek Genta bandung', 'family_id' => 36, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 62, 'nama' => 'Anggrek Kuku Macan', 'nama_latin' => 'Airides odorata Lour. Fl. Cochinch', 'nama_daerah' => 'Anggrek Kuku Macan', 'family_id' => 37, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 63, 'nama' => 'Anggrek Kalajengking', 'nama_latin' => 'Arachnis flos-aeris', 'nama_daerah' => 'Anggrek Kalajengking', 'family_id' => 36, 'jenis_id' => 3, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 64, 'nama' => 'Durian Matahari', 'nama_latin' => 'Durio zibethinus', 'nama_daerah' => 'Durian Matahari', 'family_id' => 9, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 65, 'nama' => 'Kelor', 'nama_latin' => 'Moringa oleifera', 'nama_daerah' => 'kelor', 'family_id' => 32, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 66, 'nama' => 'Labu Kabocha', 'nama_latin' => 'Cucurbita maxima', 'nama_daerah' => 'Labu Kuning', 'family_id' => 17, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 67, 'nama' => 'Bayam Brazil', 'nama_latin' => 'Althernanthera sissoo', 'nama_daerah' => 'Bayam Brazil', 'family_id' => 2, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 68, 'nama' => 'Kelinci Rexsi', 'nama_latin' => 'Oryctolagus cuniculus', 'nama_daerah' => 'Kelinci Rexsi', 'family_id' => 27, 'jenis_id' => 6, 'kategori_id' => 2, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 69, 'nama' => 'Beluntas', 'nama_latin' => 'Pluchea indica L.', 'nama_daerah' => 'Beluntas / Baluntas / Baruntas / Lamutasa / Lenabou', 'family_id' => 7, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 70, 'nama' => 'Handeleum', 'nama_latin' => 'Graptophyllum Pictum L. Griff', 'nama_daerah' => 'Daun Ungu', 'family_id' => 1, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 71, 'nama' => 'Jahe Merah', 'nama_latin' => 'Zingiber officinale Roxb.var. Rubrum', 'nama_daerah' => 'Jahe Merah', 'family_id' => 58, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 72, 'nama' => 'Jawer Kotok', 'nama_latin' => 'Plectranthus scutellarioides (L) R.Br.', 'nama_daerah' => 'Jawer Kotok / Miyana', 'family_id' => 24, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 73, 'nama' => 'Zodia', 'nama_latin' => 'Evodia suaviolens', 'nama_daerah' => 'Zodia', 'family_id' => 46, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 74, 'nama' => 'Karuk', 'nama_latin' => 'Piper sarmentosum Roxb.', 'nama_daerah' => 'Karuk', 'family_id' => 40, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 75, 'nama' => 'Kecombrang', 'nama_latin' => 'Etlingera elatior (Jack)', 'nama_daerah' => 'Kecombrang', 'family_id' => 58, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 76, 'nama' => 'Keji Beling', 'nama_latin' => 'Strobilanthes crispus Bl.', 'nama_daerah' => 'Keji Beling', 'family_id' => 1, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 77, 'nama' => 'Kembang Telang', 'nama_latin' => 'Clitoria ternatea', 'nama_daerah' => 'Kembang Telang', 'family_id' => 20, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 78, 'nama' => 'Kencur', 'nama_latin' => 'Kaempferia Galanga L.', 'nama_daerah' => 'Kencur', 'family_id' => 58, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 79, 'nama' => 'Mint', 'nama_latin' => 'Mentha arvensis L.', 'nama_daerah' => 'Mint', 'family_id' => 23, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 80, 'nama' => 'Jintan Hitam', 'nama_latin' => 'Nigella Sativa L.', 'nama_daerah' => 'Jintan Hitam', 'family_id' => 43, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 81, 'nama' => 'Sambang Darah', 'nama_latin' => 'Excoecaria cochinchinensis Lour.', 'nama_daerah' => 'Sambang Darah', 'family_id' => 19, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 82, 'nama' => 'Buncis', 'nama_latin' => 'Phaseolus vulgaris L.', 'nama_daerah' => 'Buncis', 'family_id' => 20, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 83, 'nama' => 'Kacang Panjang', 'nama_latin' => 'Vigna sinensis L.', 'nama_daerah' => 'Kacang Panjang', 'family_id' => 20, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 84, 'nama' => 'Kailan', 'nama_latin' => 'Brassica oleracea L.', 'nama_daerah' => 'Kailan', 'family_id' => 10, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 85, 'nama' => 'Katuk', 'nama_latin' => 'Sauropus androgunus L.', 'nama_daerah' => 'Katuk', 'family_id' => 19, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 86, 'nama' => 'Kenikir', 'nama_latin' => 'Cosmos caudatus Kunth.', 'nama_daerah' => 'Kenikir / Ulam Raja', 'family_id' => 7, 'jenis_id' => 5, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 87, 'nama' => 'Lada Perdu', 'nama_latin' => 'Piper nigrum L.', 'nama_daerah' => 'Lada / Merica', 'family_id' => 40, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 88, 'nama' => 'Biwa', 'nama_latin' => 'Eriobotrya japonica Lindl.', 'nama_daerah' => 'Biwa', 'family_id' => 44, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 89, 'nama' => 'Abiu', 'nama_latin' => 'Pouteria caimito Radlk.', 'nama_daerah' => 'Abiu / Sawo Australia', 'family_id' => 48, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 90, 'nama' => 'Jambu Air Dalhari', 'nama_latin' => 'Syzygium samarangense', 'nama_daerah' => 'Jambu Air Dalhari', 'family_id' => 33, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 91, 'nama' => 'Jambu Air Deli', 'nama_latin' => 'Syzygium aqueum', 'nama_daerah' => 'Jambu Air Deli', 'family_id' => 33, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 92, 'nama' => 'Jambu Kristal', 'nama_latin' => 'Psidium guajava (L) Merr', 'nama_daerah' => 'Jambu Kristal', 'family_id' => 33, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 93, 'nama' => 'Jeruk Bali', 'nama_latin' => 'Citrus maxima (Burm.f.)', 'nama_daerah' => 'Jeruk Bali', 'family_id' => 46, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 94, 'nama' => 'Jeruk Lemon', 'nama_latin' => 'Citrus limon', 'nama_daerah' => 'Jeruk Lemon', 'family_id' => 46, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 95, 'nama' => 'Jeruk Sunkist', 'nama_latin' => 'Citrus sinensis', 'nama_daerah' => 'Jeruk Sunkist', 'family_id' => 46, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 96, 'nama' => 'Kelengkeng', 'nama_latin' => 'Dimocarpus Longan Lour', 'nama_daerah' => 'Kelengkeng', 'family_id' => 47, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 97, 'nama' => 'Magic Fruit', 'nama_latin' => 'Synsepalum dulcificum', 'nama_daerah' => 'Buah Ajaib', 'family_id' => 48, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 98, 'nama' => 'Mangga Alpukat', 'nama_latin' => 'Mangifera indica L.', 'nama_daerah' => 'Mangga Alpukat', 'family_id' => 4, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 99, 'nama' => 'Mangga Arum Manis', 'nama_latin' => 'Mangifera indica L. var. arum manis', 'nama_daerah' => 'Mangga Arum Manis', 'family_id' => 4, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 100, 'nama' => 'Petai', 'nama_latin' => 'Parkia speciosa', 'nama_daerah' => 'Petai / Pete', 'family_id' => 20, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 101, 'nama' => 'Rambutan', 'nama_latin' => 'Nephelium Lappaceum L.', 'nama_daerah' => 'Rambutan', 'family_id' => 47, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 102, 'nama' => 'Sawo Apel', 'nama_latin' => 'Chrysophyllum cainito', 'nama_daerah' => 'Sawo Apel/ Sawo Hijau/ Sawo Duren/ Sawo Kadu', 'family_id' => 48, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 103, 'nama' => 'Sawo Manila', 'nama_latin' => 'Manilkara zapota', 'nama_daerah' => 'Sawo Manila', 'family_id' => 48, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 104, 'nama' => 'Kedondong', 'nama_latin' => 'Spondias dulcis Parkinson.', 'nama_daerah' => 'Kedondong', 'family_id' => 4, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 105, 'nama' => 'Kelengkeng Merah', 'nama_latin' => null, 'nama_daerah' => 'Kelengkeng Merah', 'family_id' => 47, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 106, 'nama' => 'Kelengkeng Puangray', 'nama_latin' => null, 'nama_daerah' => 'Kelengkeng Puangray', 'family_id' => 47, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 107, 'nama' => 'Mangga Golek', 'nama_latin' => null, 'nama_daerah' => 'Mangga Golek', 'family_id' => 4, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 108, 'nama' => 'Mangga Indramayu', 'nama_latin' => null, 'nama_daerah' => 'Mangga Indramayu', 'family_id' => 4, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 109, 'nama' => 'Mangga Manalagi', 'nama_latin' => null, 'nama_daerah' => 'Mangga Manalagi', 'family_id' => 4, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 110, 'nama' => 'Srikaya Rovi', 'nama_latin' => 'Annona squamosa L.', 'nama_daerah' => 'Srikaya Rovi / Srikaya Jumbo Australia', 'family_id' => 5, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 111, 'nama' => 'Anggur Jestro Ag86', 'nama_latin' => null, 'nama_daerah' => 'Anggur Jestro Ag86', 'family_id' => 57, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 112, 'nama' => 'Kopi Arabica Ateng', 'nama_latin' => null, 'nama_daerah' => 'Kopi Arabica Ateng', 'family_id' => 45, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 113, 'nama' => 'Kelinci Satin', 'nama_latin' => null, 'nama_daerah' => 'Kelinci Satin', 'family_id' => 27, 'jenis_id' => 6, 'kategori_id' => 2, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 114, 'nama' => 'Kelinci Reza', 'nama_latin' => null, 'nama_daerah' => 'Kelinci Reza', 'family_id' => 27, 'jenis_id' => 6, 'kategori_id' => 2, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 115, 'nama' => 'Kelinci Hycole', 'nama_latin' => null, 'nama_daerah' => 'Kelinci Hycole', 'family_id' => 27, 'jenis_id' => 6, 'kategori_id' => 2, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 116, 'nama' => 'Kelinci Hyla', 'nama_latin' => null, 'nama_daerah' => 'Kelinci Hyla', 'family_id' => 27, 'jenis_id' => 6, 'kategori_id' => 2, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 117, 'nama' => 'Kelinci New Zealand', 'nama_latin' => null, 'nama_daerah' => 'Kelinci New Zealand', 'family_id' => 27, 'jenis_id' => 6, 'kategori_id' => 2, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 118, 'nama' => 'Ikan Mas', 'nama_latin' => 'Cyprinus carpio', 'nama_daerah' => 'Ikan Mas/ Carp', 'family_id' => 18, 'jenis_id' => 7, 'kategori_id' => 2, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 119, 'nama' => 'Ikan Nila Merah', 'nama_latin' => 'Oreochromis sp.', 'nama_daerah' => 'Ikan Nila Merah', 'family_id' => 13, 'jenis_id' => 7, 'kategori_id' => 2, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 120, 'nama' => 'Ikan Garra Rufa', 'nama_latin' => 'Cyprinion macrostamus', 'nama_daerah' => 'Ikan Garra Rufa', 'family_id' => 18, 'jenis_id' => 7, 'kategori_id' => 2, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 121, 'nama' => 'Kiwalang', 'nama_latin' => null, 'nama_daerah' => 'Kiwalang', 'family_id' => null, 'jenis_id' => 1, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
            ['id' => 122, 'nama' => 'Kopi Robusta Sukabumi', 'nama_latin' => null, 'nama_daerah' => 'Kopi Robusta Sukabumi', 'family_id' => null, 'jenis_id' => 2, 'kategori_id' => 1, 'url_qr' => null, 'url_gambar' => null],
        ];

        foreach ($entitas as $en) {
            // Simpan entitas ke database
            DB::table('entitas')->insert($en);

            // Cari gambar berdasarkan ID entitas
            $url_gambar = $this->findImagePath($en['id']);

            // Update entitas dengan URL gambar jika ditemukan
            if ($url_gambar) {
                DB::table('entitas')->where('id', $en['id'])->update(['url_gambar' => $url_gambar]);
            }

            // Simpan entitas detail
            EntitasDetail::create(['entitas_id' => $en['id']]);
        }
    }

    /**
     * Mencari path gambar berdasarkan ID.
     */
    private function findImagePath($id)
    {
        // Format gambar yang didukung
        $formats = ['jpg', 'jpeg', 'png', 'gif'];

        foreach ($formats as $format) {
            $path = "public/entitas/gambar_{$id}.{$format}"; // Path yang disesuaikan
            if (Storage::exists($path)) {
                return Storage::url($path); // Kembalikan URL gambar
            }
        }
        return null; // Jika tidak ditemukan
    }
}