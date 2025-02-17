<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benih extends Model
{
    use HasFactory;
    protected $table = 'benih';
    protected $fillable = ['nama', 'deskripsi', 'stok', 'harga', 'netto', 'lokasi', 'url_gambar'];
}
