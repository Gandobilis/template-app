<?php

namespace App\Models\Post;

use App\Models\Section\Section;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
      'image',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
