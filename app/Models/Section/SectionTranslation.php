<?php

namespace App\Models\Section;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'desc',
        'slug'
    ];
}
