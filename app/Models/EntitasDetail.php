<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntitasDetail extends Model
{
    use HasFactory;
    protected $table = 'entitas_detail';
    protected $guarded = [];

    public function entitas() : BelongsTo {
        return $this->belongsTo(Entitas::class);
    }
}
