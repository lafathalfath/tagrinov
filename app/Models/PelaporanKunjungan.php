<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanKunjungan extends Model
{
    use HasFactory;
    protected $table = 'pelaporan_kunjungan';
    protected $guarded = [];
}
