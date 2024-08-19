<?php

namespace App\Services;

use Intervention\Image\Image;
use Illuminate\Support\Facades\Storage;
class ImageService
{

    /**
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $path
     * @param int $width
     * @param int $height
     * @param int $quality
     * @return string $imagePath
     */

    public function imageResize($image, $path, $width = 800, $height = 600, $quality = 75)
    {
        $resizedImage = Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('jpg', $quality);

        $imagePath = $path . '/' . uniqid() . '.jpg';
        Storage::disk('public')->put($imagePath, (string) $resizedImage);

        return $imagePath;
    }
}
