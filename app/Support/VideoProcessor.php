<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoProcessor
{
    public static function store(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension() ?: 'mp4';
        $filename = Str::uuid().'.'.$extension;

        return $file->storeAs('block-videos', $filename, config('filesystems.default'));
    }

    public static function url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return Storage::disk(config('filesystems.default'))->url($path);
    }

    public static function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        Storage::disk(config('filesystems.default'))->delete($path);
    }
}
