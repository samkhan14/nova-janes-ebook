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

        if (Str::startsWith($path, ['frontend/', 'uploads/'])) {
            return asset($path);
        }

        $normalized = Str::startsWith($path, 'storage/')
            ? Str::after($path, 'storage/')
            : ltrim(str_replace('\\', '/', $path), '/');

        // Storage uploads (cms/...) — serve via app route so Hostinger / missing symlink still works
        if (Storage::disk('public')->exists($normalized)) {
            return route('media.show', ['path' => $normalized]);
        }

        if (Str::startsWith($path, 'storage/')) {
            return asset($path);
        }

        if (is_file(public_path('storage/'.$normalized))) {
            return asset('storage/'.$normalized);
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
