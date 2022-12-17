<?php

declare(strict_types=1);

namespace App;

class FormatConverter
{
    /**
     * Converts the given list of pixels to a 2D array.
     */
    public static function convertListToMatrix(array $pixels): array
    {
        $res = [];
        foreach ($pixels as $pixel) {
            $res[$pixel['x']][$pixel['y']] = $pixel['color'];
        }

        return $res;
    }

    /**
     * Converts the given matrix of pixels to a list.
     */
    public static function convertMatrixToList(array $pixelsAsMatrix): array
    {
        $res = [];
        foreach ($pixelsAsMatrix as $x => $value) {
            foreach ($value as $y => $color) {
                $res[] = [
                    'x' => $x,
                    'y' => $y,
                    'color' => $color,
                ];
            }
        }

        $res = PixelListShuffler::shuffleItemList($res, count($pixelsAsMatrix));

        return $res;
    }
}
