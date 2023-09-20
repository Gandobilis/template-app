<?php

namespace App\Models\Section;

use App\Models\Post\Post;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'image',
        'type'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
