<?php

namespace App\Models\Banner;

use App\Models\Image;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Banner extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'title',
        'content',
        'link'
    ];

    protected $fillable = ['type'];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
