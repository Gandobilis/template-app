<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public static function uploadFile($file, $storagePath = 'images'): string
    {
        $originalFileName = $file->getClientOriginalName();
        $newFileName = time() . $originalFileName;
        return $file->storeAs($storagePath, $newFileName, 'public');
    }

    public static function deleteFile($path): bool
    {
        $path = 'public/' . $path;
        if (Storage::exists($path)) return Storage::delete($path);
        return false;
    }
}
