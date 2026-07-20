<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Exceptions\DecoderException;
use Intervention\Image\ImageManager;
use RuntimeException;

class ImageProcessor
{
    public static function profilePhoto(UploadedFile $file): string
    {
        return self::process($file, 'profile-photos', fn ($image) => $image->cover(400, 400), quality: 80);
    }

    public static function backgroundImage(UploadedFile $file): string
    {
        return self::process($file, 'page-backgrounds', fn ($image) => $image->scaleDown(width: 1600, height: 1600), quality: 75);
    }

    public static function blockImage(UploadedFile $file): string
    {
        return self::process($file, 'block-images', fn ($image) => $image->scaleDown(width: 1200), quality: 80);
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

    protected static function process(UploadedFile $file, string $folder, callable $transform, int $quality): string
    {
        $manager = ImageManager::withDriver(Driver::class);

        try {
            $image = $manager->read($file->getRealPath());
        } catch (DecoderException $e) {
            throw new RuntimeException('The uploaded file is not a valid image.', previous: $e);
        }

        $transform($image);

        $encoded = $image->toWebp($quality);

        $path = $folder.'/'.(string) Str::uuid().'.webp';

        Storage::disk(config('filesystems.default'))->put($path, (string) $encoded);

        return $path;
    }
}
