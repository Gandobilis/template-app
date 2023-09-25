<?php

namespace App\Observers;

use App\Models\Banner;
use App\Services\FileUploadService;

class BannerObserver
{
    public function __construct(public FileUploadService $fileUploadService)
    {
    }

    /**
     * Handle the Banner "deleted" event.
     */
    public function deleted(Banner $banner): void
    {

    }
}
