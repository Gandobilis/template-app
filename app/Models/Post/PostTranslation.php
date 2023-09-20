<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
      'title',
      'desc',
      'content',
      'slug'
    ];
}
