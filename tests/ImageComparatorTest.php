<?php

declare(strict_types=1);

namespace Tests;

use App\Configuration;
use App\ImageComparator;
use App\ImageReader;
use PHPUnit\Framework\TestCase;

class ImageComparatorTest extends TestCase
{
    public function testReturnsCorrectDifferenceBetweenTwoArraysOfPixels(): void
    {
        $pixels1AsList = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__2X2), true)['pixels'];
        $pixels2AsMatrix = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__2X2_MODIFIED), false)['pixels'];

        $diff = ImageComparator::getDiff($pixels1AsList, $pixels2AsMatrix, Configuration::TRANSPARENT_COLOR);
        self::assertEquals(
            [
                [
                    'x' => 2,
                    'y' => 1,
                    'color' => '#ffffff',
                ],
            ],
            $diff
        );
    }

    public function testReturnsCorrectDifferenceBetweenTwoArraysOfPixelsWhenThereIsNoChange(): void
    {
        $pixels1AsList = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__2X2), true)['pixels'];
        $pixels2AsMatrix = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__2X2), false)['pixels'];

        $diff = ImageComparator::getDiff($pixels1AsList, $pixels2AsMatrix);
        self::assertEquals(
            [],
            $diff
        );
    }

    public function testReturnsCorrectDifferenceForPixelsBeingShifted(): void
    {
        $pixels1AsList = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__2X2), true)['pixels'];
        $pixels2AsMatrix = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__CANVAS_10X10_WITH_2X2_MODIFIED_SHIFTED_BY_8), false)['pixels'];

        $diff = ImageComparator::getDiff($pixels1AsList, $pixels2AsMatrix, null, 8, 8);
        self::assertEquals(
            [
                [
                    'x' => 10,
                    'y' => 9,
                    'color' => '#ffffff',
                ],
            ],
            $diff
        );
    }
}
