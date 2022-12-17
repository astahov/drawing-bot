<?php

declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;

/**
 * Sends pixels to the server with canvas and fetches pixel information from there.
 */
class CanvasClient
{
    private const URL__GET_ALL_PIXELS = 'https://pixel-art-api.stage-travel.com/pixel';
    private const URL__DRAW_PIXEL = 'https://pixel-art-api.stage-travel.com/pixel/draw';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function putPixel(int $x, int $y, string $color, int $shiftX, int $shiftY): bool
    {
        // echo "$x $y $color\n";

        $x += $shiftX;
        $y += $shiftY;

        try {
            $res = $this->client->request('PUT', self::URL__DRAW_PIXEL, [
                'json' => ['x' => $x, 'y' => $y, 'color' => $color],
            ]);
            // echo $res->getStatusCode() . "\n";
        } catch (\Throwable $ex) {
            echo 'Request failed. Error: ' . $ex->getMessage() . "\n";
            return false;
        }

        return true;
    }

    public function getPixels(): array
    {
        $res = $this->client->request('GET', self::URL__GET_ALL_PIXELS);

        return self::restructurePixels(json_decode($res->getBody()->getContents(), true));

    }

    private static function restructurePixels(array $responseFromCanvas): array
    {
        $pixelsRestructured = [];
        foreach ($responseFromCanvas['pixels'] as $pixel) {
            $pixelsRestructured[$pixel['x']][$pixel['y']] = $pixel['color'];
        }

        return $pixelsRestructured;
    }
}
