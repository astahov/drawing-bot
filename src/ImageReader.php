<?php

declare(strict_types=1);

namespace App;

/**
 * Gets dimensions and pixel colors from a given PNG image.
 */
class ImageReader
{
    public static function readImage(string $fileName, bool $shouldReturnAsList = true): array
    {
        $im = imagecreatefrompng($fileName);
        $width = imagesx ($im);
        $height = imagesy ($im);

        $pixels = [];
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $rgb = imagecolorat($im, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                if ($shouldReturnAsList) {
                    $pixels[] = [
                        'x' => $x + 1,
                        'y' => $y + 1,
                        'color' => self::getColor($r, $g, $b)
                    ];
                } else {
                    $pixels[$x + 1][$y + 1] = self::getColor($r, $g, $b);
                }
            }
        }

        return [
            'width' => $width,
            'height' => $height,
            'pixels' => $pixels,
        ];
    }

    public static function getColor($r, $g, $b): string
    {
        return '#' . self::prefixWithZeroIfNeeded(dechex($r)) . self::prefixWithZeroIfNeeded(dechex($g)) . self::prefixWithZeroIfNeeded(dechex($b));
    }

    public static function prefixWithZeroIfNeeded(string $s): string
    {
        if (strlen($s) === 2) {
            return $s;
        }

        if (!is_numeric($s)) {
            return '0' . $s;
        }

        if ((int)$s < 10) {
            return '0' . $s;
        }

        return $s;
    }
}
