<?php

namespace App\Jobs;

use App\Models\Page;
use App\Support\ImageProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessProfileImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Page $page,
        public string $tempPath,
    ) {}

    public function handle(): void
    {
        $disk = Storage::disk('local');

        if (! $disk->exists($this->tempPath)) {
            return;
        }

        $file = new UploadedFile($disk->path($this->tempPath), basename($this->tempPath), test: true);

        $oldPath = $this->page->profile_photo_path;

        $newPath = ImageProcessor::profilePhoto($file);

        $this->page->update(['profile_photo_path' => $newPath]);

        ImageProcessor::delete($oldPath);

        $disk->delete($this->tempPath);
    }
}
