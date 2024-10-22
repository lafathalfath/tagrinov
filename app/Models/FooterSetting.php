<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'map_link',
        'phone',
        'fax',
        'email',
        'address',
        'website_link',
        'facebook_link',
        'youtube_link',
        'instagram_link',
        'twitter_link',
        'tiktok_link',
    ];
}
