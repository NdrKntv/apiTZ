<?php

namespace App\Http\Services\ImageServices\Compression;

use function Tinify\fromFile;
use function Tinify\setKey;

class Tinypng implements ImageCompressionInterface
{
    public function __construct()
    {
        setKey(env('TINYPNG'));
    }

    public function compress($image)
    {
        try {
            $img = fromFile($image);
            return $img->toFile($image);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}
