<?php

namespace App\Models\Banner;

use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'link'
    ];
}
