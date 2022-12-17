<?php

declare(strict_types=1);

namespace Tests;

use App\Configuration;
use App\ImageReader;
use PHPUnit\Framework\TestCase;

class ImageReaderTest extends TestCase
{
    public function testReturnsCorrectDimensions(): void
    {
        $image = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__2X2), true);
        self::assertEquals(2, $image['width']);
        self::assertEquals(2, $image['height']);
    }

    public function testReturnsCorrectImageStructureWhenFormatIsAList(): void
    {
        $image = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__2X2), true);
        self::assertIsArray($image);
        self::assertIsArray($image['pixels']);
        self::assertIsInt($image['pixels'][0]['x']);
        self::assertIsInt($image['pixels'][0]['y']);
        self::assertIsString($image['pixels'][0]['color']);
    }

    public function testReturnsCorrectImageStructureWhenFormatIsAMatrix(): void
    {
        $image = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__2X2), false);
        self::assertIsArray($image);
        self::assertIsArray($image['pixels']);
        self::assertIsString($image['pixels'][1][1]);
        self::assertIsString($image['pixels'][1][2]);
        self::assertIsString($image['pixels'][2][1]);
        self::assertIsString($image['pixels'][2][2]);
    }

    public function testReturnsCorrectPixelColorWhenFormatIsAMatrix(): void
    {
        $image = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__2X2), false);
        self::assertEquals('#000000', $image['pixels'][1][1]);
        self::assertEquals('#ffffff', $image['pixels'][1][2]);
        self::assertEquals('#ffffff', $image['pixels'][2][1]);
        self::assertEquals('#000000', $image['pixels'][2][2]);
    }

    public function testPrefixesWithZerosCorrectly(): void
    {
        self::assertEquals('01', ImageReader::prefixWithZeroIfNeeded('01'));
        self::assertEquals('01', ImageReader::prefixWithZeroIfNeeded('1'));
        self::assertEquals('10', ImageReader::prefixWithZeroIfNeeded('10'));
        self::assertEquals('09', ImageReader::prefixWithZeroIfNeeded('9'));
        self::assertEquals('ff', ImageReader::prefixWithZeroIfNeeded('ff'));
        self::assertEquals('0f', ImageReader::prefixWithZeroIfNeeded('0f'));
    }
}
