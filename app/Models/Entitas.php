<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Entitas extends Model
{
    use HasFactory;
    protected $table = 'entitas';
    protected $guarded = [];

    public function family() : BelongsTo {
        return $this->belongsTo(Family::class);
    }
    
    public function jenis() : BelongsTo {
        return $this->belongsTo(Jenis::class);
    }
    
    public function kategori() : BelongsTo {
        return $this->belongsTo(Kategori::class);
    }

    public function entitas_detail() : HasOne {
        return $this->hasOne(EntitasDetail::class);
    }
}
