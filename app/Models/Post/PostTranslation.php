<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'title',
      'desc',
      'content',
      'slug'
    ];
}
