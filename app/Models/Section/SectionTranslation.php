<?php

namespace App\Models\Section;

use Illuminate\Database\Eloquent\Model;

class SectionTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'desc',
        'slug'
    ];
}
