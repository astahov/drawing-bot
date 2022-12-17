<?php

declare(strict_types=1);

namespace App;

use Tests\PixelListShufflerTest;

class PixelListShuffler
{
    /**
     * Shuffles a given list of items by starting at the first item, then jumping over $step - 1 items to pick the next one, and so on.
     * When the end of the list has been reached, and there are items on the list that haven't been picked,
     * it re-starts from the beginning of the list skipping the first item.
     *
     * @param array $items
     * @param int $step
     *
     * @return array
     */
    public static function shuffleItemList(array $items, int $step): array
    {
        $res = [];

        $startAtY = 1;
        $endAtY = $startAtY + $step;
        while (true) {
            $y = $startAtY;
            while (true) {
                $res[] = $items[$y - 1];
                $y = $y + $step;
                if ($y > count($items)) {
                    break;
                }
            }

            $startAtY++;

            if ($startAtY === $endAtY) {
                break;
            }
        }

        return $res;
    }

    /**
     * Shuffles a given matrix of pixels by starting at the first row and picking the first item,
     * then jumping over $step - 1 items to pick the next one, and so on.
     * When the end of the row has been reached, and there still are rows left,
     * it jumps over $step - 1 rows and starts working on that row.
     * When it has reached the bottom, it re-starts from the second row, and so on.
     *
     * {@see PixelListShufflerTest} for examples.
     *
     */
    public static function shufflePixelMatrix(array $matrix, int $step): array
    {
        $numberOfColumns = count($matrix);
        $numberOfRows = count($matrix[1]);

        $stepX = min($step, $numberOfColumns);
        $stepY = min($step, $numberOfRows);

        $res = [];

        $startY = 1; // the row to start with
        while (true) {

            $startX = 1; // the column to start with
            while (true) {

                $x = $startX;
                while (true) {
                    $y = $startY;
                    while (true) {
                        $res[] = [
                            'x' => $x,
                            'y' => $y,
                            'color' => $matrix[$x][$y],
                        ];
                        $y = $y + $stepY;
                        if ($y > $numberOfRows) {
                            break;
                        }
                    }
                    $x = $x + $stepX;
                    if ($x > $numberOfColumns) {
                        break;
                    }
                }

                $startX++;
                if ($startX > $stepX) {
                    break;
                }
            }

            $startY++;
            if ($startY > $stepY) {
                break;
            }

        }

        return $res;
    }
}
