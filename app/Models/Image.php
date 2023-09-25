<?php

namespace App\Models;

use App\Services\FileUploadService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = ['image'];

    protected $appends = ['full_image'];

//    protected static function booted()
//    {
//        static::deleted(function (Image $image){
//            $fileUploadService = new FileUploadService();
//            $fileUploadService->deleteFile($image->image);
//        });
//    }

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function fullImage(): Attribute
    {
        return Attribute::make(
            get: fn() => url('/') . '/storage/' . $this->image
        );
    }
}
