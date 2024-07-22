<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenis extends Model
{
    use HasFactory;
    protected $table = 'jenis';
    protected $guarded = [];

    public function entitas() : HasMany {
        return $this->hasMany(Entitas::class);
    }
}
