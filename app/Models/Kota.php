<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kota extends Model
{
    use HasFactory;
    protected $table = 'kota';
    protected $guarded = [];

    public function provinsi() : BelongsTo {
        return $this->belongsTo(Provinsi::class);
    }

    public function kecamatan() : HasMany {
        return $this->hasMany(Kecamatan::class);
    }
}
