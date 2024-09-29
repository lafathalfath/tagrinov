<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kunjungan extends Model
{
    use HasFactory;
    protected $table = 'kunjungan';
    protected $guarded = [];
    protected $fillable = [
        'nama_lengkap',
        'no_hp',
        'usia_id',
        'jenis_kelamin_id',
        'asal_instansi',
        'pekerjaan_id',
        'kategori_informasi_id',
        'pilihan_pertanian_id',
        'pendidikan_id',
        'jenis_pengunjung_id',
        'jumlah_orang',
        'tanggal_kunjungan',
        'tujuan_kunjungan',
        'url_foto_ktp',
        'url_foto_selfie',
    ];

    public function usia(): BelongsTo {
        return $this->belongsTo(Usia::class);
    }
    
    public function jenis_kelamin(): BelongsTo {
        return $this->belongsTo(JenisKelamin::class);
    }
    
    public function pekerjaan(): BelongsTo {
        return $this->belongsTo(Pekerjaan::class);
    }
    
    public function kategori_informasi(): BelongsTo {
        return $this->belongsTo(KategoriInformasi::class);
    }
    
    public function pilihan_pertanian(): BelongsTo {
        return $this->belongsTo(PilihanPertanian::class);
    }
    
    public function pendidikan(): BelongsTo {
        return $this->belongsTo(Pendidikan::class);
    }
    
    public function jenis_pengunjung(): BelongsTo {
        return $this->belongsTo(JenisPengunjung::class);
    }
}
