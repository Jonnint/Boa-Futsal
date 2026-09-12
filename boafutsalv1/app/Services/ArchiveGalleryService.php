<?php

namespace App\Services;

use App\Models\SportType;
use App\Models\SportTypeGallery;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ArchiveGalleryService
{
    /**
     * Archive all active galleries for a given sport type before deletion.
     */
    public function archiveGalleries(SportType $sportType): int
    {
        $galleries = $sportType->galleries()->whereNull('archived_at')->get();
        if ($galleries->isEmpty()) {
            return 0;
        }

        $timestamp = Carbon::now()->format('Ymd_His');
        $archiveDirName = "{$sportType->slug}-{$timestamp}";
        $archivePath = storage_path("app/archived-galleries/{$archiveDirName}");

        if (!File::exists($archivePath)) {
            File::makeDirectory($archivePath, 0755, true);
        }

        $archivedCount = 0;

        foreach ($galleries as $gallery) {
            $sourceFile = null;

            // Check if file is in public path or storage path
            if (File::exists(public_path($gallery->image_path))) {
                $sourceFile = public_path($gallery->image_path);
            } elseif (File::exists(storage_path('app/public/' . $gallery->image_path))) {
                $sourceFile = storage_path('app/public/' . $gallery->image_path);
            }

            $destinationFileName = basename($gallery->image_path);
            $destinationFilePath = "{$archivePath}/{$destinationFileName}";
            $relativeArchivedPath = "archived-galleries/{$archiveDirName}/{$destinationFileName}";

            if ($sourceFile && File::exists($sourceFile)) {
                // If it's custom uploaded, move it; if it's default asset, copy it so default assets aren't lost
                if (str_starts_with($gallery->image_path, 'uploads/') || str_starts_with($gallery->image_path, 'storage/')) {
                    File::move($sourceFile, $destinationFilePath);
                } else {
                    File::copy($sourceFile, $destinationFilePath);
                }
            }

            $gallery->update([
                'archived_path' => $relativeArchivedPath,
                'archived_at' => Carbon::now(),
            ]);

            $archivedCount++;
        }

        return $archivedCount;
    }
}
