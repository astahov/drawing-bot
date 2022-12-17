<?php

declare(strict_types=1);

namespace Tests;

use App\PixelListShuffler;
use PHPUnit\Framework\TestCase;

class PixelListShufflerTest extends TestCase
{
    public function testShufflesA2By1MatrixCorrectly(): void
    {
        /*
         * ┌      ┐
         * | a  b |
         * └      ┘
         */
        $matrix[1][1] = 'a';
        $matrix[2][1] = 'b';

        $expected = [
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
        ];

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 2);

        self::assertEquals(
            $expected,
            $res
        );

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 1);

        self::assertEquals(
            $res,
            $res
        );
    }

    public function testShufflesA4By1MatrixCorrectly(): void
    {
        /*
         * ┌            ┐
         * | a  b  c  d |
         * └            ┘
         */
        $matrix[1][1] = 'a';
        $matrix[2][1] = 'b';
        $matrix[3][1] = 'c';
        $matrix[4][1] = 'd';

        $expected = [
            [
                'x' => 1,
                'y' => 1,
                'color' => 'a',
            ],
            [
                'x' => 3,
                'y' => 1,
                'color' => 'c',
            ],
            [
                'x' => 2,
                'y' => 1,
                'color' => 'b',
            ],
            [
                'x' => 4,
                'y' => 1,
                'color' => 'd',
            ]
        ];

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 2);

        self::assertEquals(
            $expected,
            $res
        );

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 1);

        self::assertEquals(
            $res,
            $res
        );
    }

    public function testShufflesA1By4MatrixCorrectly(): void
    {
        /*
         * ┌   ┐
         * | a |
         * | b |
         * | c |
         * | d |
         * └   ┘
         */
        $matrix[1][1] = 'a';
        $matrix[1][2] = 'b';
        $matrix[1][3] = 'c';
        $matrix[1][4] = 'd';

        $expected = [
            [
                'x' => 1,
                'y' => 1,
                'color' => 'a',
            ],
            [
                'x' => 1,
                'y' => 3,
                'color' => 'c',
            ],
            [
                'x' => 1,
                'y' => 2,
                'color' => 'b',
            ],
            [
                'x' => 1,
                'y' => 4,
                'color' => 'd',
            ]
        ];

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 2);

        self::assertEquals(
            $expected,
            $res
        );

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 1);

        self::assertEquals(
            $res,
            $res
        );
    }

    public function testShufflesA2By2MatrixCorrectly(): void
    {
        /*
         * ┌      ┐
         * | a  b |
         * | c  d |
         * └      ┘
         */
        $matrix[1][1] = 'a';
        $matrix[1][2] = 'b';
        $matrix[2][1] = 'c';
        $matrix[2][2] = 'd';

        $expected = [
            [
                'x' => 1,
                'y' => 1,
                'color' => 'a',
            ],
            [
                'x' => 2,
                'y' => 1,
                'color' => 'c',
            ],
            [
                'x' => 1,
                'y' => 2,
                'color' => 'b',
            ],
            [
                'x' => 2,
                'y' => 2,
                'color' => 'd',
            ],
        ];

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 2);

        self::assertEquals(
            $expected,
            $res
        );

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 1);

        self::assertEquals(
            $res,
            $res
        );
    }

    public function testShufflesA3By3MatrixCorrectly(): void
    {
        /*
         * ┌         ┐
         * | a  b  c |
         * | d  e  f |
         * | g  h  i |
         * └         ┘
         */
        $matrix[1][1] = 'a';
        $matrix[2][1] = 'b';
        $matrix[3][1] = 'c';
        $matrix[1][2] = 'd';
        $matrix[2][2] = 'e';
        $matrix[3][2] = 'f';
        $matrix[1][3] = 'g';
        $matrix[2][3] = 'h';
        $matrix[3][3] = 'i';


        $expected = [
            [
                'x' => 1,
                'y' => 1,
                'color' => 'a',
            ],
            [
                'x' => 1,
                'y' => 3,
                'color' => 'g',
            ],
            [
                'x' => 3,
                'y' => 1,
                'color' => 'c',
            ],
            [
                'x' => 3,
                'y' => 3,
                'color' => 'i',
            ],
            [
                'x' => 2,
                'y' => 1,
                'color' => 'b',
            ],
            [
                'x' => 2,
                'y' => 3,
                'color' => 'h',
            ],
            [
                'x' => 1,
                'y' => 2,
                'color' => 'd',
            ],
            [
                'x' => 3,
                'y' => 2,
                'color' => 'f',
            ],
            [
                'x' => 2,
                'y' => 2,
                'color' => 'e',
            ],
        ];

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 2);

        self::assertEquals(
            $expected,
            $res
        );

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 1);

        self::assertEquals(
            $res,
            $res
        );
    }

    public function testShufflesA4By4MatrixCorrectly(): void
    {
        /*
         * ┌            ┐
         * | a  b  c  d |
         * | e  f  g  h |
         * | i  j  k  l |
         * | m  n  o  p |
         * └            ┘
         */
        $matrix[1][1] = 'a';
        $matrix[2][1] = 'b';
        $matrix[3][1] = 'c';
        $matrix[4][1] = 'd';
        $matrix[1][2] = 'e';
        $matrix[2][2] = 'f';
        $matrix[3][2] = 'g';
        $matrix[4][2] = 'h';
        $matrix[1][3] = 'i';
        $matrix[2][3] = 'j';
        $matrix[3][3] = 'k';
        $matrix[4][3] = 'l';
        $matrix[1][4] = 'm';
        $matrix[2][4] = 'n';
        $matrix[3][4] = 'o';
        $matrix[4][4] = 'p';

        $expected = [
            [
                'x' => 1,
                'y' => 1,
                'color' => 'a',
            ],
            [
                'x' => 1,
                'y' => 3,
                'color' => 'i',
            ],
            [
                'x' => 3,
                'y' => 1,
                'color' => 'c',
            ],
            [
                'x' => 3,
                'y' => 3,
                'color' => 'k',
            ],
            [
                'x' => 2,
                'y' => 1,
                'color' => 'b',
            ],
            [
                'x' => 2,
                'y' => 3,
                'color' => 'j',
            ],
            [
                'x' => 4,
                'y' => 1,
                'color' => 'd',
            ],
            [
                'x' => 4,
                'y' => 3,
                'color' => 'l',
            ],
            [
                'x' => 1,
                'y' => 2,
                'color' => 'e',
            ],
            [
                'x' => 1,
                'y' => 4,
                'color' => 'm',
            ],
            [
                'x' => 3,
                'y' => 2,
                'color' => 'g',
            ],
            [
                'x' => 3,
                'y' => 4,
                'color' => 'o',
            ],
            [
                'x' => 2,
                'y' => 2,
                'color' => 'f',
            ],
            [
                'x' => 2,
                'y' => 4,
                'color' => 'n',
            ],
            [
                'x' => 4,
                'y' => 2,
                'color' => 'h',
            ],
            [
                'x' => 4,
                'y' => 4,
                'color' => 'p',
            ],
        ];

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 2);

        self::assertEquals(
            $expected,
            $res
        );

        $res = PixelListShuffler::shufflePixelMatrix($matrix, 1);

        self::assertEquals(
            $res,
            $res
        );
    }

}
