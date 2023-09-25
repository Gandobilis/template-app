<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = ['image'];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function fullImage(): Attribute
    {
        return Attribute::make(
            get: fn(string $image) => url('/') . '/storage/' . $image
        );
    }
}
