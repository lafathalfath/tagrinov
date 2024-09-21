<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelcomeText extends Model
{
    use HasFactory;

    protected $table = 'welcome_text';
    protected $fillable = ['title1', 'title2', 'description'];
}
