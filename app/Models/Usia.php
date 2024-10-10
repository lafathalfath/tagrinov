<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usia extends Model
{
    use HasFactory;
    protected $table = 'usia';
    protected $guarded = [];

    public function kunjungan() : HasMany {
        return $this->hasMany(Kunjungan::class);
    }
}
