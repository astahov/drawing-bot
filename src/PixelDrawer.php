<?php

declare(strict_types=1);

namespace App;

class PixelDrawer
{
    private const PAUSE_ON_SUCCESS_IN_SECONDS = 0;

    private CanvasClient $client;

    public function __construct()
    {
        $this->client = new CanvasClient();
    }

    public function drawPixels(array $pixels, int $shiftX = 0, int $shiftY = 0, ?string $transparentColor = null): void
    {
        $pixelsToDraw = count($pixels);
        foreach ($pixels as $pixel) {
            echo "Pixels to draw: $pixelsToDraw.\n";
            $color = $pixel['color'];
            if (
                $transparentColor === null
                || $color !== Configuration::TRANSPARENT_COLOR
            ) {
                while(true) {
                    $opSucceeded = $this->client->putPixel($pixel['x'], $pixel['y'], $color, $shiftX, $shiftY);
                    if ($opSucceeded) {
                        $pixelsToDraw--;
                        sleep(self::PAUSE_ON_SUCCESS_IN_SECONDS);
                        break;
                    } else {
                        sleep(1);
                        echo "retry...\n";
                    }
                }
            }
        }
    }
}
