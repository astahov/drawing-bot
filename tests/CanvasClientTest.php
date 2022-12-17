<?php

declare(strict_types=1);

namespace Tests;

use App\CanvasClient;
use PHPUnit\Framework\TestCase;

class CanvasClientTest extends TestCase
{
    public function testPuttingPixelsWorks(): void
    {
        $res = (new CanvasClient)->putPixel(1, 1, '#ff0000', 0, 0);
        self::assertTrue($res);
    }

    public function testGettingPixelsReturnsCorrectStructure(): void
    {
        $res = (new CanvasClient)->getPixels();
        self::assertIsArray($res);
        self::assertIsString($res[1][1]);
        self::assertIsString($res[1][2]);
        self::assertIsString($res[2][1]);
        self::assertIsString($res[2][2]);
    }
}
