<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CmsMedia
{
    public static function url(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        if (Str::startsWith($path, ['storage/', 'frontend/'])) {
            return asset($path);
        }

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }

        return asset($path);
    }

    public static function store(UploadedFile $file, string $folder = 'cms'): string
    {
        return $file->store($folder, 'public');
    }

    public static function storeOrKeep(?UploadedFile $file, ?string $current, string $folder = 'cms'): ?string
    {
        if ($file) {
            return static::store($file, $folder);
        }

        return $current;
    }
}
