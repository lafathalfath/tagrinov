<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PilihanPertanian extends Model
{
    use HasFactory;
    protected $table = 'pilihan_pertanian';
    protected $guarded = [];

    public function kunjungan() : HasMany {
        return $this->hasMany(Kunjungan::class);
    }
}
