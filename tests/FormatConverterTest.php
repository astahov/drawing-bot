<?php

declare(strict_types=1);

namespace Tests;

use App\FormatConverter;
use PHPUnit\Framework\TestCase;

class FormatConverterTest extends TestCase
{
    public function testCanConvertAnEmptyListOfPixelsToAnEmptyMatrix(): void
    {
        $pixels = [];
        $res = FormatConverter::convertListToMatrix($pixels);

        self::assertIsArray($res);
        self::assertEmpty($res, 'The resulting matrix is not empty.');
    }

    public function testCanConvertAListOfPixelsToAMatrix(): void
    {
        $pixels = [
            [
                'x' => 1,
                'y' => 1,
                'color' => '#ff0000',
            ],
            [
                'x' => 5,
                'y' => 10,
                'color' => '#00ff00',
            ],
        ];

        $res = FormatConverter::convertListToMatrix($pixels);

        self::assertIsArray($res);
        self::assertEquals(
            [
                1 => [1 => '#ff0000'],
                5 => [10 => '#00ff00'],
            ],
            $res
        );
    }

    public function testCanConvertARowMatrixOfPixelsToAList(): void
    {
        /*
         * ┌         ┐
         * | a  b  c |
         * └         ┘
         */
        $pixels[1][1] = 'a';
        $pixels[2][1] = 'b';
        $pixels[3][1] = 'c';

        $res = FormatConverter::convertMatrixToList($pixels);

        self::assertIsArray($res);
        self::assertEquals(
            [
                [
                    'x' => 1,
                    'y' => 1,
                    'color' => 'a',
                ],
                [
                    'x' => 2,
                    'y' => 1,
                    'color' => 'b',
                ],
                [
                    'x' => 3,
                    'y' => 1,
                    'color' => 'c',
                ],
            ],
            $res
        );

    }

    public function testCanConvertAColumnMatrixOfPixelsToAList(): void
    {
        /*
         * ┌   ┐
         * | a |
         * | b |
         * | c |
         * └   ┘
         */
        $pixels[1][1] = 'a';
        $pixels[1][2] = 'b';
        $pixels[1][3] = 'c';

        $res = FormatConverter::convertMatrixToList($pixels);

        self::assertIsArray($res);
        self::assertEquals(
            [
                [
                    'x' => 1,
                    'y' => 1,
                    'color' => 'a',
                ],
                [
                    'x' => 1,
                    'y' => 2,
                    'color' => 'b',
                ],
                [
                    'x' => 1,
                    'y' => 3,
                    'color' => 'c',
                ],
            ],
            $res
        );

    }

    public function testCanConvertASmallSquareMatrixOfPixelsToAList(): void
    {
        /*
         * ┌      ┐
         * | a  b |
         * | c  d |
         * └      ┘
         */
        $matrix[1][1] = 'a';
        $matrix[2][1] = 'b';
        $matrix[1][2] = 'c';
        $matrix[2][2] = 'd';

        $res = FormatConverter::convertMatrixToList($matrix);

        self::assertIsArray($res);
        self::assertEquals(
            [
                [
                    'x' => 1,
                    'y' => 1,
                    'color' => 'a',
                ],
                [
                    'x' => 2,
                    'y' => 1,
                    'color' => 'b',
                ],
                [
                    'x' => 1,
                    'y' => 2,
                    'color' => 'c',
                ],
                [
                    'x' => 2,
                    'y' => 2,
                    'color' => 'd',
                ],
            ],
            $res
        );

    }
}
