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

    public function kategori_kunjungan() : BelongsTo {
        return $this->belongsTo(KategoriKunjungan::class);
    }

    public function alamat() : BelongsTo {
        return $this->belongsTo(Alamat::class);
    }

    public function jenis_pengunjung() : BelongsTo {
        return $this->belongsTo(JenisPengunjung::class);
    }

    public function hari_kunjungan() : BelongsTo {
        return $this->belongsTo(HariKunjungan::class);
    }

    public function waktu_kunjungan() : BelongsTo {
        return $this->belongsTo(WaktuKunjungan::class);
    }
}
