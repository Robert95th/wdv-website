<?php
namespace App\Services;


use Illuminate\Support\Facades\Storage;

class ImageCompressor
{
    /**
     * Compress and save an uploaded image.
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @return string The path to the saved image
     */
    public static function compressAndStore($file, $folder = 'properties/images')
    {
        // 1. Generate a unique filename
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;
        $path = $folder . '/' . $filename;

        // 2. Get the raw image data
        $imageData = file_get_contents($file->getRealPath());
        $image = imagecreatefromstring($imageData);

        if ($image !== false) {
            // 3. Set max dimensions (e.g., 1200px width/height max)
            $maxWidth = 1200;
            $maxHeight = 1200;
            $width = imagesx($image);
            $height = imagesy($image);

            // Calculate new dimensions keeping aspect ratio
            $ratio = min($maxWidth / $width, $maxHeight / $height);
            if ($ratio < 1) { // Only scale down, never scale up
                $newWidth = round($width * $ratio);
                $newHeight = round($height * $ratio);
                $resizedImage = imagescale($image, $newWidth, $newHeight);
            } else {
                $resizedImage = $image;
            }

            // 4. Compress and save
            ob_start();
            // Quality 75 (0-100). Lower means smaller file but less quality.
            if ($extension == 'png') {
                imagepng($resizedImage, null, 8); // 8 is compression level for PNG (0-9)
            } else {
                imagejpeg($resizedImage, null, 75); // 75 is quality for JPG/WEBP
            }
            $compressedData = ob_get_clean();

            // 5. Save to storage
            Storage::disk('public')->put($path, $compressedData);

            // Free memory
            imagedestroy($image);
            if ($resizedImage !== $image) {
                imagedestroy($resizedImage);
            }

            return $path;
        }

        // Fallback if compression fails: save the original file
        return $file->storeAs($folder, $filename, 'public');
    }
}
