<?php

namespace App\Http\Services\ImageServices;

use App\Http\Services\ImageServices\Compression\ImageCompressionInterface;
use Intervention\Image\Facades\Image;

class CropAndStore
{
    private ImageCompressionInterface $compression;

    public function __construct(ImageCompressionInterface $compression)
    {
        $this->compression = $compression;
    }

    /**
     * @param $image
     *
     * @param string $storagePath = path from storage\app\public\
     *
     * @param array|int $sizes = [width, height] / or just single integer for both
     *
     * @return array
     */
    public function cropAndStore($image, string $storagePath, ...$sizes): array
    {
        foreach ($sizes as $size) {
            $img = Image::make($image);

            $w = $size;
            $h = $size;
            if (is_array($size)) {
                $w = $size[0];
                $h = $size[1] ?? $size[0];
            }

            $returnedPath = $storagePath . '_' . $w . 'x' . $h . '.jpg';
            $pathArray[] = $returnedPath;
            $fullPath = storage_path('app\public\\' . $returnedPath);

            $img->fit($w, $h)->save($fullPath);
            $this->compression->compress($fullPath);
        }
        return $pathArray;
    }
}
