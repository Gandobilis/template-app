<?php

namespace App\Models\Banner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'link'
    ];
}
