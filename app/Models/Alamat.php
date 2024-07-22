<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alamat extends Model
{
    use HasFactory;
    protected $table = 'alamat';
    protected $guarded = [];

    public function kecamatan() : BelongsTo {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kunjungan() : HasMany {
        return $this->hasMany(Kunjungan::class);
    }
}
