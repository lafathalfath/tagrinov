<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    protected $guarded = [];

    public function kota() : BelongsTo {
        return $this->belongsTo(Kota::class);
    }

    public function alamat() : HasMany {
        return $this->hasMany(Alamat::class);
    }
}
