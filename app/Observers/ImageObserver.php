<?php

namespace App\Observers;

use App\Models\Image;
use App\Services\FileUploadService;

class ImageObserver
{
    public function __construct(public FileUploadService $fileUploadService)
    {
    }

    /**
     * Handle the Image "deleted" event.
     */
    public function deleted(Image $image): void
    {
        $this->fileUploadService->deleteFile($image->image);
    }
}
