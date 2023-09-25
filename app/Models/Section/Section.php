<?php

namespace App\Models\Section;

use App\Models\Image;
use App\Models\Post\Post;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Section extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = [
        'title',
        'desc',
        'slug'
    ];
    protected $fillable = [
        'type'
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->take(1);
    }
}
