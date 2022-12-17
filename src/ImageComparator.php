<?php

declare(strict_types=1);

namespace App;

class ImageComparator
{
    /**
     * Calculates the difference between two arrays of pixels.
     *
     * The diff is returned as a list of pixels, to simplify its drawing.
     */
    public static function getDiff(array $pixels1AsList, array $pixels2AsMatrix, string $transparentColor = null, int $shiftX = 0, int $shiftY = 0, $verbose = false): array
    {
        $diff = [];
        foreach ($pixels1AsList as $pixel1)
        {
            if ($verbose) echo "Comparing next pixel...\n";
            $x = $pixel1['x'];
            $y = $pixel1['y'];
            $color = $pixel1['color'];

            if ($transparentColor !== null && $color === $transparentColor) {
                continue;
            }

            $xShifted = $x + $shiftX;
            $yShifted = $y + $shiftY;

            if (
                key_exists($xShifted, $pixels2AsMatrix)
                && key_exists($yShifted, $pixels2AsMatrix[$x])
            ) {
                $colorOnCanvas = $pixels2AsMatrix[$xShifted][$yShifted];
                if ($verbose)  echo "Such pixel exists on canvas and its color is $colorOnCanvas.\n";
                if ($color !== $colorOnCanvas) {
                    $diff[] = [
                        'x' => $xShifted,
                        'y' => $yShifted,
                        'color' => $color,
                    ];
                    if ($verbose) echo "Added this pixel to the diff.\n";
                }
            }
        }

        return $diff;
    }
}
